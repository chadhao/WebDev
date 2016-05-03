<?php
  session_start();
  $num = $_SESSION['number'];
  $num--;
  $_SESSION['number'] = $num;
  header('Location: number.php');
?>
