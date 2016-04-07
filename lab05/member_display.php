<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>VIP Member Management</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/amazeui/2.6.1/css/amazeui.min.css">
</head>
<body>
<h1>All members</h1>
<?php
  require_once 'settings.php';
  $db_dsn = 'mysql:host='.$host.';dbname='.$dbnm;
  $query = "SELECT member_id,fname,lname FROM vipmembers";

  try {
    $db_pdo = new PDO($db_dsn, $user, $pswd);
    $prepared_query = $db_pdo -> prepare( $query );
    $prepared_query -> execute();
    $result = $prepared_query -> fetchAll( PDO::FETCH_ASSOC );
  } catch ( PDOException $e ) {
    $result = false;
  }

  if ( empty( $result ) ) {
    echo '<h1>Failed fetching data from database!</h1>';
  } else {
    echo '<table class="am-table am-table-striped am-table-hover">';
    echo '<thead><tr><th>ID</th><th>First Name</th><th>Last Name</th></tr></thead><tbody>';
    foreach ($result as $row) {
      echo '<tr>';
      foreach ($row as $key => $value) {
        echo '<td>'.$value.'</td>';
      }
      echo '</tr>';
    }
    echo '</tbody></table>';
  }
  echo '<p><a href="vip_member.php">Homepage</a></p>';
?>
</body>
</html>
