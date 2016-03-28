<?php
  require_once('mathfunctions.php');
  $input_val = $_GET['factor'];
  if (is_numeric($input_val)) {
    if (intval($input_val) == $input_val) {
      echo 'Factorial value of ' . $input_val . ' is ' . factorial($input_val) . '.';
    } else {
      echo '<h1>Input is not an integer.</h1>';
    }
  } else {
    echo '<h1>Input is not a number.</h1>';
  }
?>
