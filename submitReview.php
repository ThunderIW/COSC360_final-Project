<?php
session_start();
include_once("SeverConfigs.php");

if (isset($_SESSION["login_success"])) {
    $alertToSend = $_SESSION["login_success"];
    unset($_SESSION["login_success"]);
}

function cleanValue($value)
{
    return htmlspecialchars(trim($value, "'\""));
}

$userImage = $_SESSION["user_image"];


if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['id'];
    $dino_id = $_POST['dino_id'];
    $review = trim($_POST['review']);

    if (empty($review)) {
        header("Location: makeReview.php?id=$dino_id&error=emptyReview");
        exit();
    }

    try {
        $user_name = cleanValue($_SESSION['firstName']) . ' ' . cleanValue($_SESSION['lastName']);
        $stmt = $pdo->prepare("INSERT INTO reviews (user_id,dino_id,text,name) VALUES (?,?,?,?)");
        $stmt->execute([$user_id, $dino_id, $review, $user_name]);
        header("Location: Product.php?id=$dino_id&review=success");
        exit();
    } catch (PDOException $e) {
        error_log('Your review was not processed properly' . $e->getMessage());
        header("Location: makeReview.php?id=$dino_id&error=db");
        exit();
    }
}
?>