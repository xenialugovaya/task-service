<?php
//$connect = new PDO("mysql:host=localhost;dbname=tasks;unix_socket=/tmp/mysql.sock", "root", "password");
//$base_url = 'http://localhost:3000/';

const BASE_URL = 'http://localhost:3000/';

class Database
{
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASSWORD = 'password';
    const DB_NAME = 'tasks';

    private static $db;
    protected static $instance = null;

    public function __construct()
    {
        if (self::$instance === null) {
            try {
                self::$db = new PDO(
                    'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';unix_socket=/tmp/mysql.sock',
                    self::DB_USER,
                    self::DB_PASSWORD
                );
            } catch (PDOException $e) {
                throw new Exception($e->getMessage());
            }
        }
        return self::$instance;
    }

    public static function query($stmt)
    {
        return self::$db->query($stmt);
    }

    public static function prepare($stmt)
    {
        return self::$db->prepare($stmt);
    }

    public static function exec($query)
    {
        return self::$db->exec($query);
    }

    public static function run($query, $args = [])
    {
        try {
            if (!$args) {
                return self::query($query);
            }
            $stmt = self::prepare($query);
            $stmt->execute($args);
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getRow($query, $args = [])
    {
        return self::run($query, $args)->fetch();
    }

    public static function getRows($query, $args = [])
    {
        return self::run($query, $args)->fetchAll();
    }

    public static function getValue($query, $args = [])
    {
        $result = self::getRow($query, $args);
        if (!empty($result)) {
            $result = array_shift($result);
        }
        return $result;
    }

    public static function sql($query, $args = [])
    {
        self::run($query, $args);
    }
}