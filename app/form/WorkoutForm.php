<?php 

    namespace Form;
    use Core\Form;
    load(['Form'], CORE);
    
    class WorkoutForm extends Form {

        public function __construct()
        {
            parent::__construct();

            $this->init([
                'enctype' => 'multipart/form-data',
                'method'  => 'post'
            ]);

            $this->addName();
            $this->addTag();
            $this->addFiles();
        }
        public function addName() {
            $this->add([
                'name' => 'workout_name',
                'type' => 'text',
                'class' => 'form-control',
                'required' => true,
                'options' => [
                    'label' => 'Workout Name'
                ],

                'attributes' => [
                    'placeholder' => 'Eg. Crunches, Sit-ups, Jumping Jacks'
                ]
            ]);
        }

        /**
         * like category
         */
        public function addTag() {
            $this->add([
                'name' => 'workout_tag',
                'type' => 'text',
                'class' => 'form-control',
                'required' => true,
                'options' => [
                    'label' => 'Workout Tag'
                ],
                'attributes' => [
                    'placeholder' => 'Eg. Abs, Core, Leg, Chest'
                ]
            ]);
        }

        public function addFiles() {
            $this->add([
                'name' => 'workout_images[]',
                'type' => 'file',
                'options' => [
                    'label' => 'Workout Pictures'
                ],

                'attributes' => [
                    'multiple' => true
                ]
            ]);
        }
    }