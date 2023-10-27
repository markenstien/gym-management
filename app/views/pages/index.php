
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
									<a href="index.html">Home</a>
								</li>
								<li><a href="schedule.html">Programs</a></li>
								<li><a href="schedule.html">Gallery</a></li>
								<li><a href="trainer.html">Contact</a></li>
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
								<span><a class="btn btn-primary" href="#">Start Your Journey</a></span>
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
					<div class="col-md-8 col-md-offset-2">
						<div class="heading-section text-center animate-box">
							<h2>Programs</h2>
						</div>
					</div>
				</div>
				<div class="row animate-box">
					<div class="row text-center">
						<div class="col-md-12 schedule-container">
							<div class="schedule-content active" data-day="sunday">
								<div class="col-md-3 col-sm-6">
									<div class="program program-schedule">
										<img src="<?php echo _path_tmp('landing/images/fit-dumbell.svg')?>" alt="Cycling">
										<small>06AM-7AM</small>
										<h3>Body Building</h3>
										<span>John Doe</span>
									</div>
								</div>
								<div class="col-md-3 col-sm-6">
									<div class="program program-schedule">
										<img src="<?php echo _path_tmp('landing/images/fit-yoga.svg')?>" alt="">
										<small>06AM-7AM</small>
										<h3>Yoga Programs</h3>
										<span>James Smith</span>
									</div>
								</div>
								<div class="col-md-3 col-sm-6">
									<div class="program program-schedule">
										<img src="<?php echo _path_tmp('landing/images/fit-cycling.svg')?>" alt="">
										<small>06AM-7AM</small>
										<h3>Cycling Program</h3>
										<span>Rita Doe</span>
									</div>
								</div>
								<div class="col-md-3 col-sm-6">
									<div class="program program-schedule">
										<img src="<?php echo _path_tmp('landing/images/fit-boxing.svg')?>" alt="Cycling">
										<small>06AM-7AM</small>
										<h3>Boxing Fitness</h3>
										<span>John Dose</span>
									</div>
								</div>
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
		<div id="fh5co-team-section" class="fh5co-lightgray-section">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="heading-section text-center animate-box">
							<h2>Contact Form</h2>
						</div>
						<div class="card">
							<div class="card-body">
								<div class="form-group">
									<?php
										Form::label('Name');
										Form::text('name','', [
											'class' => 'form-control',
											'required' => true
										]);
									?>
								</div>
								<div class="form-group">
									<?php
										Form::label('Email');
										Form::text('email','', [
											'class' => 'form-control',
											'required' => true
										]);
									?>
								</div>
								<div class="form-group">
									<?php
										Form::label('Mobile Number');
										Form::number('mobile','', [
											'class' => 'form-control',
											'required' => true
										]);
									?>
								</div>

								<div class="form-group">
									<?php
										Form::label('Message');
										Form::textarea('message','', [
											'class' => 'form-control',
											'required' => true,
											'rows' => 3
										]);
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="fh5co-blog-section">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="col-md-12">
							<div class="heading-section animate-box">
								<h2>Galleries</h2>
							</div>
						</div>
					</div>
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
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics.</p>
						</div>

						<div class="col-md-4 animate-box">
							<h3 class="section-title">Our Address</h3>
							<ul class="contact-info">
								<li><i class="icon-map-marker"></i>198 West 21th Street, Suite 721 New York NY 10016</li>
								<li><i class="icon-phone"></i>+ 1235 2355 98</li>
								<li><i class="icon-envelope"></i><a href="#">info@yoursite.com</a></li>
								<li><i class="icon-globe2"></i><a href="#">www.yoursite.com</a></li>
							</ul>
						</div>
						<div class="col-md-4 animate-box">
							<h3 class="section-title">Drop us a line</h3>
							<form class="contact-form">
								<div class="form-group">
									<label for="name" class="sr-only">Name</label>
									<input type="name" class="form-control" id="name" placeholder="Name">
								</div>
								<div class="form-group">
									<label for="email" class="sr-only">Email</label>
									<input type="email" class="form-control" id="email" placeholder="Email">
								</div>
								<div class="form-group">
									<label for="message" class="sr-only">Message</label>
									<textarea class="form-control" id="message" rows="7" placeholder="Message"></textarea>
								</div>
								<div class="form-group">
									<input type="submit" id="btn-submit" class="btn btn-send-message btn-md" value="Send Message">
								</div>
							</form>
						</div>
					</div>
					<div class="row copy-right">
						<div class="col-md-6 col-md-offset-3 text-center">
							<p class="fh5co-social-icons">
								<a href="#"><i class="icon-twitter2"></i></a>
								<a href="#"><i class="icon-facebook2"></i></a>
								<a href="#"><i class="icon-instagram"></i></a>
								<a href="#"><i class="icon-dribbble2"></i></a>
								<a href="#"><i class="icon-youtube"></i></a>
							</p>
							<p>Copyright 2016 Free Html5 <a href="#">Fitness</a>. All Rights Reserved. <br>Made with <i class="icon-heart3"></i> by <a href="http://freehtml5.co/" target="_blank">Freehtml5.co</a> / Demo Images: <a href="https://unsplash.com/" target="_blank">Unsplash</a></p>
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

