<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>VIP Member Management</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/amazeui/2.6.1/css/amazeui.min.css">
</head>
<body>
<form class="am-form" method="post" action="member_search.php">
  <fieldset>
    <legend>Search</legend>

    <div class="am-form-group">
      <label for="keyword">Search by Last Name:</label>
      <input id="keyword" name="keyword" type="text" placeholder="Please enter last name">
    </div>
    <p><button class="am-btn am-btn-default" type="submit">Submit</button></p>
  </fieldset>
</form>
<div class="am-g">
<?php
	if ( isset( $_POST['keyword'] ) ) {
		if ( ! preg_match("/^[a-zA-Z]+$/", $_POST['keyword']) ) {
			echo '<h1>Keyword can only contain letters!</h1>';
		} else {
			require_once 'settings.php';
			$db_dsn = 'mysql:host='.$host.';dbname='.$dbnm;
			$query = "SELECT member_id,fname,lname,email FROM vipmembers WHERE lname='" . $_POST['keyword'] . "'";

			try {
				$db_pdo = new PDO($db_dsn, $user, $pswd);
				$prepared_query = $db_pdo -> prepare( $query );
				$prepared_query -> execute();
				$result = $prepared_query -> fetchAll( PDO::FETCH_ASSOC );
			} catch ( PDOException $e ) {
				$result = false;
			}
			if ( empty( $result ) ) {
				echo '<h1>No result found!</h1>';
			} else {
				echo '<table class="am-table am-table-striped am-table-hover">';
				echo '<thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>E-mail</th></tr></thead><tbody>';
				foreach ($result as $row) {
					echo '<tr>';
					foreach ($row as $key => $value) {
						echo '<td>'.$value.'</td>';
					}
					echo '</tr>';
				}
				echo '</tbody></table>';
			}
		}
	}
?>
</div>
<p><a href="vip_member.php">Homepage</a></p>
</body>
</html>
