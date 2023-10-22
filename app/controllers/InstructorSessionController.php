<?php

    use Form\InstructorSessionForm;
    load(['InstructorSessionForm'], FORMS);

    class InstructorSessionController extends Controller
    {
        public $assetManagementModel;
        public function __construct()
        {
            parent::__construct();
            $this->model = model('InstructorSessionModel');
            $this->user_program_model = model('UserProgramModel');
            $this->userModel = model('UserModel');
            $this->assetManagementModel = model('AssetManagementModel');
            $this->sessionAssetModel = model('SessionAssetModel');
            $this->data['_form'] = new InstructorSessionForm();
        }

        public function index() {
            if($this->is_admin) {
                $this->data['sessions'] = $this->model->getAll();
            } else {
                if(isMember()) {
                    $this->data['sessions'] = $this->model->getAttendees([
                        'where' => [
                            'attendees.user_id' => $this->data['whoIs']->id
                        ]
                    ]);
                }else if(isInstructor()){
                    $this->data['sessions'] = $this->model->getAll(
                        [
                            'where' => [
                                'instructor_id' => $this->data['whoIs']->id
                            ],

                            'group' => 'ins.id'
                        ]
                    );
                } else {
                    $this->data['sessions'] = $this->model->getAll();
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
            $this->data['_form']->setValue('status', $req['status'] ?? 'pending');

            return $this->view('instructor_session/create', $this->data);
        }

        public function show($id) {

            if(isSubmitted()) 
            {
                $post = request()->posts();

                if(isset($post['btn_image_upload'])) {

                    if(!upload_empty('images')) {
                        $this->_attachmentModel->path = PATH_UPLOAD.DS.'session_images';
                        $this->_attachmentModel->url  = GET_PATH_UPLOAD.'/session_images';
                        $uploadAll = $this->_attachmentModel->upload_multiple([
                            'global_id' => $post['session_id'],
                            'global_key' => 'session_images'
                        ], 'images');

                    }else{
                        Flash::set("There are no images to upload");
                    }
                }
            }

            $session = $this->model->get($id);
            $this->data['session'] = $session;

            $this->data['attendees'] = $this->model->getAttendees([
                'where' => [
                    'instructor_session_id' => $id
                ]
            ]);

            $this->data['images'] = $this->_attachmentModel->all([
                'global_id' => $id,
                'global_key' => 'session_images'
            ]);

            $this->data['assets'] = $this->assetManagementModel->getAll([
                'where' => [
                    'asset.user_id' => [
                        'condition' => 'in',
                        'value' => [null, whoIs('id')]
                    ]
                ],
                'order' => 'asset.id desc'
            ]);
            
            $this->data['sessionAssets'] = $this->sessionAssetModel->getAll([
                'where' => [
                    'session_id' => $id
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
            $this->data['members'] = $this->userModel->all([
                'user_type' => 'member'
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

        public function accept($sessionID) {
            $req = request()->inputs();
            $session = $this->model->get($sessionID);
            $isOkay = $this->model->accept($sessionID);

            if($isOkay) {
                Flash::set("Session Accepted");
            }
            return request()->return();
        }

        /**
         * session_attendee_table_id */
        public function showAttendee($id) {

            $attendee = $this->model->getAttendees([
                'where' => [
                    'attendees.id' => $id
                ]
            ])[0] ?? false;

            if(!$attendee) {
                Flash::set("Attendee not found.");
                return request()->return();
            }

            $attendees = $this->model->getAttendees([
                'where' => [
                    'instructor_session_id' => $attendee->instructor_session_id
                ]
            ]);

            $this->data['attendee'] = $attendee;
            $this->data['attendees'] = $attendees;
            return $this->view('instructor_session/show_attendee', $this->data);
        }

        public function addFile() {
            if(isSubmitted()) {
                $post = request()->posts();
                $res = $this->sessionAssetModel->add($post['id'],$post['asset_id']);

                if($res) {
                    Flash::set("Asset added to session");
                    return redirect(_route('instructor-session:show', $post['id']));
                } else {
                    Flash::set($this->sessionAssetModel->getErrorString(), 'danger');
                    return request()->return();
                }
            }
        }

        public function deleteAsset($id) {
            $sessionID = request()->input('sessionId');
            $this->sessionAssetModel->delete($id);
            return redirect(_route('instructor-session:show', $sessionID));
        }
    }