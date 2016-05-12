<?php
  if (!isset($_SESSION)) {
      session_start();
  }
?>

<html>
  <head>
    <title>Guessing Game</title>
  </head>
  <body>
    <h1>Guessing Game</h1>
    <p style="color:#0000FF;">The hidden number was: <?php echo $_SESSION['rand_number']; ?></p>
    <p><a href="startover.php">Star Over</a></p>
  </body>
</html>
