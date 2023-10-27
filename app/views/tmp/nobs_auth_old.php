<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo COMPANY_NAME?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="<?php echo _path_tmp('non_bs/assets/css/core.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo _path_tmp('non_bs/assets/css/widgets.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo _path_tmp('non_bs/assets/css/main.css') ?>" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.2.0/css/all.min.css">
<style type="text/css">
  .hidden{
    display: none;
  }
</style>
<?php produce('styles')?>
</head>
<body>
<div class="menu-wrapper">
  <div id="menu">
    <ul>
      <?php if(isAdmin() || isInstructor()) :?>
        <?php if(isAdmin()) :?>
          <li><a href="<?php echo _route('session:create')?>">Sessions</a></li>
          <li><a href="<?php echo _route('program:index', null)?>">Programs</a></li>
        <?php else:?>
          <li><a href="<?php echo _route('asset-management:create')?>">Assets</a></li>
        <?php endif?>
      <?php endif ?>
      <?php if(isAdmin()) :?>
        <li><a href="<?php echo _route('user:members', null)?>">Members</a></li>
        <li><a href="<?php echo _route('user:instructors', null)?>">Instructors</a></li>
      <?php endif?>
      <li><a href="<?php echo _route('payment:index')?>">Payments</a></li>
      <li>
          <a href="#" id="nav_other_toggle">Others</a>
      </li>
    </ul>
  </div>
</div>

<div id="sub_menu_container">
  <ul class="nav-sub-menu">
    <?php if(isAdmin()) :?>
      <li><a href="<?php echo _route('user:index')?>">User</a></li>
    <?php endif?>
    <li><a href="<?php echo _route('package:index')?>">Packages And Program</a></li>
    <li><a href="<?php echo _route('user-program:index')?>">My Programs</a></li>
    <li><a href="https://panorama.gymmgmt.online/">360 View</a></li>
  </ul>
</div>

<div id="sub_menu">
  <div>
    User : <?php echo wLinkDefault(_route('user:profile'), whoIs(['firstname' ,'lastname']))?>@<?php echo whoIs('user_type')?> 
    &nbsp; <?php echo wLinkDefault(_route('auth:logout'), 'Logout')?>
  </div>
</div>
<div id="content">
  <?php echo produce('content')?>
</div>

<div id="logo">
  <h1><a href="#"><?php echo COMPANY_NAME?></a></h1>
  <h2><a href="#">The fitness company</a></h2>
</div>

<div id="footer">
  <p id="legal">Copyright &copy; <?php echo date('Y')?> All Rights Reserved</a>.</p>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js" integrity="sha512-qzrZqY/kMVCEYeu/gCm8U2800Wz++LTGK4pitW/iswpCbjwxhsmUwleL1YXaHImptCHG0vJwU7Ly7ROw3ZQoww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.4/datatables.min.js"></script>

<script src="<?php echo _path_public('js/core.js')?>"></script>
<script src="<?php echo _path_public('js/global.js')?>"></script>
<?php produce('scripts')?>


<script type="text/javascript">
  $(document).ready(function(){
    $('#nav_other_toggle').click(function(){
      $("#sub_menu_container").toggle();
    });

    $(".btn-close").click(function(){
      $(this).parent().remove();
    });

    $(".el-toggler").click(function() {
      let target = $(this).data('target');
      $(target).toggle();
    });
  });
</script>
</body>
</html>
