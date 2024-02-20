<?php

	class ViewerController extends Controller
	{
		public function show()
		{
			$file = request()->input('file');
			$file = unseal($file);

			dump($file);
			
			return $this->view('viewer/show' , [
				'file' => $file
			]);
		}
	}