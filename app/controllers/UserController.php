<?php 
	load(['UserForm'] , APPROOT.DS.'form');
	use Form\UserForm;
	use Services\UserService;

	class UserController extends Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->model = model('UserModel');
			$this->data['page_title'] = ' Users ';
			$this->data['user_form'] = new UserForm();

			$this->paymentModel = model('PaymentModel');
            $this->instructorCommissionModel = model('InstructorCommissionModel');
            $this->instructorSessionModel = model('InstructorSessionModel');
            $this->instructorPackageModel = model('InstructorPackageModel');
            $this->userProgramModel = model('UserProgramModel');
		}

		public function index()
		{
			$params = request()->inputs();

			if(!empty($params))
			{
				$this->data['users'] = $this->model->getAll([
					'where' => $params
				]);
			}else{
				$this->data['users'] = $this->model->getAll( );
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
					Flash::set( $this->model->getMessageString());
					return redirect( _route('user:show' , $id) );
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

			$this->data['payments'] = $this->paymentModel->all([
				'order_id' => $user->id
			],'id desc');

			$this->data['user_programs'] = $this->userProgramModel->getAll([
				'where' => [
					'user_program.user_id' => $user->id
				],
				'order' => 'user_program.id desc'
			]);

			if(isMember()) {
				$this->data['sessions'] = $this->instructorSessionModel->getAttendees([
					'where' => [
						'member.id' => $id
					]
				]);
			} else {
				$this->data['sessions'] = $this->instructorSessionModel->getAttendees([
					'where' => [
						'instructor_id' => $id
					]
				]);
			}

			return $this->view('user/show' , $this->data);
		}

		public function progress($id) {
			$user = $this->model->get($id);
		}

		public function sendCredential($id)
		{
			$this->model->sendCredential($id);
			Flash::set("Credentials has been set to the user");
			return request()->return();
		}
	}