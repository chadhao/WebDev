<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Lab03 Task 3 - Standard Palindrome</title>
</head>
<body>
<h1>Lab03 Task 3 - Standard Palindrome</h1>
<?php

  if (isset($_POST["inputstr"])) {
    $str = $_POST["inputstr"];
    $str_regex = preg_replace("/[^a-zA-Z]/", '', $str);
    if ( $str_regex == "" ) {
      echo "<p>The string must contain characters from A-Z / a-z / 0-9.</p>";
    } else {
      $str_regex_lowercase = strtolower($str_regex);
      if ( strcmp($str_regex_lowercase, strrev($str_regex_lowercase)) == 0 ) {
        echo '<p>The string "' . $str . '" is a perfect palindrome!</p>';
        echo '<p>The string after being filtered by regular expression is "' . $str_regex . '"</p>';
      } else {
        echo '<p>The string "' . $str . '" is not a perfect palindrome!</p>';
        echo '<p>The string after being filtered by regular expression is "' . $str_regex . '"</p>';
      }
    }
  } else {
    echo "<p>Please enter string from the input form.</p>";
  }

?>
</body>
</html>
