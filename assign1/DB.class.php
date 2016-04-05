<?php

class DB {
    
    //DB settings
    const DB_HOST = '127.0.0.1';
    const DB_NAME = 'gpz1505';
    const DB_USERNAME = 'gpz1505';
    const DB_PASSWORD = 'haoduan0812';
    
    private static $DB_DSN;
    private static $DB_PDO;
    
    public static function init() {
	
	try{
	    self::$DB_DSN = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME;
	    self::$DB_PDO = new PDO(self::$DB_DSN, self::DB_USERNAME, self::DB_PASSWORD);
	    $query = "SHOW TABLES LIKE 'status'";
	    if ( self::$DB_PDO -> query($query) -> rowCount() < 1) {
		self::createTable();
	    }
	    return true;
	} catch ( PDOException $e ) {
	    return $e-getMessage();
	}
    }
    
    private static function createTable() {
	$query = "CREATE TABLE status ("
		. "status_code varchar(8) NOT NULL,"
		. "status varchar(1024) NOT NULL,"
		. "share varchar(16),"
		. "date_added date DEFAULT '1000-01-01' NOT NULL,"
		. "allow_like boolean,"
		. "allow_comment boolean,"
		. "allow_share boolean,"
		. "CONSTRAINT pk_status_status_code PRIMARY KEY (status_code)"
		. ")";
	try {
	    $prepared_query = self::$DB_PDO -> prepare( $query );
	    $prepared_query -> execute();
	    return true;
	} catch ( PDOException $e ) {
	    return $e->getMessage();
	}
    }
    
    public static function closeDB() {
	self::$DB_DSN = NULL;
	self::$DB_PDO = NULL;
    }
    
    public static function insert( $table, $content ) {
	$columns = '';
	$values = '';
	$last_key = key( array_slice( $content, -1, 1, true ) );
	foreach ( $content as $key => $value) {
	    $columns = $columns . $key . ($last_key==$key?'':', ');
	    $values = $values . $value . ($last_key==$key?'':', ');
	}
	$query = "INSERT INTO $table ($columns) VALUES ($values)";
	try {
	    $prepared_query = self::$DB_PDO -> prepare( $query );
	    return $prepared_query -> execute();
	} catch ( PDOException $e ) {
	    return $e->getMessage();
	}
    }
    
    public static function select( $table, $content='*', $condition='' ) {
	$query = "SELECT " . $content . " FROM " . $table . (empty($condition)?'':(" WHERE ".$condition));
	try {
	    $prepared_query = self::$DB_PDO -> prepare( $query );
	    return $prepared_query -> fetchAll();
	} catch ( PDOException $e ) {
	    return $e->getMessage();
	}
    }
}