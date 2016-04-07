<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>VIP Member Management</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/amazeui/2.6.1/css/amazeui.min.css">
</head>
<body>
<form class="am-form" method="post" action="member_add.php">
  <fieldset>
    <legend>Add New Member</legend>

    <div class="am-form-group">
      <label for="fname">First Name</label>
      <input id="fname" name="fname" type="text" placeholder="Please enter first name">
    </div>

    <div class="am-form-group">
      <label for="lname">Last Name</label>
      <input id="lname" name="lname" type="text" placeholder="Please enter last name">
    </div>

    <div class="am-form-group">
      <label for="gender">Gender</label><br>
      <label class="am-radio-inline"><input id="gender" name="gender" type="radio" value="f" checked> Female</label>
      <label class="am-radio-inline"><input id="gender" name="gender" type="radio" value="m"> Male</label>
    </div>

    <div class="am-form-group">
      <label for="email">E-mail</label>
      <input id="email" name="email" type="text" placeholder="Please enter e-mail">
    </div>

    <div class="am-form-group">
      <label for="phone">Phone</label>
      <input id="phone" name="phone" type="text" placeholder="Please enter phone number">
    </div>
    <p><button class="am-btn am-btn-default" type="submit">Submit</button></p>
  </fieldset>
</form>
</body>
</html>
