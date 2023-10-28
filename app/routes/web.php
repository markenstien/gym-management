<?php
	
	$routes = [];

	$controller = '/MailerController';
	$routes['mailer'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'send'   => $controller.'/send'
	];

	$controller = '/ViewerController';
	$routes['viewer'] = [
		'index' => $controller.'/index',
		'show' => $controller.'/show',
	];

	$controller = '/UserController';
	$routes['user'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'deactivate' => $controller . '/deactivate',
		'show'   => $controller.'/show',
		'members'   => $controller.'/members',
		'instructors'   => $controller.'/instructors',
		'staffs'   => $controller.'/staffs',
		'sendCredential' => $controller.'/sendCredential',
		'add-to-member' => $controller .'/addToMember',
		'accept' => $controller .'/accept',
		'progress' => $controller . '/progress',
		'profile'  => $controller . '/profile'
	];

	$controller = '/AuthController';
	$routes['auth'] = [
		'login' => $controller.'/login',
		'register' => $controller.'/register',
		'logout' => $controller.'/logout',
	];

	$controller = '/AttachmentController';
	$routes['attachment'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'download' => $controller.'/download',
		'show'   => $controller.'/show'
	];

	$controller = '/PaymentController';
	$routes['payment'] = [
		'index' => $controller.'/index',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show',
	];

	$controller = '/ReceiptController';
	$routes['receipt'] = [
		'index' => $controller.'/index',
		'order' => $controller.'/orderReceipt',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show',
	];


	$controller ='/UserProgramController';
	$routes['user-program'] = [
		'index' => $controller.'/index',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show',
	];

	$controller = '/SessionController';
	$routes['session'] = [
		'index' => $controller.'/index',
		'order' => $controller.'/orderReceipt',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show',
		'students' => $controller.'/students',
		'add-transaction'  => $controller .'/addSessionTransaction',
		'update-daily-session' => $controller . '/updateDailySessions'
	];

	$controller = '/InstructorSessionController';
	$routes['instructor-session'] = [
		'index' => $controller.'/index',
		'order' => $controller.'/orderReceipt',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show',
		'add-attendee' => $controller. '/addAttendee',
		'remove-attendee' => $controller. '/removeAttendee',
		'cancel' => $controller. '/cancel',
		'complete' => $controller. '/complete',
		'accept' => $controller. '/accept',
		'show-attendee' => $controller . '/showAttendee',
		'addImage' => $controller .'/addImage',
		'addFile' => $controller .'/addFile',
		'deleteAsset' => $controller . '/deleteAsset'
	];

	$controller = '/CategoryController';
	$routes['category'] = [
		'create' => $controller.'/create',
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'order' => $controller.'/orderReceipt',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show',
		'logs' => $controller.'/logs',
		'deactivate' => $controller.'/deactivateOrActivate'
	];

	$controller = '/DashboardController';
	$routes['dashboard'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show',
		'update' => $controller.'/update',
		'phyical-examination' => $controller. '/phyicalExamination'
	];

	$controller = '/ReportController';
	$routes['report'] = [
		'index' => $controller.'/index',
		'sales' => $controller.'/salesReport',
		'stocks' => $controller.'/stocksReport',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'download' => $controller.'/download',
		'show'   => $controller.'/show',
		'live'   => $controller.'/live',
		'new'    => $controller.'/new',
		'serve'  => $controller.'/serve',
		'skip'   => $controller.'/skip',
		'complete' => $controller.'/complete',
		'reset'   => $controller.'/reset'
	];

	
	$controller = '/ClassroomController';
	$routes['classroom'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'download' => $controller.'/download',
		'show'   => $controller.'/show',
		'join'   => $controller.'/join',
		'addTeacher' => $controller. '/addTeacher',
		'addStudent' => $controller. '/addStudent',
		'resetJoinCode' => $controller .'/resetJoinCode'
	];

	$controller = '/ClassStudentController';
	$routes['class-student'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'download' => $controller.'/download'
	];

	$controller = '/TaskController';
	$routes['task'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'download' => $controller.'/download',
		'show'   => $controller.'/show'
	];

	$controller = '/TaskSubmissionController';
	$routes['task-sub'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'download' => $controller.'/download',
		'show'   => $controller.'/show'
	];

	$controller = '/FeedController';
	$routes['feed'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'download' => $controller.'/download',
		'show'   => $controller.'/show'
	];

	$controller = '/PagesController';
	$routes['page'] = [
		'index' => $controller.'/index',
		'about' => $controller.'/about',
		'contact' => $controller.'/contact',
		'gallery' => $controller.'/gallery',
		'faq' => $controller.'/faq'
	];


	$controller = '/FormBuilderController';
	$routes['form'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show',
		'add-item' => $controller.'/addItem',
		'edit-item' => $controller. '/editItem',
		'delete-item' => $controller. '/deleteItem',
		'respond'   => '/FormController'.'/respond'
	];

	$controller = '/AssetManagementController';
	$routes['asset-management'] = [
		'index' => $controller.'/index',
		'tutorial' => $controller.'/tutorials',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'download' => $controller.'/download',
		'show'   => $controller.'/show',
	];

	$controller = '/InstructorPackageController';
	$routes['package'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'download' => $controller.'/download',
		'show'   => $controller.'/show'
	];

	$controller = '/ProgramController';
	$routes['program'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'download' => $controller.'/download',
		'show'   => $controller.'/show',
		'add-participant' => $controller .'/addParticipant',
		'start-session' => $controller .'/startSession',
		'show-session' => $controller . '/showSession',
		'students'    => $controller .'/students'
	];

	$controller = '/InstructorCommissionController';
	$routes['instructor-commission'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create'
	];

	return $routes;
?>