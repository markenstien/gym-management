<?php

    use Form\PackageForm;
    use Form\ProgramForm;
    use Services\UserService;
    load(['UserService'], SERVICES);
    load(['ProgramForm', 'PackageForm'], FORMS);

    class SessionController extends Controller
    {
        public $paymentModel, $userModel,
        $instructorCommissionModel, $sessionModel,
        $sessionRemarkModel, 
        $instructorPackageModel,
        $userProgramModel;

        public $programForm,$packageForm;

        public function __construct()
        {
            parent::__construct();
            _requireAuth();
            $this->paymentModel = model('PaymentModel');
            $this->userModel = model('UserModel');  
            $this->instructorCommissionModel = model('InstructorCommissionModel');
            $this->instructorPackageModel = model('InstructorPackageModel');
            $this->userProgramModel = model('UserProgramModel');
            $this->sessionModel = model('SessionModel');
            $this->sessionRemarkModel = model('SessionRemarkModel');

            $this->programForm = new ProgramForm();
            $this->packageForm = new PackageForm();

            $this->data['programForm'] = $this->programForm;
            $this->data['packageForm'] = $this->packageForm;
        }

        public function index() {
            $this->data['sessions'] = $this->sessionModel->getAll();
            return $this->view('session/index', $this->data);
        }

        /**
         * instant session
         */
        public function create() {

            if(isSubmitted()) {
                $post = request()->posts();
                $errors = [];
                $date = nowMilitary();
                /**
                 * validations
                 * 1 for member session
                 * member_id should not be empty
                 * 2 for non member
                 * customer_name should not be empty
                 * package_id must not be empty
                 */

                if(empty($post['amount']) || empty($post['session'])){
                    $errors [] = "Amount and session should not be empty";
                }

                if($post['is_member']) {
                    //check if selected user membership is active
                    $user = $this->userModel->get($post['member_id']);
                    if(is_null($user->membership_expiry_date)) {
                        $errors [] = "Unable to add program to user is not a gym member";
                    } elseif(isMemberShipExpired($user->membership_expiry_date)) {
                        $errors [] = "User membership status is invalid Valid Only until {$user->membership_expiry_date}";
                    }
                }

                if(!empty($errors)) {
                    Flash::set(implode(',', $errors), 'danger');
                    return request()->return();
                }

                $package = $this->instructorPackageModel->get($post['package_id']);

                if($post['is_instructed']) {
                    //check
                    
                    if(empty($post['instructor_id'])){
                        Flash::set("Instructor must not be empty", "danger");
                        return request()->return();
                    }
                    //insert to instructed
                    $this->sessionModel->store([
                        'member_id'       => $post['member_id'],
                        'instructor_id'   => $post['instructor_id'],
                        'package_id'      => $post['package_id'],
                        'package_session' => $package->sessions,
                        'session_taken'   => 0,
                        'created_at'      => $date,
                        'last_update'     => $date,
                        'session_type'    => 'INSTRUCTED'
                    ]);
                } else {
                    
                    $this->sessionModel->store([
                        'member_id'       => $post['member_id'],
                        'package_id'      => $post['package_id'],
                        'package_session' => $package->sessions,
                        'session_taken'   => 0,
                        'created_at'      => $date,
                        'last_update'     => $date,
                        'session_type'    => 'REGULAR'
                    ]);
                }

                $paymentData = [
                    'amount' => $post['amount'],
                    'payment_method' => $post['payment_method'],
                    'remarks' => $post['description'],
                    'payment_key' => 'SESSION_PAYMENT',
                    'order_id'   => $post['member_id']
                ];
                    
                foreach($paymentData as $key => $row) {
                    if($key != 'remarks') {
                        if(empty($row)) {
                            $errors [] =  $row;
                        }
                    }
                }

                if(!empty($errors)) {
                    Flash::set("Invalid Payment Information", 'danger');
                    return request()->return();
                }

                $netAmount = $post['amount'];

                if($post['is_instructed']) {
                    $instructorCommissionAmount = $post['amount'] / 2;
                    $netAmount = $post['amount'] - $instructorCommissionAmount;
                    $paymentData['internal_remarks'] = "Deducted {$instructorCommissionAmount} for instructor commission";
                    $this->instructorCommissionModel->createOrUpdate([
                        'instructor_id' => $post['instructor_id'],
                        'user_program_id' => $post['package_id'],
                        'amount' => $instructorCommissionAmount,
                        'entry_type' => 'ADD',
                        'remarks' => "{$package->package_name} commission"
                    ]);
                }

                $paymentData['net_amount'] = $netAmount;
                $isOkay = $this->paymentModel->createOrUpdate($paymentData);

                if($isOkay) {
                    Flash::set("Payment approved");
                    return redirect(_route('session:create'));
                }else{
                    Flash::set("Something went wrong");
                    return request()->return();
                }
            }
            
            $members = $this->userModel->getAll([
				'where' => [
					'user_type' => UserService::MEMBER
                ],
                'order' => 'firstname asc'
            ]);

            $instructors = $this->userModel->getAll([
				'where' => [
					'user_type' => UserService::INSTRUCTOR
                ],
                'order' => 'firstname asc'
            ]);

            $this->data['membersSelect'] = arr_layout_keypair($members, ['id', 'firstname@lastname']);
            $this->data['instructorsSelect'] = arr_layout_keypair($instructors, ['id', 'firstname@lastname']);
            $this->data['members'] = $members;
            $this->data['instructors'] = $instructors;
            return $this->view('session/create', $this->data);
        }

        public function students() {
            $whoIs = whoIs();
            
            $sessions = $this->sessionModel->getAll([
                'where' => [
                    'instructor_id' => $whoIs->id
                ]
            ]);

            $this->data['students'] = $sessions;
            return $this->view('session/students', $this->data);
        }

        /**
         * this will help members
         * to check their progress
         */
        public function addSessionTransaction() {
            $req = request()->inputs();
            $sessionId = unseal($req['sessionId']);
            $session = $this->sessionModel->get($sessionId);
            if(isSubmitted()) {
                $post = request()->posts();

                $isOkay = $this->sessionModel->addSessionTaken($session->id);

                if(!$isOkay) {
                    Flash::set($this->sessionModel->getErrorMessage(), 'danger');
                    return request()->return();
                }
                $this->sessionRemarkModel->store([
                    'session_id' => $post['session_id'],
                    'member_id'  => $session->member_id,
                    'instructor_id' => $session->instructor_id,
                    'remarks' => trim($post['remarks'])
                ]);

                
                Flash::set("Session Remarks Added");
                return redirect(_route('session:students'));
            }
            $this->data['session'] = $session;
            $this->data['sessionRemarks'] = $this->sessionRemarkModel->getAll([
                'where' => [
                    'session_id' => $sessionId
                ],
                'order' => 'sr.id desc'
            ]);
            return $this->view('session/add_transaction', $this->data);
        }

        /**
         * act like cron jobs
         */
        public function updateDailySessions() {
            $this->sessionModel->updateDailySession();
            Flash::set("Daily Session Update Successfully");
            return request()->return();
        }
    }