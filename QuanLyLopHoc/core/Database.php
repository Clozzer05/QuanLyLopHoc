<?php
class Database {
    private static $conn = null;
    public static function getConnection() {
        if (self::$conn === null) {
            $config = require __DIR__ . '/../config/db.php';
            $dsn = "{$config['driver']}:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
            self::$conn = new PDO(
                $dsn,
                $config['user'],
                $config['pass'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        }
        return self::$conn;
    }
}
