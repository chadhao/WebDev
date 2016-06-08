<?php
include 'header.php';

if ($_COOKIE['wd_is_loggedin']) {
    if ($_COOKIE['wd_is_admin']) {
        header('Location: admin.htm');
        exit();
    }
    header('Location: booking.htm');
    exit();
}
?>
<div class="am-container" id="loginform" style="margin-top: 15px; max-width:600px;">
  <form class="am-form am-form-horizontal">
    <legend>Login</legend>
    <div class="am-form-group">
      <label for="email" class="am-u-sm-2 am-form-label">E-mail</label>
      <div class="am-u-sm-10">
        <input type="email" name="email" id="email" placeholder="E-mail">
      </div>
    </div>

    <div class="am-form-group">
      <label for="password" class="am-u-sm-2 am-form-label">Password</label>
      <div class="am-u-sm-10">
        <input type="password" name="password" id="password" placeholder="Password">
      </div>
    </div>

    <div class="am-form-group">
      <div class="am-u-sm-10 am-u-sm-offset-2">
        <button type="button" class="am-btn am-btn-default" onclick="login()">Login</button>
      </div>
    </div>
  </form>
</div>
<?php include 'footer.php'; ?>
