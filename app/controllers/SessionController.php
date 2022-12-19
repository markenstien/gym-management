<?php

    use Services\UserService;
    load(['UserService'], SERVICES);

    class SessionController extends Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->paymentModel = model('PaymentModel');
            $this->userModel = model('UserModel');  
            $this->instructorCommissionModel = model('InstructorCommissionModel');
            $this->instructorPackageModel = model('InstructorPackageModel');
            $this->userProgramModel = model('UserProgramModel');
        }

        /**
         * instant session
         */
        public function create() {

            if(isSubmitted()) {

                $post = request()->posts();

                $paymentData = [
                    'amount' => $post['amount'],
                    'payment_method' => $post['payment_method'],
                    'remarks' => $post['description'],
                    'payment_key' => 'SESSION_PAYMENT'
                ];
                //check if type of customer
                if (isEqual($post['customer_type'], 'member')) {
                    $isUserExist =$this->userModel->single([
                        'user_type' => UserService::MEMBER,
                        'user_identification' => trim($post['user_key_word'])
                    ]);

                    if(!$isUserExist) {
                        Flash::set("Member ID Does not exists");
                        return request()->return();
                    }
                    $paymentData['payer_name'] = $isUserExist->firstname . ' ' .$isUserExist->lastname;
                    $paymentData['order_id']   = $isUserExist->id;
                    //check if member id exists                    
                } else {
                    $paymentData['payer_name'] = $post['user_key_word'];
                }
                
                $isOkay = $this->paymentModel->createOrUpdate($paymentData);

                if($isOkay) {
                    Flash::set("Payment approved");
                    return redirect(_route('session:create'));
                }else{
                    Flash::set("Something went wrong");
                    return request()->return();
                }
            }
            return $this->view('session/create');
        }

         /**
         * sessions with instructor
         * payment and membership
         */

        public function withInstructor() {
            
            if(isSubmitted()) {
                $post = request()->posts();

                //series of checks

                /**
                 * user identity check
                 */
                if($user = $this->userModel->get([
                    'user_identification' => $post['user_identification']
                ])) {
                    if(!isEqual($user->user_type, UserService::MEMBER)) {
                        Flash::set("User type not allowed");
                        return request()->return();
                    }
                } else {
                    Flash::set("User does not exists");
                    return request()->return();
                }

                $package = $this->instructorPackageModel->get($post['package_id']);

                $userProgramId = $this->userProgramModel->createOrUpdate([
                    'user_id' => $user->id,
                    'instructor_id' => $post['instructor_id'],
                    'program_id' => $package->program_id,
                    'package_id' => $package->id,
                    'sessions' => $package->sessions,
                ]);

                $sessionTotal =  $this->userModel->getAvailableSession($user->id) + $package->sessions;
                $isUserUpdated = $this->userModel->update([
                    'available_session_count' => $sessionTotal
                ], $user->id);

                $isPaymentOk = $this->paymentModel->createOrUpdate([
                    'amount' => $post['amount'],
                    'payment_key' => $this->paymentModel::SESSION_WITH_INSTRUCTOR,
                    'payment_method' => $post['payment_method'],
                    'remarks' => $post['description'],
                    'payer_name' => $user->firstname . ' '.$user->lastname,
                    'order_id' => $user->id
                ]);

                $isInstructorCommissionOk = $this->instructorCommissionModel->createOrUpdate([
                    'instructor_id' => $post['instructor_id'],
                    'user_program_id' => $userProgramId,
                    'amount' => $post['amount'] * .10,
                    'entry_type' => 'ADD'
                ]);

                if($userProgramId && $isUserUpdated && $isPaymentOk && $isInstructorCommissionOk) {
                    Flash::set("Session created");
                    return redirect(_route('user-program:index'));
                }
            }

            $this->data['packages'] = $this->instructorPackageModel->getAll();
            $this->data['instructors'] = $this->userModel->getAll([
                'where' => [
                    'user_type' => UserService::INSTRUCTOR
                ]
            ]);
            return $this->view('session/with_instructor', $this->data);
        }
    }