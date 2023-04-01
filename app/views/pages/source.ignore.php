<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo COMPANY_NAME?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="<?php echo _path_tmp('non_bs/assets/css/core.css') ?>" rel="stylesheet" type="text/css" />
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
  <div id="sidebar">
    <div id="login" class="boxed">
      <h2 class="title">Client Account</h2>
      <div class="content">
        <form id="form1" method="post" action="#">
          <fieldset>
          <legend>Sign-In</legend>
            <label for="inputtext1">Client ID:</label>
            <input id="inputtext1" type="text" name="inputtext1" value="" />
            <label for="inputtext2">Password:</label>
            <input id="inputtext2" type="password" name="inputtext2" value="" />
            <input id="inputsubmit1" type="submit" name="inputsubmit1" value="Sign In" />
            <p><a href="#">Forgot your password?</a></p>
          </fieldset>
        </form>
      </div>
    </div>
    <div id="updates" class="boxed">
      <h2 class="title">Recent Updates</h2>
      <div class="content">
        <ul>
          <li>
            <h3>March 5, 2007</h3>
            <p><a href="#">In posuere eleifend odio quisque semper augue mattis wisi maecenas ligula&#8230;</a></p>
          </li>
          <li>
            <h3>March 3, 2007</h3>
            <p><a href="#">Quisque dictum integer nisl risus, sagittis convallis, rutrum id, congue, and nibh&#8230;</a></p>
          </li>
          <li>
            <h3>February 28, 2007</h3>
            <p><a href="#">Donec leo, vivamus fermentum nibh in augue praesent a lacus at urna congue rutrum&#8230;</a></p>
          </li>
          <li>
            <h3>February 25, 2007</h3>
            <p><a href="#">Nam pede erat, porta eu, lobortis eget, tempus et, tellus. Etiam nequea&#8230;</a></p>
          </li>
          <li>
            <h3>February 20, 2007</h3>
            <p><a href="#">Vivamus fermentum nibh in augue. Praesent a lacus at urna congue rutrum. Nulla enim eros&#8230;</a></p>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div id="main">
    <div id="welcome" class="post">
      <h2 class="title">Welcome to <?php echo COMPANY_NAME?></h2>
      <div class="story">
        <p><strong><?php echo COMPANY_NAME?></strong> In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>
      </div>
    </div>
    <div id="example" class="post">
      <h2 class="title">Examples of Common Tags</h2>
      <div class="story">
        <p>This is an example of a paragraph followed by a blockquote. In posuere  eleifend odio. Quisque semper augue mattis wisi. Maecenas ligula.  Pellentesque viverra vulputate enim. Aliquam erat volutpat lorem ipsum  dolorem.</p>
        <blockquote>
          <p>&ldquo;Pellentesque tristique ante ut  risus. Quisque dictum. Integer nisl risus, sagittis convallis, rutrum  id, elementum congue, nibh. Suspendisse dictum porta lectus. Donec  placerat odio.&rdquo;</p>
        </blockquote>
        <h3>Heading Level Three</h3>
        <p>This is another example of a paragraph followed by an unordered list. In posuere  eleifend odio. Quisque semper augue mattis wisi. Maecenas ligula.  Pellentesque viverra vulputate enim. Aliquam erat volutpat lorem ipsum  dolorem.</p>
        <p>An ordered list example:</p>
        <ol>
          <li>List item number one</li>
          <li>List item number two</li>
          <li>List item number thre</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div id="footer">
  <p id="legal">Copyright &copy; 2007 Criterion. All Rights Reserved. Designed by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>.</p>
  <p id="links"><a href="#">Home</a> | <a href="#">Terms of Use</a></p>
</div>
</body>
</html>
