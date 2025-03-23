<?php

define('DB_HOST', 'localhost'); // keep this as-is
define('DB_NAME', 'iwiessle');   // <-- your CWL is your database name
define('DB_USERNAME', 'iwiessle'); // <-- your CWL is also your DB username
define('DB_PASSWORD', 'iwiessle'); // <-- your CWL password (or the new one you set)

$conn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
$pdo = new PDO($conn, DB_USERNAME, DB_PASSWORD);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
