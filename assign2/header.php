<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>CabsOnline</title>
    <link rel="stylesheet" type="text/css" href="asset/style/style.css">
    <script type="text/javascript" src="asset/js/jquery.js"></script>
    <script type="text/javascript" src="asset/js/amazeui.js"></script>
    <script type="text/javascript" src="asset/js/main.js"></script>
  </head>
  <body>
    <div class="am-g am-nav-bg-color-primary">
      <div class="am-container am-cf">
      	<h1 class="am-fl am-icon-paper-plane am-header-font-color" style="margin-top: 12px;"> CabsOnline</h1>
      	<ul class="am-fr am-nav am-nav-pills">
          <?php
          echo '<li'.(basename($_SERVER['PHP_SELF']) == 'index.php' ? ' class="am-active"' : '').'><a href="index.php">Login</a></li>';
          echo '<li'.(basename($_SERVER['PHP_SELF']) == 'signup.php' ? ' class="am-active"' : '').'><a href="signup.php">Sign up</a></li>';
          ?>
        </ul>
      </div>
    </div>
