<?php
session_start(); // ✅ Required to access the session

include_once("SeverConfigs.php");

$conn = new PDO("mysql:host=localhost;dbname=iwiessle", "iwiessle", "iwiessle");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $deletion = $conn->prepare("DELETE FROM users WHERE id = :id");
    $deletion->bindParam(':id', $id, PDO::PARAM_INT);
    $success = $deletion->execute();




    if ($success) {
        $_SESSION['toast_success'] = "✅ User deleted successfully!";
    } else {
        $_SESSION['toast_success'] = "❌ Failed to delete user.";
    }
}

header("Location: admin.php");
exit();
?>
