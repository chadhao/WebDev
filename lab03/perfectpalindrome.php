<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Lab03 Task 2 - Perfect Palindrome</title>
</head>
<body>
<h1>Lab03 Task 2 - Perfect Palindrome</h1>
<?php

  if (isset($_POST["inputstr"])) {
    $str = $_POST["inputstr"];
    $str_lowercase = strtolower($str);
    $len = strlen($str_lowercase);
    $chars = "";
    for ($i = 0; $i < $len; $i++) {
      $letter = substr($str_lowercase, $i, 1);
      if (is_numeric(strpos("abcdefghijklmnopqrstuvwxyz0123456789", $letter))) {
        $chars = $chars . $letter;
      }
    }
    if ( $chars == "" ) {
      echo "<p>The string must contain characters from A-Z / a-z / 0-9.</p>";
    } else if ( strcmp($chars, strrev($chars)) == 0 ) {
      echo '<p>The string "' . $str . '" is a perfect palindrome!</p>';
      echo '<p>The string after being filtered by loop is "' . $chars . '"</p>';
    } else {
      echo '<p>The string "' . $str . '" is not a perfect palindrome!</p>';
      echo '<p>The string after being filtered by loop is "' . $chars . '"</p>';
    }
  } else {
    echo "<p>Please enter string from the input form.</p>";
  }

?>
</body>
</html>
