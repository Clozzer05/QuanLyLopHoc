<?php
class Database {
    private static $conn = null;

    public static function getConnection() {
        if (self::$conn === null) {
            $config = require __DIR__ . '/../config/db.php';
            $instance = "php-app-491210:asia-southeast1:php-db"; 
            if (getenv('K_SERVICE')) { 
                $dsn = "mysql:unix_socket=/cloudsql/$instance;dbname={$config['dbname']};charset=utf8";
            } else {
                $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8";
            }
            try {
                self::$conn = new PDO($dsn, $config['user'], $config['pass'], [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);
            } catch (PDOException $e) {
                $files = is_dir('/cloudsql') ? scandir('/cloudsql') : "Thư mục /cloudsql không tồn tại!";
                $debug_info = is_array($files) ? implode(', ', $files) : $files;
                die("
                    <h3>Lỗi kết nối Database</h3>
                    <b>DSN đang dùng:</b> $dsn <br>
                    <b>Thông báo lỗi:</b> " . $e->getMessage() . " <br>
                    <b>Danh sách file trong /cloudsql:</b> $debug_info <br>
                    <hr>
                    <i>Gợi ý: Nếu danh sách file chỉ có '.', '..' thì nghĩa là Cloud Run chưa kết nối được với Cloud SQL.</i>
                ");
            }
        } 
        
        return self::$conn;
    } 
} 