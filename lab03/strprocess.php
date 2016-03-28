<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Using string functions</title>
</head>
<body>
<h1>Web Development – Lab 3</h1>
<?php
  if (isset($_POST["inputstr"])) {
    $str = $_POST["inputstr"];
    $pattern = "/^[A-Za-z ]+$/";
    if (preg_match($pattern, $str)) {
      $ans = "";
      $len = strlen($str);
      for ($i = 0; $i < $len; $i++) {
        $letter = substr($str, $i , 1);
        if (! is_numeric(strpos("AEIOUaeiou", $letter))) {
          $ans = $ans . $letter;
        }
      }
      echo "<p>The string with no vowels is " . $ans . ".</p>";
    } else {
      echo "<p>Please enter a string contains only letters or space.</p>";
    }
  } else {
      echo "<p>Please enter string from the input form.</p>";
  }
?>
</body>
</html>
