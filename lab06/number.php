<?php
  session_start();
  if ( ! isset( $_SESSION['number'] ) ) {
    $_SESSION['number'] = 0;
  }
  $num = $_SESSION['number'];
?>

<html>
  <head>
    <title>Managing Session</title>
  </head>
  <body>
    <h1>Web Development - Lab06</h1>
    <?php
      echo '<p>The number is $num</p>';
    ?>
    <p><a href="numberup.php">Up</a></p>
    <p><a href="numberdown.php">Down</a></p>
    <p><a href="numberreset.php">Reset</a></p>
  </body>
</html>
