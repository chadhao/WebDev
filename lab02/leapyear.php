<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Leap Year</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/amazeui/2.5.2/css/amazeui.flat.min.css">
</head>
<body>
	<form class="am-form" method="get" action="leapyear.php" >
		<fieldset>
			<legend>Lab02 Task 4 - Leap Year</legend>
	
			<p>
			<?php
				function is_leapyear($year) {
					if ($year%100!=0 && $year%4==0) {
						return true;
					} else if ($year%100==0 && $year%400==0) {
						return true;
					}
					return false;
				}
				$leapyear_input = $_GET['leapyear'];
				$result = is_numeric($leapyear_input)?($leapyear_input==intval($leapyear_input)?intval($leapyear_input):'Input is not an integer!'):'Input is not a number!';
				echo is_numeric($result)?(is_leapyear($result)?('The year you entered '.$result.' is a leap year.'):('The year you entered '.$result.' is a standard year.')):$result;
			?>
			</p>
		</fieldset>
	</form>
</body>
</html>
