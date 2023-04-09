<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo COMPANY_NAME?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="<?php echo _path_tmp('non_bs/assets/css/core.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo _path_tmp('non_bs/assets/css/widgets.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo _path_tmp('non_bs/assets/css/main.css') ?>" rel="stylesheet" type="text/css" />
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
      <li>
          <a href="#" id="nav_other_toggle">Others</a>
          
      </li>
    </ul>
  </div>
</div>

<div id="sub_menu_container">
  <ul class="nav-sub-menu">
    <li><a href="#">Something</a></li>
    <li><a href="#">Someone</a></li>
    <li><a href="#">360 View</a></li>
  </ul>
</div>

<div id="sub_menu">
  <div>
    User : <?php echo whoIs(['firstname' ,'lastname'])?> @ <?php echo whoIs('user_type')?>
    <div class="align-right">
      <?php echo wLinkDefault(_route('auth:logout'), 'Logout')?>
    </div>
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
<script src="<?php echo _path_public('js/core.js')?>"></script>
<script src="<?php echo _path_public('js/global.js')?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js" integrity="sha512-qzrZqY/kMVCEYeu/gCm8U2800Wz++LTGK4pitW/iswpCbjwxhsmUwleL1YXaHImptCHG0vJwU7Ly7ROw3ZQoww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.4/datatables.min.js"></script>
<?php produce('scripts')?>


<script type="text/javascript">
  $(document).ready(function(){
    $('#nav_other_toggle').click(function(){
      $("#sub_menu_container").toggle();
    });
  });
</script>
</body>
</html>
