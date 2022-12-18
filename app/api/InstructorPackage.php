<?php 

    class InstructorPackage extends Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->model = model('InstructorPackageModel');
        }

        public function get_package() {
            $req = request()->inputs();
            $package = $this->model->get($req['packageID']);
            echo json_encode($package);
        }
    }