<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>The days of a week</title>
</head>
<body>
  <p>The days of the week in English are:</p>
  <p>
    <?php
      $days = array( 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' );
      foreach ($days as $day) {
        echo $day;
        echo end($days)==$day?'.':',';
      }
    ?>
  </p>
  <p>The days of the week in French are:</p>
  <p>
    <?php
      $days = array( 'Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi' );
      foreach ($days as $day) {
        echo $day;
        echo end($days)==$day?'.':',';
      }
    ?>
  </p>
</body>
</html>
