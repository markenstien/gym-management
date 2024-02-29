
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $page['title'] ?? COMPANY_NAME?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700,900' rel='stylesheet' type='text/css'>
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="<?php echo _path_tmp('landing/css/animate.css')?>">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="<?php echo _path_tmp('landing/css/icomoon.css')?>">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="<?php echo _path_tmp('landing/css/bootstrap.css')?>">
	<!-- Superfish -->
	<link rel="stylesheet" href="<?php echo _path_tmp('landing/css/superfish.css')?>">

	<link rel="stylesheet" href="<?php echo _path_tmp('landing/css/style.css')?>">


	<!-- Modernizr JS -->
	<script src="<?php echo _path_tmp('landing/js/modernizr-2.6.2.min.js')?>"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<style>
		.box{
			background-color: #fff;
			border: 1px solid #000;
			padding: 20px;
		}
	</style>
	</head>
	<body>
		<div id="fh5co-wrapper">
		<div id="fh5co-page">
		<div id="fh5co-header">
			<header id="fh5co-header-section">
				<div class="container">
					<div class="nav-header">
						<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
						<h1 id="fh5co-logo"><a href="index.html"><span><?php echo COMPANY_NAME?></span></a></h1>
						<nav id="fh5co-menu-wrap" role="navigation">
							<ul class="sf-menu" id="fh5co-primary-menu">
								<li class="active">
									<a href="#">Home</a>
								</li>
								<li><a href="#programs">Programs</a></li>
								<li><a href="#gallery">Gallery</a></li>
							</ul>
						</nav>
					</div>
				</div>
			</header>		
		</div>
		<!-- end:fh5co-header -->
		<div class="fh5co-hero">
			<div class="fh5co-overlay"></div>
			<div class="fh5co-cover" data-stellar-background-ratio="0.5" 
				style="background-image: linear-gradient(rgba(0, 0, 0, 0.527),rgba(0, 0, 0, 0.5)) , 
				url(/public/uploads/gallery/landing_header_background.JPG);">
				<div class="desc animate-box">
					<div class="container">
						<div class="row">
							<div class="col-md-7">
								<h2>Fitness &amp; Health <br>is a <b>Mentality</b></h2>
							</div>

							<div class="col-md-5">
								<div class="box">
									<div class="box-header">
										<h4 class="box-header">Member Login</h4>
									</div>
									<div class="box-content">
										<div style="z-index: 10000;">
											<?php echo Flash::show('flash-login-message', 'B')?>
										</div>
										<?php echo $form->start()?>
										<div class="form-group">
											<?php
												Form::label('Username', 'username', [
													'style' => 'color:#000'
												]);
												Form::text('username', '', [
													'class' => 'form-control',
													'required' => true
												])
											?>
										</div>

										<div class="form-group">
											<?php
												Form::label('Password', 'password', [
													'style' => 'color:#000'
												]);
												Form::password('password', '', [
													'class' => 'form-control',
													'required' => true
												])
											?>
										</div>

										<div class="form-group">
											<?php Form::submit('', 'Login')?>
										</div>
									<?php echo $form->end()?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end:fh5co-hero -->
		<div id="fh5co-schedule-section" class="fh5co-lightgray-section">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2" id="programs">
						<div class="heading-section text-center animate-box">
							<h2>Instructors</h2>
						</div>
					</div>
				</div>
				<div class="row animate-box">
					<div class="row text-center">
						<div class="col-md-12 schedule-container">
							<div class="schedule-content active" data-day="sunday">
								<?php foreach($instructors as $key => $row) :?>
									<div class="col-md-3 col-sm-6">
										<div class="program program-schedule">
											<img src="<?php echo $row->profile ?? _path_tmp('landing/images/fit-dumbell.svg')?>" alt="Cycling">
											<small>06AM-7AM</small>
											<h3><?php echo strtoupper($row->firstname . ' '.$row->lastname) ?></h3>
											<h1 style="margin-top: 10px;" title="Number of Students"><?php echo $row->total_students?></h1>
										</div>
									</div>
								<?php endforeach?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="fh5co-parallax" style="background-image: url(/publuc/tmp/landing/images/home-image-3.jpg);" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 text-center fh5co-table">
						<div class="fh5co-intro fh5co-table-cell animate-box">
							<h1 class="text-center">Commit To Be Fit</h1>
							<p>Talk to us today</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="fh5co-blog-section">
			<div class="container">
				<div class="col-md-12">
					<div class="heading-section animate-box" id="gallery">
						<h2>Galleries</h2>
					</div>
					<div class="row">
						<?php foreach($images as $key => $row) :?>
							<div class="col-md-4">
								<img src="<?php echo $row->full_url?>" alt=""
								style="width: 100%;">
								<p><?php echo $row->description?></p>
							</div>
						<?php endforeach?>
					</div>
				</div>
			</div>
		</div>
		<div id="fh5co-blog-section">
			<div class="container">
				<div class="col-md-12">
					<div class="heading-section animate-box" id="gallery">
						<h2>Gym Preview</h2>
					</div>
					<p>for better experience visit the <a href="https://vividoptical.online/">tour page</a>.</p>
					<iframe src="https://vividoptical.online/" frameborder="0" style="width: 100%; height:50vh"></iframe>
				</div>
			</div>
		</div>
		<!-- fh5co-blog-section -->
		<footer>
			<div id="footer">
				<div class="container">
					<div class="row">
						<div class="col-md-4 animate-box">
							<h3 class="section-title">About Us</h3>
							<p>Don't let your fitness journey hit a dead-end. Join GNG Fitness and keep going strong! You don't have to break your momentum. Keep moving forward with GNG Fitness</p>
						</div>

						<div class="col-md-4 animate-box">
							<h3 class="section-title">Our Address</h3>
							<ul class="contact-info">
								<li><i class="icon-map-marker"></i>3F JMT Bldg. ML Quezon Ext., Antipolo, Philippines, 1870</li>
								<li><i class="icon-phone"></i>09156673716</li>
								<li><i class="icon-envelope"></i><a href="#">gngfitnessgym@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="row copy-right">
						<div class="col-md-6 col-md-offset-3 text-center">
							<p>Copyright <?php echo date('Y')?></p>
						</div>
					</div>
				</div>
			</div>
		</footer>
	

	</div>
	<!-- END fh5co-page -->

	</div>
	<!-- END fh5co-wrapper -->

	<!-- jQuery -->


	<script src="<?php echo _path_tmp('landing/js/jquery.min.js')?>"></script>
	<!-- jQuery Easing -->
	<script src="<?php echo _path_tmp('landing/js/jquery.easing.1.3.js')?>"></script>
	<!-- Bootstrap -->
	<script src="<?php echo _path_tmp('landing/js/bootstrap.min.js')?>"></script>
	<!-- Waypoints -->
	<script src="<?php echo _path_tmp('landing/js/jquery.waypoints.min.js')?>"></script>
	<!-- Stellar -->
	<script src="<?php echo _path_tmp('landing/js/jquery.stellar.min.js')?>"></script>
	<!-- Superfish -->
	<script src="<?php echo _path_tmp('landing/js/hoverIntent.js')?>"></script>
	<script src="<?php echo _path_tmp('landing/js/superfish.js')?>"></script>

	<!-- Main JS (Do not remove) -->
	<script src="<?php echo _path_tmp('landing/js/main.js')?>"></script>

	</body>
</html>

