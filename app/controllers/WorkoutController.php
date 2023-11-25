<?php

    use Form\WorkoutForm;
    load(['WorkoutForm'], FORMS);

    class WorkoutController extends Controller
    {
        public $form;

        public function __construct()
        {
            parent::__construct();
            $this->model = model('WorkoutModel');
            $this->form = new WorkoutForm();
            $this->data['form'] = $this->form;
        }

        public function index() {
            $this->data['workouts'] = $this->model->getAll();
            return $this->view('workout/main/index', $this->data);
        }

        public function create() {
            $req = request()->inputs();

            if(isSubmitted()) {
                $post = request()->posts();
                $id = $this->model->add($post);

                if(!upload_empty('workout_images')) {
                    $this->_attachmentModel->upload_multiple([
                        'global_key' => 'WORK_OUT_IMAGE',
                        'global_id' => $id
                    ], 'workout_images');
                }

                Flash::set("Work out added");
                return redirect(_route('workout:index'));
            }
            return $this->view('workout/main/create', $this->data);
        }
    }