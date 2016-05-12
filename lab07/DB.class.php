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

            return true;
        } catch (PDOException $e) {
            return $e - getMessage();
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
