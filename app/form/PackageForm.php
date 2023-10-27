<?php 
    namespace Form;
    use Core\Form;

    load(['Form'], CORE);

    class PackageForm extends Form
    {

        public function __construct()
        {
            parent::__construct();
            $this->addPackageName();
            $this->addPrice();
            $this->addSession();
            $this->addIsInstructed();
            $this->addIsMember();
        }

        public function addPackageName() {
            $this->add([
                'name' => 'package_name',
                'type' => 'text',
                'class' => 'form-control',
                'required' => true,
                'options' => [
                    'label' => 'Package Name'
                ]
            ]);
        }

        public function addPrice() {
            $this->add([
                'name' => 'price',
                'type' => 'number',
                'class' => 'form-control',
                'required' => true,
                'options' => [
                    'label' => 'Price'
                ]
            ]);
        }

        public function addSession() {
            $this->add([
                'name' => 'sessions',
                'type' => 'number',
                'class' => 'form-control',
                'required' => true,
                'options' => [
                    'label' => 'Number of Sessions'
                ]
            ]);
        }

        public function addIsInstructed() {
            $this->add([
                'name' => 'is_instructed',
                'type' => 'select',
                'options' => [
                    'label' => 'Package Mode',
                    'option_values' => [
                        1 => 'Instructed',
                        0 => 'Non-Instructed'
                    ]
                ],
                'class' => 'form-control',
                'required' => true,
                'attributes' => [
                    'id' => 'is_instructed'
                ]
            ]);
        }

        public function addIsMember() {
            $this->add([
                'name' => 'is_member',
                'type' => 'select',
                'options' => [
                    'label' => 'Membership Status',
                    'option_values' => [
                        1 => 'Member',
                        0 => 'Non Member'
                    ]
                ],
                'class' => 'form-control',
                'required' => true,
                'attributes' => [
                    'id' => 'is_member'
                ]
            ]);
        }
    }