<?php 

    class AssetManagement extends Controller
    {
        public $model;

        public function __construct()
        {
            parent::__construct();
            _requireAuth();
            $this->model = model('AssetManagementModel');
        }

        public function get() {
            $req = request()->inputs();
            $asset = $this->model->get([
                'asset.id' => $req['id']
            ]);

            if($asset) {
                $asset->fileType = wExtensionType($asset->file_type);
            }
            echo json_encode($asset);
        }
    }