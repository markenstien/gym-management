<?php

    use Form\ProgramForm;
    use Services\UserService;

    load(['ProgramForm'], FORMS);
    load(['UserService'], SERVICES);

    class ProgramController extends Controller
    {
        public $form, $model, 
        $userModel,$programParticipantModel,
        $paymentModel, $programSessionsModel;

        public function __construct()
        {
            parent::__construct();
            $this->model = model('ProgramModel');
            $this->programParticipantModel = model('ProgramParticipantModel');
            $this->programSessionsModel = model('ProgramSessionModel');
            $this->userModel = model('UserModel');
            $this->paymentModel = model('PaymentModel');
            $this->form = new ProgramForm();
            $this->data['form'] = $this->form;
        }

        public function index() {
            if(isAdmin()) {
                $this->data['programs'] = $this->model->getAll();
            } elseif(isInstructor()) {
                $this->data['programs'] = $this->model->getAll([
                    'where' => [
                        'instructor_id' => whoIs('id')
                    ]
                ]);
            } else {
                $this->data['programs'] = $this->programParticipantModel->getAll([
                    'where' => [
                        'member_id' => whoIs('id')
                    ]
                ]);
            }
            
            return $this->view('program/index', $this->data);
        }

        public function create() {
            $req = request()->inputs();

            if(isSubmitted()) {
                $post = request()->posts();
                $programId = $this->model->addNew(
                    $this->model->getFillablesOnly($post)
                );

                if($programId) {
                    Flash::set("Program {$post['program_name']} has been created.");
                    return redirect(_route('program:show', $programId));
                } else {
                    Flash::set('Something went wrong.', 'danger');
                }
                return redirect(_route('program:create'));
            }
            return $this->view('program/create', $this->data);
        }

        public function edit() {

        }

        public function show($id) {
            $program = $this->model->get($id);
            $this->data['program'] = $program;
            $this->data['participants'] = $this->model->getParticipants($id);
            $this->data['sessions'] = $this->model->getSessions($id);
            return $this->view('program/show', $this->data);
        }

        public function addParticipant($id) {
            $req = request()->inputs();

            if(isSubmitted()) {
                $post = request()->posts();
                $user = $this->userModel->get($post['member_id']);

                if(!$user) {
                    Flash::set("No member found with code '{$post['member_code']}'", 'danger');
                    return request()->return();
                }

                if(empty($post['payment_amount'])) {
                    Flash::set("Invalid Payment");
                    return request()->return();
                }

                if(isMemberShipExpired($user->membership_expiry_date)) {
                    $link = wLinkDefault(_route('user:add-to-member', $user->id), 'Click here to purchase membership', 'danger');
                    Flash::set("Program Participant must be an active gym member, {$link}");
                    return request()->return();
                }

                $paymentId = $this->paymentModel->createOrUpdate([
                    'order_id' => $user->id,
                    'amount'   => $post['payment_amount'],
                    'payment_method' => $post['payment_method'],
                    'payment_key' => 'PROGRAM_PAYMENT',
                    'remarks'   => $post['description'],
                    'payer_name' => $user->firstname . ' '.$user->lastname
                ]);

                if($paymentId) {
                    
                    //add check if member is a gym member if not do not allow
                    $participantId = $this->programParticipantModel->addNew([
                        'program_id' => $post['program_id'],
                        'member_id'  => $user->id,
                        'payments'   => $post['payment_amount'],
                        'status'     => 'verified'
                    ]);

                    if(!$participantId) {
                        Flash::set($this->programParticipantModel->getErrorString(), 'danger');
                        return request()->return();
                }

                    Flash::set("Member added to the program");
                    return redirect(_route('program:show', $post['program_id']));
                } else {
                    Flash::set("Something went wrong with your payment");
                    return request()->return();
                }
            }

            $program = $this->model->get($id);
            $this->data['program'] = $program;
            $this->data['members'] = $this->userModel->getAll([
                'where' => [
                    'user_type' => UserService::MEMBER
                ]
            ]);
            return $this->view('program/add_participant', $this->data);
        }

        public function startSession() {
            $req = request()->inputs();

            if(isSubmitted()) {
                $post = request()->posts();

                $isOkay = $this->programSessionsModel->complete([
                    'session_id' => $post['id'],
                    'attendees' => $post['member_id'],
                    'program_id' => $post['program_id'],
                    'remarks'    => $post['remarks']
                ]);

                if($isOkay) {
                    Flash::set("Session Completed");
                    return redirect(_route('program:show-session', $post['id']));
                } else {
                    Flash::set($this->programSessionsModel->getErrorString());
                    return request()->return();
                }
            }

            $sessionId = unseal($req['session_id']);
            $session = $this->programSessionsModel->get($sessionId);
            $program = $this->model->get($session->program_id);
            $programId = $program->id;

            if(!$program) {
                Flash::set("Unable to find program");
                return request()->return();
            }

            $this->data['program'] = $program;
            $this->data['session'] = $session;
            $this->data['participants'] = $this->model->getParticipants($programId);
            return $this->view('program/start_session', $this->data);
        }

        public function showSession($id) {
            $session = $this->programSessionsModel->get($id);
            $this->data['session'] = $session;
            return $this->view('program/show_session', $this->data);
        }

        public function students($params = []) {
            $this->data['students'] = $this->programParticipantModel->getAll();
            return $this->view('program/students', $this->data);
        }
    }