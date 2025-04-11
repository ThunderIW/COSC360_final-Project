<?php
session_start();
include_once("SeverConfigs.php");

$conn = new PDO("mysql:host=localhost;dbname=iwiessle", "iwiessle", "iwiessle");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        $conn->beginTransaction(); // Begin atomic operation

        // Delete from cart
        $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Delete from reviews
        $stmt = $conn->prepare("DELETE FROM reviews WHERE user_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Delete from orders
        $stmt = $conn->prepare("DELETE FROM orders WHERE user_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Delete from users
        $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $success = $stmt->execute();

        $conn->commit(); // All good!

        $_SESSION['toast_success'] = $success
            ? "? User and all related data deleted successfully!"
            : "? Failed to delete user.";

    } catch (Exception $e) {
        $conn->rollBack(); // Revert if anything fails
        error_log("? Deletion error: " . $e->getMessage());
        $_SESSION['toast_success'] = "? An error occurred while deleting user.";
    }
}

header("Location: admin.php");
exit();
?>
