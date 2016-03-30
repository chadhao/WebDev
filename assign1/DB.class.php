<?php

class DB {
    
    //DB settings
    const DB_HOST = 'localhost';
    const DB_NAME = 'assign1';
    const DB_USERNAME = 'gpz1505';
    const DB_PASSWORD = 'haoduan0812';
    
    private static $DB_CREATED = false;
    private static $DB_DSN;
    private static $DB_PDO;
    
    public static function init() {
	self::$DB_DSN = 'mysql:host=' . self::DB_HOST;
	try{
	    self::$DB_PDO = new PDO(self::$DB_DSN, self::DB_USERNAME, self::DB_PASSWORD);
	    $query = 'SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ' . self::DB_NAME;
	    if ( self::$DB_PDO -> exec( $query ) < 1) {
		self::createDB();
	    } else {
		self::$DB_DSN = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME;
		self::$DB_PDO = new PDO(self::$DB_DSN, self::DB_USERNAME, self::DB_PASSWORD);
	    }
	    self::$DB_CREATED = true;
	    return true;
	} catch ( PDOException $e ) {
	    return false;
	}
    }
    
    private static function createDB() {
	self::$DB_PDO -> exec( 'CREATE DATABASE IF NOT EXISTS' . self::DB_NAME );
	self::$DB_DSN = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME;
	self::$DB_PDO = new PDO(self::$DB_DSN, self::DB_USERNAME, self::DB_PASSWORD);
	$query = "CREATE TABLE status ("
		. "status_code varchar(8) NOT NULL,"
		. "status varchar(1024) NOT NULL,"
		. "share varchar(16),"
		. "date_added date DEFAULT '0000-00-00' NOT NULL,"
		. "allow_like boolean,"
		. "allow_comment boolean,"
		. "allow_share boolean,"
		. "CONSTRAINT pk_status_status_code PRIMARY KEY (status_code)"
		. ")";
	self::$DB_PDO -> exec( $query );
    }
    
    
}