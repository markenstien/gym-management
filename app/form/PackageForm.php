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
    }