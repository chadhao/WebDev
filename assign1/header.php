<?php if(session_status()!=2){session_start();} ?>
<!DOCTYPE html>
<!--Header Begin-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Status Posting System</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="amazeui.js"></script>
    </head>
    <body>
	<div class="am-g am-nav-bg-color-primary">
	    <div class="am-container am-cf">
		<h1 class="am-fl am-icon-paper-plane am-header-font-color" style="margin-top: 12px;"> Status Posting System</h1>
		<ul class="am-fr am-nav am-nav-pills">
		    <li<?php echo basename($_SERVER['PHP_SELF'])=='index.php'?' class="am-active"':'' ?>><a href="index.php">Home</a></li>
		    <li<?php echo basename($_SERVER['PHP_SELF'])=='poststatusform.php'?' class="am-active"':'' ?>><a href="poststatusform.php">Post New</a></li>
		    <li><a href="#">Search</a></li>
		    <li><a href="#">About</a></li>
		</ul>
	    </div>
	</div>
<!--Header End-->
