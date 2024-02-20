<?php

    use Form\WorkoutForm;
    use Form\WorkoutSetForm;
    use Form\WorkoutSetItemForm;
    use Services\UserService;

    load(['WorkoutSetForm', 'WorkoutForm', 'WorkoutSetItemForm'], FORMS);
    load(['UserService'], SERVICES);
    
    class WorkoutSetBuilderController extends Controller
    {
        public $form, $formWorkout, $formSetItem;
        public $workoutModel;

        public function __construct()
        {
            parent::__construct();
            $this->form = new WorkoutSetForm();
            $this->formWorkout = new WorkoutForm();
            $this->formSetItem = new WorkoutSetItemForm();

            $this->model = model('WorkoutSetBuilderModel');
            $this->setItemModel = model('WorkoutSetItemModel');

            $this->workoutModel = model('WorkoutModel');
            $this->data['form'] = $this->form;
            $this->data['formWorkout'] = $this->formWorkout;
            $this->data['formSetItem'] = $this->formSetItem;
        }

        public function index() {
            if(isMember()) {
                $this->data['workoutsets'] = $this->model->getAll([
                    'where' => [
                        'is_public' => [
                            'condition' => 'equal',
                            'value' => true,
                            'concatinator' => 'OR'
                        ],

                        'is_assigned_to' => [
                            'condition' => 'equal',
                            'value' => whoIs('id'),
                            'concatinator' => 'OR'
                        ]
                    ]
                ]);
            } else {
                $this->data['workoutsets'] = $this->model->getAll();
            }
            

            return $this->view('workout/builder/index', $this->data);
        }

        public function create() {
            if(isEqual(whoIs('user_type'), UserService::MEMBER)) {
                Flash::set("Members are not allowed to add their own workout sets");
                return redirect(_route('workout-set-builder:index'));
            }

            $req = request()->inputs();
            
            if(isSubmitted()) {
                $post = request()->posts();
                $post['user_id'] = whoIs('id');

                $id = $this->model->add($post);

                if(!$id) {
                    Flash::set($this->model->getErrorString(), 'danger');
                    return request()->return();
                }
                Flash::set("Workout set Created, Add workout to your set");
                return redirect(_route('workout-set-builder:add-workout', $id));
            }
            return $this->view('workout/builder/create', $this->data);
        }

        public function edit($id) {
            $setBuilder = $this->model->get($id);

            if(isSubmitted()) {
                $post = request()->posts();

                $this->model->update(
                    $this->model->getFillablesOnly($post),
                    $id
                );
                
                return redirect(_route('workout-set-builder:show', $id));
            }
            
            $this->form->setValueObject($setBuilder);
            $this->data['form'] = $this->form;

            return $this->view('workout/builder/create', $this->data);
        }

        public function show($id) {
            $setBuilder = $this->model->get($id);

            if(!empty($setBuilder->set_tag)) {
                $this->data['relatedWorkouts'] = $this->workoutModel->getAll([
                    'where' => [
                        'workout_tag' => [
                            'condition' => 'like',
                            'value' => "%{$setBuilder->set_tag}%"
                        ]
                    ],
                    'order' => 'workout_name asc'
                ]);
            }

            $this->data['workouts'] = $this->workoutModel->getAll([
                'order' => 'workout_name asc'
            ]);

            $this->data['setBuilder'] = $setBuilder;

            $this->data['setWorkouts'] = $this->setItemModel->getAll([
                'where' => [
                    'workout_set_id' => $id
                ]
            ]);

            return $this->view('workout/builder/show', $this->data);
        }

        public function addWorkout($id) {
            $setBuilder = $this->model->get($id);

            if(isSubmitted()) {
                $post = request()->posts();
                $this->setItemModel->add($post);
                Flash::set("Work out Added");
                return redirect(_route('workout-set-builder:show', $id));
            }

            if(!empty($setBuilder->set_tag)) {
                $this->data['relatedWorkouts'] = $this->workoutModel->getAll([
                    'where' => [
                        'workout_tag' => [
                            'condition' => 'like',
                            'value' => "%{$setBuilder->set_tag}%"
                        ]
                    ],
                    'order' => 'workout_name asc'
                ]);
            }
            
            $this->data['workouts'] = $this->workoutModel->getAll([
                'order' => 'workout_name asc'
            ]);

            $this->data['setBuilder'] = $setBuilder;
            $this->formSetItem->addWorkout($setBuilder->set_tag);

            $this->data['formSetItem'] = $this->formSetItem;
            return $this->view('workout/builder/add_workout', $this->data);
        }

        public function editWorkout($id) {

        }

        public function deleteWorkout($id) {
            $setWorkout = $this->setItemModel->get($id);
            $workSetId = $setWorkout->workout_set_id;

            $this->setItemModel->delete($id);
            Flash::set("Workset set deleted");
            return redirect(_route('workout-set-builder:show', $workSetId));
        }
    }
