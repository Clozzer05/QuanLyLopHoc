<?php
$socket = getenv('INSTANCE_CONNECTION_NAME');
return [
    'driver'  => 'mysql',
    'host'    => getenv('DB_HOST') ?: '34.87.5.63', 
    'dbname'  => getenv('DB_NAME') ?: 'QuanLyLopHoc',
    'user'    => getenv('DB_USER') ?: 'php-db',
    'pass'    => getenv('DB_PASS') ?: '123456',
    'charset' => 'utf8',
    'socket'  => $socket ? "/cloudsql/$socket" : null
];