<?php
session_start();
include_once('SeverConfigs.php');

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$oldEmail = $_SESSION['email'];
$firstName = trim($_POST['firstname']);
$lastName = trim($_POST['lastname']);
$newEmail = "'" . trim($_POST['email']) . "'"; // Store with quotes
$password = $_POST['password'];
$imageData = null;

try {
    if (empty($firstName) || empty($lastName) || empty($newEmail)) {
        throw new Exception("First name, last name, and email cannot be empty.");
    }

    $fields = [];
    $params = [];

    $fields[] = "firstName = ?";
    $params[] = $firstName;

    $fields[] = "lastName = ?";
    $params[] = $lastName;

    $fields[] = "email = ?";
    $params[] = $newEmail;

    if (!empty($password)) {
        $quotedPassword="'" . $password . "'";
        $fields[] = "password = ?";
        $params[] = $quotedPassword;
    }

    if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['user_image']['tmp_name'];
        $fileMimeType = mime_content_type($fileTmpPath);

        if ($fileMimeType === 'image/png') {
            $imageData = file_get_contents($fileTmpPath);
            $fields[] = "user_image = ?";
            $params[] = $imageData;
        } else {
            throw new Exception("Only PNG images are allowed.");
        }
    }

    $params[] = $oldEmail;

    $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    $_SESSION["firstName"] = $firstName;
    $_SESSION["lastName"] = $lastName;
    $_SESSION["email"] = $newEmail;

    if ($imageData !== null) {
        $_SESSION["user_image"] = base64_encode($imageData);
    }

    $_SESSION["success_message_for_profile_update"] = "Profile updated successfully!";
    header("Location: Profile.php");
    exit;

} catch (Exception $e) {
    $_SESSION["error_message_for_profile_updates"] = "Error: " . $e->getMessage();
    header("Location: Profile.php");
    exit;
}
?>