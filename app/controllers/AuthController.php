<?php 
	
	load(['UserForm'] , APPROOT.DS.'form');

	use Form\UserForm;

	class AuthController extends Controller
	{	

		public function __construct()
		{
			$this->user = model('UserModel');
			$this->_form = new UserForm();
		}

		public function index()
		{
			return $this->login();
		}

		public function login()
		{
			if(isSubmitted())
			{
				$post = request()->posts();
				$res = $this->user->authenticate($post['username'] , $post['password']);

				if(!$res) {
					Flash::set($this->user->getErrorString() , 'danger', 'flash-login-message');
					return request()->return();
				}else
				{
					Flash::set("Welcome Back !" . auth('firstname'));
				}

				if(isAdmin()) {
					return redirect('UserController');
				} else {
					return redirect(_route('user:profile'));
				}
			}

			$form = $this->_form;

			$form->init([
				'url' => _route('auth:login')
			]);

			$form->customSubmit('Login' , 'submit' , ['class' => 'btn btn-primary btn-sm']);

			$data = [
				'title' => 'Login Page',
				'form'  => $form
			];

			return $this->view('auth/login' , $data);
		}

		public function logout()
		{
			session_destroy();
			Flash::set('Successfully logged-out', '', 'flash-login-message');
			return redirect( _route('page:index') );
		}
	}