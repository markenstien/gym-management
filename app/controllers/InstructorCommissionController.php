<?php 

    class InstructorCommissionController extends Controller
    {
        public $model;

        public function __construct()
        {
            parent::__construct();
            _requireAuth();
            $this->model = model('InstructorCommissionModel');
        }

        public function index() {
            if(isAdmin()) {
                $userId = request()->input('id');
            } else {
                $userId = whoIs('id');
            }
            
            if(isAdmin()) {
                $this->data['commissions'] = $this->model->getAll([
                    'order' => 'id desc'
                ]);
            } else {
                $this->data['commissions'] = $this->model->getAll([
                    'where' => [
                        'instructor_id' => whoIs('id')
                    ],
                    'order' => 'id desc'
                ]);
            }
            
            return $this->view('instructor_commission/index', $this->data);
        }
    }