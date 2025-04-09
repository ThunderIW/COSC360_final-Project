<?php
include_once("SeverConfigs.php");
$conn = new PDO("mysql:host=localhost;dbname=users", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

if (isset($_POST['id'])) {
    $id = $_POST['id'];
}

$deletion = $conn->prepare("DELETE FROM users WHERE id = :id");
$deletion->bindParam(':id', $id, PDO::PARAM_INT);
$deletion->execute();
header("Location: admin.php");

?>