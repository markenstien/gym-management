<?php
    namespace Form;
    use Core\Form;
    use Services\UserService;

    load(['Form'], CORE);
    load(['UserService'], SERVICES);

    class WorkoutSetForm extends Form {

        public function __construct()
        {
            parent::__construct();
            $this->addName();
            $this->addTag();
            $this->addSchedule();
            $this->addUserId();
            $this->addIsPublic();
            $this->addAssignedTo();
            
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

        public function addIsPublic() {
            $this->add([
                'name' => 'is_public',
                'type' => 'select',
                'class' => 'form-control',
                'options' => [
                    'label' => 'Visibility',
                    'option_values' => [
                        1 => 'Public',
                        0 => 'Private'
                    ]
                ]
            ]);
        }

        public function addAssignedTo() {
            if(!isset($this->userModel)) {
                $this->userModel = model('UserModel');
            }

            $users = $this->userModel->getAll([
                'where' => [
                    'user_type' => UserService::MEMBER
                ]
            ]);
            $userArray = arr_layout_keypair($users,['id', 'firstname@lastname']);

            $this->add([
                'name' => 'is_assigned_to',
                'type' => 'select',
                'class' => 'form-control',
                'options' => [
                    'label' => 'Assigned To',
                    'option_values' => $userArray
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