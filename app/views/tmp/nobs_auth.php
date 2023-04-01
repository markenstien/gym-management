<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo COMPANY_NAME?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="<?php echo _path_tmp('non_bs/assets/css/core.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo _path_tmp('non_bs/assets/css/widgets.css') ?>" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
</head>
<body>
<div class="menu-wrapper">
  <div id="menu">
    <ul>
      <li class="active"><a href="<?php echo _route('user:members', null)?>"">Members</a></li>
      <li><a href="<?php echo _route('user:instructors', null)?>">Instructors</a></li>
      <li><a href="<?php echo _route('instructor-session:index', null)?>">Instructor Sessions</a></li>
      <li><a href="<?php echo _route('payment:index')?>">Payments</a></li>
      <li><a href="<?php echo _route('session:create')?>">Sessions</a></li>
      <li><a href="#">Others</a></li>
    </ul>
    <?php echo wLinkDefault(_route('auth:logout'), 'Logout')?>
  </div>
</div>
<div id="logo">
  <h1><a href="#"><?php echo COMPANY_NAME?></a></h1>
  <h2><a href="#">The fitness company</a></h2>
</div>
<div id="content">
  <?php echo produce('content')?>
</div>
<div id="footer">
  <p id="legal">Copyright &copy; 2007 Criterion. All Rights Reserved. Designed by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>.</p>
  <p id="links"><a href="#">Home</a> | <a href="#">Terms of Use</a></p>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js" integrity="sha512-qzrZqY/kMVCEYeu/gCm8U2800Wz++LTGK4pitW/iswpCbjwxhsmUwleL1YXaHImptCHG0vJwU7Ly7ROw3ZQoww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.4/datatables.min.js"></script>
<?php produce('scripts')?>
</body>
</html>
