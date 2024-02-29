<?php 
	use Form\UserForm;
	load(['UserForm'], FORMS);

	class PagesController extends Controller
	{
		public function __construct()
		{
			$this->assetModel = model('AssetManagementModel');
			$this->userModel = model('UserModel');
		}
		public function index() {
			$this->data['form'] = new UserForm();

			$this->data['form']->init([
				'method' => 'post',
				'url' => _route('auth:login')
			]);

			$this->data['images'] = $this->assetModel->getAll([
				'where' => [
					'asset_category' => 'display_gallery'
				]
			]);

			$this->data['instructors'] = $this->userModel->getInstructorData();
			return $this->view('pages/index', $this->data);
		}

		public function about() {
			return $this->view('pages/about');
		}

		public function contact() {
			return $this->view('pages/contact');
		}

		public function gallery() {
			return $this->view('pages/gallery');
		}

		public function faq() {
			return $this->view('pages/faq');
		}
	}