<?php
class Config {
    private static $host = 'localhost';
    private static $db_name = 'crud_app';
    private static $username = 'root';
    private static $password = '';

    public static function connect() {
        try {
            return new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db_name, self::$username, self::$password);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
