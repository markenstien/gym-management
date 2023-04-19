<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo COMPANY_NAME?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="<?php echo _path_tmp('non_bs/assets/css/core.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo _path_tmp('non_bs/assets/css/widgets.css') ?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.2.0/css/all.min.css">
<?php echo produce('styles')?>

<style type="text/css">
  .logo {
    margin-bottom: 50px !important;
  }

  .logo .logo-text{
    text-decoration: none;
    font-weight: bold;
    font-size: 12px;
    display: block;
  }
</style>
</head>
<body>
<div class="menu-wrapper">
  <div id="menu">
  <ul>
    <li class="active"><a href="<?php echo _route('page:index')?>">Homepage</a></li>
    <li><a href="#">Gallery</a></li>
    <li><a href="#">FAQ</a></li>
  </ul>
</div>
</div>

<div id="content">
  <div class="logo">
    <img src="<?php echo URL.'/'.'?>public/uploads/gallery/logo.jpg" style="width:70px">
    <a href="#" class="logo-text"><?php echo COMPANY_NAME?></a>
  </div>
  <?php echo produce('content')?>
</div>
<div id="footer">
  <p id="legal">Copyright &copy; <?php echo date('Y')?></p>
</div>
<script src="<?php echo _path_public('js/core.js')?>"></script>
<script src="<?php echo _path_public('js/global.js')?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js" integrity="sha512-qzrZqY/kMVCEYeu/gCm8U2800Wz++LTGK4pitW/iswpCbjwxhsmUwleL1YXaHImptCHG0vJwU7Ly7ROw3ZQoww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php echo produce('scripts')?>
</body>
</html>
