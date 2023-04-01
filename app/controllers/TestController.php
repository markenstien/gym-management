<?php 
	use Form\UserForm;
	load(['UserForm'], FORMS);
	class TestController extends Controller
	{
		public function index()
		{
			$this->data['form'] = new UserForm();
			return $this->view('test/index', $this->data);		
		}
	}