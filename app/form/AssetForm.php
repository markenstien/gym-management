<?php 

    namespace Form;
    use Core\Form;

    load(['Form'], CORE);

    class AssetForm extends Form {

        public function __construct()
        {
            parent::__construct();
            parent::init([
                'method' => 'post',
                'enctype' => 'multipart/form-data'
            ]);
            $this->addTitle();
            $this->adddFile();
            $this->addDescription();
        }

        public function addTitle() {
            $this->add([
                'type' => 'text',
                'name' => 'title',
                'options' => [
                    'label' => 'Asset Title'
                ],
                'class' => 'form-control',
                'required' => true,
                'attributes' => [
                    'id' => 'title'
                ]
            ]);
        }

        /**
         * 1 file at a time
         */
        public function adddFile() {
            $this->add([
                'type' => 'file',
                'name' => 'file',
                'options' => [
                    'label' => 'File Name'
                ]
            ]);
        }
    }