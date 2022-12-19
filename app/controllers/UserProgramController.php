<?php 

    class UserProgramController extends Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->model = model('UserProgramModel');
        }

        public function index() {

            if($this->is_admin) {
                $this->data['user_programs'] = $this->model->getAll(['order' => 'user_program.id desc']);
            } else {
                if(isInstructor()) {
                    $this->data['user_programs'] = $this->model->getAll([
                        'where' => [
                            'instructor_id' =>  $this->data['whoIs']->id
                        ],
                        'order' => 'user_program.id desc'
                    ]);
                } else {
                    $this->data['user_programs'] = $this->model->getAll([
                        'where' => [
                            'user_id' =>  $this->data['whoIs']->id
                        ],
                        'order' => 'user_program.id desc'
                    ]);
                }
            }   
            
            return $this->view('user/user_program', $this->data);
        }
    }