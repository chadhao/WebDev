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
<div class="am-container" id="signupform" style="margin-top: 15px; max-width:600px;">
  <form class="am-form am-form-horizontal">
    <legend>Sign up</legend>

    <div class="am-form-group">
      <label for="name" class="am-u-sm-4 am-form-label">Name</label>
      <div class="am-u-sm-8">
        <input type="text" name="name" id="name" placeholder="Name">
      </div>
    </div>

    <div class="am-form-group">
      <label for="phone" class="am-u-sm-4 am-form-label">Phone</label>
      <div class="am-u-sm-8">
        <input type="text" name="phone" id="phone" placeholder="Phone">
      </div>
    </div>

    <div class="am-form-group">
      <label for="email" class="am-u-sm-4 am-form-label">E-mail</label>
      <div class="am-u-sm-8">
        <input type="text" name="email" id="email" placeholder="E-mail">
      </div>
    </div>

    <div class="am-form-group">
      <label for="password" class="am-u-sm-4 am-form-label">Password</label>
      <div class="am-u-sm-8">
        <input type="password" name="password" id="password" placeholder="Password">
      </div>
    </div>

    <div class="am-form-group">
      <label for="cpassword" class="am-u-sm-4 am-form-label">Confirm Password</label>
      <div class="am-u-sm-8">
        <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password">
      </div>
    </div>

    <div class="am-form-group">
      <div class="am-u-sm-8 am-u-sm-offset-4">
        <button type="button" class="am-btn am-btn-default" onclick="signup()">Sign Up</button>
      </div>
    </div>
  </form>
</div>
<?php include 'footer.php'; ?>
