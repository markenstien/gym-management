<?php

    use Form\InstructorSessionForm;
    load(['InstructorSessionForm'], FORMS);

    class InstructorSessionController extends Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->model = model('InstructorSessionModel');
            $this->user_program_model = model('UserProgramModel');

            $this->data['_form'] = new InstructorSessionForm();
        }

        public function index() {
            if($this->is_admin) {
                $this->data['sessions'] = $this->model->getAttendees();
            } else {
                if(isMember()) {
                    $this->data['sessions'] = $this->model->getAttendees([
                        'where' => [
                            'attendees.user_id' => $this->data['whoIs']->id
                        ]
                    ]);
                }else{
                    $this->data['sessions'] = $this->model->getAttendees(
                        [
                            'where' => [
                                'instructor_id' => $this->data['whoIs']->id
                            ]
                        ]
                    );
                }
            }
            return $this->view('instructor_session/index', $this->data);
        }
        
        public function create() {
            $req= request()->posts();

            if(isSubmitted()) {
                $post  = request()->posts();
                $result = $this->model->createOrUpdate($post);

                if($result) {
                    Flash::set("Session {$post['session_name']} Has been created");
                    return redirect(_route('instructor-session:show', $result));
                }
            }
            

            $this->data['_form']->setValue('instructor_id', whoIs('id'));

            return $this->view('instructor_session/create', $this->data);
        }

        public function show($id) {
            $session = $this->model->get($id);
            $this->data['session'] = $session;
            $this->data['attendees'] = $this->model->getAttendees([
                'where' => [
                    'instructor_session_id' => $id
                ]
            ]);
            
            return $this->view('instructor_session/show', $this->data);
        }

        public function addAttendee($id) {
            $req = request()->inputs();
            $instructorID = unseal($req['instructorID']);

            if(isset($req['action'])) {

                switch($req['action']) {
                    case 'addUser':
                        $response = $this->model->addAttendee($id, unseal($req['memberID']));
                        if($response) {
                            Flash::set($this->model->getMessageString(), 'success', 'attendees');
                        } else {
                            Flash::set($this->model->getErrorString(), 'danger', 'attendees');
                        }

                        return redirect(_route('instructor-session:show', $id));
                    break;
                }
            }
            $this->data['members'] = $this->user_program_model->getAll([
                'where' => [
                    'user_program.instructor_id' => $instructorID
                ]
            ]);

            $this->data['sessionID'] = $id;
            $this->data['instructorID'] = $instructorID;

            return $this->view('instructor_session/add_attendee', $this->data);
        }

        /**
         * pass-attendee join id
         */
        public function removeAttendee($id) {
            $req = request()->inputs();
            $this->model->removeAttendee($id);
            Flash::set("Member Removed from session",'success', 'attendees');
            return redirect(_route('instructor-session:show', unseal($req['sessionID'])));
        }

        public function cancel($id) {
            $this->model->cancel($id);
            Flash::set("Session Cancelled");
            return redirect(_route('instructor-session:show', $id));
        }

        public function complete($id) {
            $this->model->complete($id);
            Flash::set("Session Completed");
            return redirect(_route('instructor-session:show', $id));
        }
    }