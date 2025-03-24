<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'iwiessle');
define('DB_USERNAME', 'iwiessle');
define('DB_PASSWORD', 'iwiessle');
$conn= "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
$pdo = new PDO($conn, DB_USERNAME, DB_PASSWORD);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




?>