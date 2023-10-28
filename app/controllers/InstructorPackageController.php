<?php

    use Form\PackageForm;
    load(['PackageForm'], FORMS);

    class InstructorPackageController extends Controller
    {
        private $instructorPackageModel;
        private $form;

        public function __construct()
        {
            parent::__construct();
            _requireAuth();
            $this->instructorPackageModel = model('InstructorPackageModel');
            $this->form = new PackageForm();
            $this->data['form'] = $this->form;
        }

        public function index() {
            $this->data['packages'] = $this->instructorPackageModel->getAll([
                'order' => 'package_name asc'
            ]);
            return $this->view('instructor_package/index', $this->data);
        }

        public function edit($id) {
            $req = request()->inputs();

            if(isSubmitted()) {
                $post = request()->posts();
                $isUpdated = $this->instructorPackageModel->update(
                    $this->instructorPackageModel->getFillablesOnly($post),
                    $post['id']
                );

                if($isUpdated) {
                    Flash::set('Package Updated!');
                } else {
                    Flash::set('Unable to update Package', 'danger');
                }
                
                return redirect(_route('package:index'));
            }

            $package = $this->instructorPackageModel->get($id);
            $this->data['package'] = $package;
            $this->form->setValueObject($package);
            $this->form->addId($id);

            $this->data['form'] = $this->form;
            
            return $this->view('instructor_package/edit', $this->data);
        }

        public function create() {
            $req = request()->inputs();
            if(isSubmitted()) {
                $post = request()->posts();
                $packageId = $this->instructorPackageModel->store(
                    $this->instructorPackageModel->getFillablesOnly($post)
                );

                if($packageId) {
                    Flash::set("Package {$post['package_name']} has been created.");
                    return redirect(_route('package:index'));
                } else {
                    Flash::set("Something went wrong", 'danger');
                    return request()->return();
                }
            }
            $this->data['form'] = $this->form;
            return $this->view('instructor_package/create', $this->data);
        }
    }