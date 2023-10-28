<?php
    use Form\AssetForm;
    load(['AssetForm'], FORMS);

    class AssetManagementController extends Controller
    {
        public $form, $uploaderHelper, $model;

        public function __construct()
        {
            parent::__construct();
            _requireAuth();
            $this->form = new AssetForm();
            $this->model = model('AssetManagementModel');
        }

        public function tutorials() {
            $this->data['assets'] = $this->model->getAll([
                'where' => [
                    'asset_category' => 'tutorial'
                ]
            ]);
            return $this->view('asset_management/index', $this->data);
        }

        public function create() {
            $req = request()->inputs();
            if(isSubmitted()){
                $post = request()->posts();

                if(upload_empty('file')) {
                    Flash::set("File must not be empty", 'danger');
                    return request()->return();
                } else {
                    //check file type
                    $uploaderHelper = new UploaderHelper();
                    $uploaderHelper->setPath(PATH_UPLOAD);
                    $uploaderHelper->setOnlyValidExtensions([
                        'jpg','jpeg','png','bitmap',
                        'mp4','WMV','MOV','FLV'
                    ]);

                    $uploaderHelper->setFile('file');
                    $uploadOkay = $uploaderHelper->upload();

                    if(!$uploadOkay) {
                        Flash::set(implode(',', $uploaderHelper->getErrors()), 'danger');
                        return request()->return();
                    }
                    $assetId = $this->model->store([
                        'title' => $post['title'],
                        'description' => $post['description'],
                        'user_id' => $post['user_id'] ?? null,
                        'is_active' => true,
                        'asset_category' => $post['asset_category']
                    ]);

                    if($assetId) {
                        $this->_attachmentModel->path = PATH_UPLOAD;
                        $this->_attachmentModel->url  = GET_PATH_UPLOAD;

                        $this->_attachmentModel->uploadByHelperClass([
                            'global_key' => 'ASSET_FILE',
                            'global_id'  => $assetId,
                            'created_by' => whoIs('id')
                        ], $uploaderHelper);
                    }
                }
                Flash::set('Management Uploaded');
                return redirect(_route('asset-management:create'));
            }

            if(isInstructor()) {
                $this->form->add([
                    'type' => 'hidden',
                    'name' => 'user_id',
                    'value' => whoIs('id')
                ]);
            }

            $this->data['assets'] = $this->model->getAll([
                'where' => [
                    'asset.user_id' => [
                        'condition' => 'in',
                        'value' => [null, whoIs('id')]
                    ]
                ],

                'order' => 'asset.id desc'
            ]);

            $this->data['form'] = $this->form;
            return $this->view('asset_management/create', $this->data);
        }
        

        public function edit($id) {
            $asset = $this->model->get($id);
            dump($asset);
            $this->form->setValueObject($asset);
            return $this->view('asset_management/edit', $this->data);
        }

        public function destroy($id)
        {
            $req = request()->inputs();

            $returnTo = $req['returnTo'] ?? null;

			if( isset( $this->model ))
			{
				$res = $this->model->deleteByKey([
					'id' => $id
				]);

				if(!$res) {
					Flash::set("Delete failed!");
					return false;
				}

                $this->_attachmentModel->deleteWithFile([
                    'global_key' => 'ASSET_FILE',
                    'global_id' => $id
                ]);
				Flash::set( "Deleted succesfully ");
				if(!is_null($returnTo))
					return redirect( unseal($returnTo) ); 
				return request()->return();
			}else
			{
				echo die("PRIMARY MODEL not set , name your primary model as 'model'");
			}
        }
    }