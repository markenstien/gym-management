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

                    if(!upload_empty('default_picture')) {
                        $uploaderHelper1 = new UploaderHelper();
                        $uploaderHelper1->setPath(PATH_UPLOAD);
                        $uploaderHelper1->setOnlyValidExtensions([
                            'jpg','jpeg','png','bitmap',
                            'mp4','WMV','MOV','FLV'
                        ]);

                        $uploaderHelper1->setFile('default_picture');
                        $uploadOkay = $uploaderHelper1->upload();

                        if(!$uploadOkay) {
                            Flash::set(implode(',', $uploaderHelper1->getErrors()), 'danger');
                            return request()->return();
                        }
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

                        if(isset($uploaderHelper1)) {
                            $this->_attachmentModel->uploadByHelperClass([
                                'global_key' => 'ASSET_FILE_ICON',
                                'global_id'  => $assetId,
                                'created_by' => whoIs('id')
                            ], $uploaderHelper1);
                        }
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
            $this->data['req'] = $req;

            return $this->view('asset_management/create', $this->data);
        }
        

        public function edit($id) {
            $req = request()->inputs();

            if(isSubmitted()) {
                $post = request()->posts();

                if(!upload_empty('file')) {
                    $uploaderHelper1 = new UploaderHelper();
                    $uploaderHelper1->setPath(PATH_UPLOAD);
                    $uploaderHelper1->setOnlyValidExtensions([
                        'jpg','jpeg','png','bitmap',
                        'mp4','WMV','MOV','FLV'
                    ]);

                    $uploaderHelper1->setFile('file');
                    $uploadOkay = $uploaderHelper1->upload();

                    if(!$uploadOkay) {
                        Flash::set(implode(',', $uploaderHelper1->getErrors()), 'danger');
                        return request()->return();
                    }
                }

                if(!upload_empty('default_picture')) {
                    $uploaderHelper2 = new UploaderHelper();
                    $uploaderHelper2->setPath(PATH_UPLOAD);
                    $uploaderHelper2->setOnlyValidExtensions([
                        'jpg','jpeg','png','bitmap',
                        'mp4','WMV','MOV','FLV'
                    ]);

                    $uploaderHelper2->setFile('default_picture');
                    $uploadOkay = $uploaderHelper2->upload();

                    if(!$uploadOkay) {
                        Flash::set(implode(',', $uploaderHelper2->getErrors()), 'danger');
                        return request()->return();
                    }
                }

                $resp = $this->model->update([
                    'title' => $post['title'],
                    'description' => $post['description'],
                    'is_active' => true,
                    'asset_category' => $post['asset_category']
                ], $id);

                if($resp) {
                    Flash::set("File Updated");
                    $this->_attachmentModel->path = PATH_UPLOAD;
                    $this->_attachmentModel->url  = GET_PATH_UPLOAD;

                    if(isset($uploaderHelper1)) {
                        $resp = $this->_attachmentModel->deleteWithFile([
                            'global_id' => $id,
                            'global_key' => 'ASSET_FILE'
                        ]);

                        $this->_attachmentModel->uploadByHelperClass([
                            'global_key' => 'ASSET_FILE',
                            'global_id'  => $id,
                            'created_by' => whoIs('id')
                        ], $uploaderHelper1);
                    }
                    

                    if(isset($uploaderHelper2)) {
                        $this->_attachmentModel->deleteWithFile([
                            'global_id' => $id,
                            'global_key' => 'ASSET_FILE_ICON'
                        ]);

                        $this->_attachmentModel->uploadByHelperClass([
                            'global_key' => 'ASSET_FILE_ICON',
                            'global_id'  => $id,
                            'created_by' => whoIs('id')
                        ], $uploaderHelper2);
                    }
                }
            }

            $asset = $this->model->get([
                'asset.id' => $id
            ]);
            
            $this->form->setValueObject($asset);

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
            $this->data['req'] = $req;
            $this->data['asset'] = $asset;
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