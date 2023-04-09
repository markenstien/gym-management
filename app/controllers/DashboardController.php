<?php
	class DashboardController extends Controller
	{
		public function __construct()
		{
			$this->instructorSessionModel = model('InstructorSessionModel');
		}

		public function index()
		{
			$this->data['page_title'] = 'Dashboard';



			$this->member();
		}

		private function member(){

			$sessionInvites = $this->instructorSessionModel->getAttendees([
				'where' => [
					'member.id' => whoIs('id')
				]
			]);

			//for member
			$this->data['sessionInvites'] = $sessionInvites;
			
			return $this->view('dashboard/member', $this->data);
		}
	}