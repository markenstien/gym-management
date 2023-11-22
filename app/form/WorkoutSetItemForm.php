<?php 

    namespace Form;
    use Core\Form;

    load(['Form'], CORE);
    class WorkoutSetItemForm extends Form
    {
        private $workoutModel;
        public function __construct()
        {
            parent::__construct();
            $this->workoutModel = model('WorkoutModel');

            $this->addWorkout();
            $this->addRepcount();
            $this->addWorkTime();
            $this->addRestTime();
        }

        public function addWorkout($workoutTags = '') {

            $skipThisIds = [];
            $workoutArray = [];
            /**
             * fetch same workouts 
             */
            if(!empty($workoutTags)) {
                $relatedWorkouts = $this->workoutModel->getAll([
                    'order' => 'workout_name asc',
                    'where' => [
                        'workout_tag' => [
                            'condition' => 'like',
                            'value' => "%{$workoutTags}%"
                        ]
                    ]
                ]);

                if($relatedWorkouts) {
                    foreach($relatedWorkouts as $key => $row) {
                        //add to skip ids
                        $skipThisIds[] = $row->id;
                        $workoutArray[$row->id] = $row->workout_name;
                    }
                }
            }
            $workouts = $this->workoutModel->getAll([
                'order' => 'workout_name asc',
                'where' => [
                    'id' => [
                        'condition' => 'not in',
                        'value' => $skipThisIds
                    ]
                ]
            ]);

            if(!empty($workouts)) {
                foreach($workouts as $key => $row) {
                    $workoutArray[$row->id] = $row->workout_name;
                }
            }

            $this->add([
                'name' => 'workout_id',
                'type' => 'select',
                'class' => 'form-control',
                'required' => true,
                'options' => [
                    'label' => 'Workout',
                    'option_values' => $workoutArray
                ]
            ]);
        }

        public function addRepcount() {
            $this->add([
                'name' => 'rep_count',
                'type' => 'number',
                'class' => 'form-control',
                'required' => true,
                'options' => [
                    'label' => 'Repetitions'
                ]
            ]);
        }

        public function addWorkTime() {
            $this->add([
                'name' => 'work_time',
                'type' => 'number',
                'class' => 'form-control',
                'required' => true,
                'options' => [
                    'label' => 'Work Time'
                ]
            ]);
        }

        public function addRestTime() {
            $this->add([
                'name' => 'rest_time',
                'type' => 'number',
                'class' => 'form-control',
                'required' => true,
                'options' => [
                    'label' => 'Rest Time'
                ]
            ]);
        }

    }