<?php 
	use Form\UserForm;
	load(['UserForm'], FORMS);

	class PagesController extends Controller
	{

		public function index() {
			$this->data['form'] = new UserForm();

			$this->data['form']->init([
				'method' => 'post',
				'url' => _route('auth:login')
			]);

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