<?php

class DB
{
    //DB settings
    const DB_HOST = '127.0.0.1';
    const DB_NAME = 'gpz1505';
    const DB_USERNAME = 'gpz1505';
    const DB_PASSWORD = 'haoduan0812';

    private static $DB_DSN;
    private static $DB_PDO;

    //This is to establish database connection by creating PDO object.
    //If the database doesn't exist, it will create one.
    public static function init()
    {
        try {
            self::$DB_DSN = 'mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME;
            self::$DB_PDO = new PDO(self::$DB_DSN, self::DB_USERNAME, self::DB_PASSWORD);
            self::checkTable();

            return true;
        } catch (PDOException $e) {
            return $e - getMessage();
        }
    }

    private static function checkTable()
    {
        if (self::$DB_PDO->query("SHOW TABLES LIKE 'user'")->rowCount() < 1) {
            self::createUserTable();
        }
        if (self::$DB_PDO->query("SHOW TABLES LIKE 'cab'")->rowCount() < 1) {
            self::createCabTable();
        }
        if (self::$DB_PDO->query("SHOW TABLES LIKE 'order'")->rowCount() < 1) {
            self::createOrderTable();
        }
    }

    private static function createUserTable()
    {
        $query = 'CREATE TABLE user ('
        .'id INT UNSIGNED NOT NULL AUTO_INCREMENT,'
        .'name VARCHAR(128) NOT NULL,'
        .'email VARCHAR(128) NOT NULL,'
        .'password VARCHAR(32) NOT NULL,'
        .'is_admin BOOLEAN NOT NULL,'
        .'CONSTRAINT pk_user_id PRIMARY KEY (id)'
        .')';
        try {
            $prepared_query = self::$DB_PDO->prepare($query);
            $prepared_query->execute();

            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    private static function createCabTable()
    {
        $query = 'CREATE TABLE user ('
        .'id INT UNSIGNED NOT NULL AUTO_INCREMENT,'
        .'plate VARCHAR(16) NOT NULL,'
        .'driver VARCHAR(128) NOT NULL,'
        .'make VARCHAR(128) NOT NULL,'
        .'model VARCHAR(128) NOT NULL,'
        .'yom YEAR NOT NULL,'
        .'CONSTRAINT pk_cab_id PRIMARY KEY (id)'
        .')';
        try {
            $prepared_query = self::$DB_PDO->prepare($query);
            $prepared_query->execute();

            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    private static function createOrderTable()
    {
        $query = 'CREATE TABLE order ('
        .'ref VARCHAR(17) NOT NULL,'
        .'user INT NOT NULL,'
        .'cab INT NOT NULL,'
        .'pick_up_unit_no TINYINT UNSIGNED,'
        .'pick_up_street_no SMALLINT UNSIGNED NOT NULL,'
        .'pick_up_street_name VARCHAR(128) NOT NULL,'
        .'pick_up_suburb VARCHAR(128) NOT NULL,'
        ."pick_up_time DATETIME DEFAULT '1000-01-01 00:00:00' NOT NULL,"
        .'destination_suburb VARCHAR(128) NOT NULL,'
        ."order_time DATETIME DEFAULT '1000-01-01 00:00:00' NOT NULL,"
        .'status VARCHAR(32) NOT NULL,'
        .'CONSTRAINT pk_order_ref PRIMARY KEY (ref),'
        .'CONSTRAINT fk_order_user FOREIGN KEY (user) REFERENCES user(id),'
        .'CONSTRAINT fk_order_cab FOREIGN KEY (cab) REFERENCES cab(id)'
        .')';
        try {
            $prepared_query = self::$DB_PDO->prepare($query);
            $prepared_query->execute();

            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function closeDB()
    {
        self::$DB_DSN = null;
        self::$DB_PDO = null;
    }

    public static function insert($table, $content)
    {
        $columns = '';
        $values = '';
        $last_key = key(array_slice($content, -1, 1, true));
        foreach ($content as $key => $value) {
            $columns = $columns.$key.($last_key == $key ? '' : ', ');
            $values = $values.$value.($last_key == $key ? '' : ', ');
        }
        $query = "INSERT INTO $table ($columns) VALUES ($values)";
        try {
            $prepared_query = self::$DB_PDO->prepare($query);

            return $prepared_query->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function select($table, $content = '*', $condition = '')
    {
        $query = 'SELECT '.$content.' FROM '.$table.(empty($condition) ? '' : (' WHERE '.$condition));
        try {
            $prepared_query = self::$DB_PDO->prepare($query);
            $prepared_query->execute();

            return $prepared_query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
