<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'users');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
$conn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
$pdo = new PDO($conn, DB_USERNAME, DB_PASSWORD);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




?>