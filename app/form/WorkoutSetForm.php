<?php
    namespace Form;
    use Core\Form;

    load(['Form'], CORE);

    class WorkoutSetForm extends Form {

        public function __construct()
        {
            parent::__construct();
            $this->addName();
            $this->addTag();
            $this->addSchedule();
            $this->addUserId();
        }

        public function addName() {
            $this->add([
                'name' => 'set_name',
                'type' => 'text',
                'class' => 'form-control',
                'options' => [
                    'label' => 'Workout Set name'
                ]
            ]);
        }

        public function addTag() {
            $this->add([
                'name' => 'set_tag',
                'type' => 'text',
                'class' => 'form-control',
                'options' => [
                    'label' => 'Workout Category'
                ],
                'attributes' => [
                    'placeholder' => 'eg. Abs, Core, Chest'
                ]
            ]);
        }

        public function addSchedule() {
            $this->add([
                'name' => 'schedule',
                'type' => 'select',
                'class' => 'form-control',
                'options' => [
                    'label' => 'Schedule',
                    'option_values' => [
                        'Sun' => 'Sunday',
                        'Mon' => 'Monday',
                        'Tue' => 'Tuesday',
                        'Wed' => 'Wednesday',
                        'Thu' => 'Thursday',
                        'Fri' => 'Friday',
                        'Sat' => 'Saturday',
                    ]
                ],
                'attributes' => [
                    'placeholder' => 'eg. Abs, Core, Chest'
                ]
            ]);
        }

        public function addUserId() {
            $this->add([
                'type' => 'hidden',
                'name' => 'user_id'
            ]);
        }

    }