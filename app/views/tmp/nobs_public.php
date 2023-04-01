<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo COMPANY_NAME?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="<?php echo _path_tmp('non_bs/assets/css/core.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo _path_tmp('non_bs/assets/css/widgets.css') ?>" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="menu-wrapper">
  <div id="menu">
  <ul>
    <li class="active"><a href="#">Homepage</a></li>
    <li><a href="#">About Us</a></li>
    <li><a href="#">Gallery</a></li>
    <li><a href="#">FAQ</a></li>
  </ul>
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
</body>
</html>
