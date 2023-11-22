<?php 
	use Form\UserForm;
	load(['UserForm'], FORMS);
	class TestController extends Controller
	{
		public function index()
		{	

			dump(
				[date('l'),
				date('D'),]
			);
		}
	}