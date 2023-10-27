<?php
    namespace Form;

    use Core\Form;
    use Services\UserService;

    load(['Form'], CORE);
    load(['UserService'], SERVICES);

    class ProgramForm extends Form {
        private $packageModel,$userModel;
        public function __construct() {
            parent::__construct();
            $this->addName();
            $this->addPackage();
            $this->addStartDate();
            $this->addInstructor();
            $this->addDescription();
        }

        public function addName() {
            $this->add([
                'name' => 'program_name',
                'type' => 'text',
                'options' => [
                   'label' => 'Program Name' 
                ],
                'class' => 'form-control',
                'required' => true
            ]);
        }

        public function addPackage() {
            if(!isset($this->packageModel)) {
                $this->packageModel = model('InstructorPackageModel');
            }

            $packages = $this->packageModel->getAll();
            $this->add([
                'name' => 'package_id',
                'type' => 'select',
                'options' => [
                   'label' => 'Program Package',
                   'option_values' => arr_layout_keypair($packages, ['id', 'package_name'])
                ],
                'class' => 'form-control',
                'required' => true,
                'attributes' => [
                    'id' => 'package_id'
                ]
            ]);
        }

        public function addStartDate() {
            $this->add([
                'name' => 'start_date',
                'type' => 'date',
                'options' => [
                   'label' => 'Start Date'
                ],
                'class' => 'form-control',
                'required' => true,
                'attributes' => [
                    'id' => 'start_date'
                ]
            ]);
        }
        
        public function addInstructor() {
            if(!isset($this->userModel)) {
                $this->userModel = model('UserModel');
            }

            $instructors = $this->userModel->getAll([
                'where' => [
                    'user_type' => UserService::INSTRUCTOR
                ]
            ]);

            $this->add([
                'name' => 'instructor_id',
                'type' => 'select',
                'options' => [
                   'label' => 'Select Program Instructor',
                   'option_values' => arr_layout_keypair($instructors, ['id', 'firstname@lastname'])
                ],
                'class' => 'form-control',
                'required' => true,
                'attributes' => [
                    'id' => 'instructor'
                ]
            ]);
        }
    }