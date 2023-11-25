<?php 
	load(['UserForm'] , APPROOT.DS.'form');
	use Form\UserForm;
	use Services\UserService;

	class UserController extends Controller
	{
		public $paymentModel,$instructorCommissionModel,
		$programModel, $programParticipantModel,
		$sessionModel, $sessionRemarkModel,$workoutSetBuilder;
		
		public function __construct()
		{
			parent::__construct();
			_requireAuth();
			$this->model = model('UserModel');
			$this->data['page_title'] = ' Users ';
			$this->data['user_form'] = new UserForm();

			$this->paymentModel = model('PaymentModel');
            $this->instructorCommissionModel = model('InstructorCommissionModel');
			$this->programModel = model('ProgramModel');
			$this->programParticipantModel = model('ProgramParticipantModel');
			$this->sessionModel = model('SessionModel');
			$this->sessionRemarkModel = model('SessionRemarkModel');

			$this->workoutSetBuilder = model('WorkoutSetBuilderModel');
		}

		public function index()
		{
			$params = request()->inputs();

			if(!empty($params))
			{
				$params['is_active'] = true;
				$this->data['users'] = $this->model->getAll([
					'where' => $params
				]);
			}else{
				$this->data['users'] = $this->model->getAll([
					'where' => [
						'is_active' => true
					]
				]);
			}
			
			$this->data['content_title'] = "TITLE";
			
			return $this->view('user/index' , $this->data);
		}

		public function create()
		{
			$req = request()->inputs();

			if(isSubmitted()) {
				$post = request()->posts();
				$user_id = $this->model->create($post , 'profile');
				if(!$user_id){
					Flash::set( $this->model->getErrorString() , 'danger');
					return request()->return();
				}

				Flash::set('User Record Created');
				if( isEqual($post['user_type'] , 'patient') )
				{
					Flash::set('Patient Record Created');
					return redirect(_route('patient-record:create' , null , ['user_id' => $user_id]));
				}

				return redirect( _route('user:show' , $user_id , ['user_id' => $user_id]) );
			}
			$this->data['user_form'] = new UserForm('userForm');

			return $this->view('user/create' , $this->data);
		}

		public function members() {
			$this->data['users'] = $this->model->getAll([
				'where' => [
					'user_type' => UserService::MEMBER
				]
			]);

			$this->data['content_title'] = 'Members';
			return $this->view('user/index', $this->data);
		}

		public function staffs() {
			$this->data['users'] = $this->model->getAll([
				'where' => [
					'user_type' => UserService::STAFF
				]
			]);
			$this->data['content_title'] = 'Staffs';
			return $this->view('user/index', $this->data);
		}

		public function instructors() {
			$this->data['users'] = $this->model->getAll([
				'where' => [
					'user_type' => UserService::INSTRUCTOR
				]
			]);
			$this->data['content_title'] = 'Instructors';
			return $this->view('user/index', $this->data);
		}

		public function addToMember($userId) {
			$req = request()->inputs();
			if(isSubmitted()) {
				$post = request()->posts();
				$isMember = $this->model->toMember($post['user_id'], $post['months']);
				$user = $this->model->get($post['user_id']);

				if ($isMember) {
					Flash::set("User updated as member");
					$paymentID = $this->paymentModel->createOrUpdate([
						'order_id' => $post['user_id'],
						'payer_name' => $user->firstname . ' ' . $user->lastname,
						'payment_key' => 'MEMBERSHIP_PAYMENT',
						'amount' => $post['amount'],
						'payment_method' => $post['payment_method'],
						'payer_name' => $user->firstname . ' '.$user->lastname
					]);
					
					if (!upload_empty('image')) {
						$this->_attachmentModel->upload([
							'display_name' => 'Membership Payment',
							'global_key' => 'MEMBERSHIP_PAYMENT',
							'global_id'  => $paymentID
						], 'image');
					}
					return redirect(_route('user:show', $user->id));
				}
			}
			$this->data['user'] = $this->model->get($userId);
			//include payment form
			return $this->view('user/add_to_member', $this->data);
		}

		public function edit($id)
		{
			if(isSubmitted()) {
				$post = request()->posts();
				$post['profile'] = 'profile';
				$res = $this->model->update($post , $post['id']);

				if($res) {
					Flash::set($this->model->getMessageString());
					return redirect(_route('user:show' , $id) );
				}else
				{
					Flash::set( $this->model->getErrorString() , 'danger');
					return request()->return();
				}
			}

			$user = $this->model->get($id);

			$this->data['id'] = $id;
			$this->data['user_form']->init([
				'url' => _route('user:edit',$id)
			]);

			$this->data['user_form']->setValueObject($user);
			$this->data['user_form']->addId($id);
			$this->data['user_form']->remove('submit');
			$this->data['user_form']->add([
				'name' => 'password',
				'type' => 'password',
				'class' => 'form-control',
				'options' => [
					'label' => 'Password'
				]
			]);

			if(!isEqual(whoIs('user_type'), 'admin'))
				$this->data['user_form']->remove('user_type');
			$this->data['user'] = $user;
			return $this->view('user/edit' , $this->data);
		}

		public function show($id)
		{
			$user = $this->model->get($id);

			if(!$user) {
				Flash::set(" This user no longer exists " , 'warning');
				return request()->return();
			}

			$this->data['user'] = $user;
			if(isEqual($user->user_type, UserService::MEMBER)) {
				$this->data['sessions'] = $this->sessionModel->getAll([
					'where' => [
						'member_id' => $id
					]
				]);
			}

			$this->data['payments'] = $this->paymentModel->all([
				'order_id' => $id
			]);

			if(isEqual($user->user_type, UserService::INSTRUCTOR)) {
				$this->data['students'] =$this->sessionModel->getAll([
					'where' => [
						'instructor_id' => $id
					]
				]);
			}

			$this->_attachmentForm->setValue('global_id', $user->id);
			$this->_attachmentForm->setValue('global_key', 'user_files');
			$this->data['attachmentForm'] = $this->_attachmentForm;

			$this->data['user_files'] = $this->_attachmentModel->all([
				'global_id' => $user->id,
				'global_key' => 'user_files'
			]);

			return $this->view('user/show' , $this->data);
		}

		public function progress($id) {
			$user = $this->model->get($id);
			$this->data['sessionRemarks'] = $this->sessionRemarkModel->getAll([
				'where' => [
					'sr.member_id' => $user->id
				],
				'order' => 'sr.id desc'
			]);

			$this->data['progress'] = [
				'Sun' => $this->workoutSetBuilder->get([
					'schedule' => 'Sun',
					'user_id'  => whoIs('id')
				]),
				'Mon' => $this->workoutSetBuilder->get([
					'schedule' => 'Mon',
					'user_id'  => whoIs('id')
				]),
				'Tue' => $this->workoutSetBuilder->get([
					'schedule' => 'Tue',
					'user_id'  => whoIs('id')
				]),
				'Wed' => $this->workoutSetBuilder->get([
					'schedule' => 'Wed',
					'user_id'  => whoIs('id')
				]),
				'Thu' => $this->workoutSetBuilder->get([
					'schedule' => 'Thu',
					'user_id'  => whoIs('id')
				]),
				'Fri' => $this->workoutSetBuilder->get([
					'schedule' => 'Fri',
					'user_id'  => whoIs('id')
				]),
				'Sat' => $this->workoutSetBuilder->get([
					'schedule' => 'Sat',
					'user_id'  => whoIs('id')
				]),
				'Today' => $this->workoutSetBuilder->get([
					'schedule' => date('D')
				])
			];

			$this->data['user'] = $user;
			
			return $this->view('user/progress', $this->data);
		}

		public function deactivate($id) {
			$this->model->deactivate($id);
			Flash::set("User Deactivated successfully");
			return redirect(_route('user:index'));
		}

		public function sendCredential($id)
		{
			$this->model->sendCredential($id);
			Flash::set("Credentials has been set to the user");
			return request()->return();
		}

		public function profile() {
			return $this->show(whoIs('id'));
		}

		public function fileUpload() {
			$req = request()->inputs();
			if(isSubmitted()) {
				$post = request()->posts();

				dump([
					$post,
					$_FILES
				]);
			}
		}
	}