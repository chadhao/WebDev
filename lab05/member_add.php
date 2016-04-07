<?php

require_once 'settings.php';

$db_dsn = 'mysql:host='.$host.';dbname='.$dbnm;
$query = "SHOW TABLES LIKE 'vipmembers'";

try {
  $db_pdo = new PDO( $db_dsn, $user, $pswd );
  if ( $db_pdo -> query( $query ) -> rowCount() < 1 ) {
    createTable( $db_pdo );
  }
  if ( checkFileds() ) {
    errorMsg( 'All fields must be filled correctly!' );
  } else {
	if (insertData( $db_pdo ) ) {
		echo '<h1>Info</h1><h2>New member added!</h2>';
		echo '<a href="vip_member.php">Homepage</a>';
	} else {
		errorMsg( 'Error inserting data!' );
	}
  }
} catch ( PDOException $e ) {
  errorMsg( $e -> getMessage() );
}

function checkFileds() {
  return !(preg_match("/^[a-zA-Z]+$/", $_POST['fname'])&&preg_match("/^[a-zA-Z]+$/", $_POST['lname'])&&preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/", $_POST['email'])&&preg_match("/^[0-9]+$/", $_POST['phone']));
}

function createTable( $db_pdo ) {
  $query = "CREATE TABLE vipmembers ("
		. "member_id int AUTO_INCREMENT,"
		. "fname varchar(40),"
		. "lname varchar(40),"
		. "gender varchar(1),"
		. "email varchar(40),"
		. "phone varchar(20),"
		. "CONSTRAINT pk_vipmembers_member_id PRIMARY KEY (member_id)"
		. ")";
    try {
      $db_pdo -> exec( $query );
      return true;
    } catch ( PDOException $e ) {
      return $e->getMessage();
    }
}

function insertData( $db_pdo ) {
	$keys = "";
	$values = "";
	foreach( $_POST as $key => $value ) {
		$keys = $keys . $key . ($key==key(array_slice($_POST, -1, 1, TRUE))?'':',');
		$values = $values. "'" . $value . "'" . ($key==key(array_slice($_POST, -1, 1, TRUE))?'':',');
	}
	$query = "INSERT INTO vipmembers (" . $keys . ") VALUES (" . $values . ")";
	try {
		$db_pdo -> exec( $query );
		return true;
	} catch ( PDOException $e ) {
		return $e -> getMessage();
	}
}

function errorMsg( $msg ) {
	echo '<h1>Warning</h1><h2>' . $msg . '</h2>';
	echo '<a href="vip_member.php">Homepage</a>';
}
?>
