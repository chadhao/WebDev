<?php
  if (!isset($_SESSION)) {
      session_start();
  }
  if (isset($_SESSION['num_of_guess'])) {
      if (isset($_POST['number'])) {
          if (is_numeric($_POST['number'])) {
              $num = intval($_POST['number']);
              if ($num > 100 || $num < 1) {
                  $_SESSION['msg'] = '<p style="color:#FF0000;">Please enter an integer from 1 to 100!</p>';
              } else {
                  if ($num == $_SESSION['rand_number']) {
                      $_SESSION['msg'] = '<p style="color:#00FF00;">Congratulations! You guessed the hidden number '.$num.'!</p>';
                      $_SESSION['win'] = true;
                  } elseif ($num > $_SESSION['rand_number']) {
                      $_SESSION['msg'] = '<p style="color:#0000FF;">You guess '.$num.' is higher then the hidden number.</p>';
                  } else {
                      $_SESSION['msg'] = '<p style="color:#0000FF;">You guess '.$num.' is lower then the hidden number.</p>';
                  }
                  ++$_SESSION['num_of_guess'];
              }
          } else {
              $_SESSION['msg'] = '<p style="color:#FF0000;">Please enter an integer from 1 to 100!</p>';
          }
      }
  } else {
      $_SESSION['num_of_guess'] = 0;
      $_SESSION['win'] = false;
      $_SESSION['rand_number'] = rand(1, 100);
  }
?>

<html>
  <head>
    <title>Guessing Game</title>
  </head>
  <body>
    <h1>Guessing Game</h1>
    <p>Enter a number between 1 and 100,<br>then press the Guess button.</p>
    <form method="post" action="guessinggame.php">
      <input type="text" id="number" name="number">
      <button type="submit" <?php echo $_SESSION['win'] ? 'disabled' : ''; ?>>Guess</button>
    </form>
    <?php
    echo !empty($_SESSION['msg']) ? $_SESSION['msg'] : '';
    echo '<p>Number of guesses: '.$_SESSION['num_of_guess'].'</p>';
    ?>
    <p><?php echo $_SESSION['win'] ? 'Give Up' : '<a href="giveup.php">Give Up</a>'; ?></p>
    <p><a href="startover.php">Star Over</a></p>
  </body>
</html>
