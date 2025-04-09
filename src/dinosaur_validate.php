<?php

session_start();
$Reg_done = false;
include_once('SeverConfigs.php');
if (
    $_SERVER['REQUEST_METHOD'] == 'POST' &&
    isset($_POST['name']) &&
    isset($_POST['short_desc']) &&
    isset($_POST['long_desc']) &&
    isset($_POST['price']) &&
    isset($_POST['dino_image']) &&
    isset($_POST['status']) &&
    isset($_POST['tags'])
) {
    $name = $_POST['name'];
    $short_desc = $_POST['short_desc'];
    $long_desc = $_POST['long_desc'];
    if (is_numeric($_POST['price'])) {
        $price = $_POST['price'];
    } else {
        $_SESSION["error_message"] = "The price has to be a decimal value!";
        header("Location: admin.php");
        exit();
    }
    $image = $_POST['dino_image'];
    if ($_POST['status'] === "available" || $_POST['status'] === "unavailable") {
        $status = $_POST['status'];
    } else {
        $_SESSION["error_message"] = "The status has to be either 'available' or 'unavailable'";
        header("Location: admin.php");
        exit();
    }
    $tags = $_POST['tags'];

    try {
        $SQL = "INSERT INTO dino_catalogue(name,short_description,long_description,price,image_address,status,tags) VALUES(?,?,?,?,?,?,?) ";

        $stmt = $pdo->prepare($SQL);
        $stmt->bindParam(1, $name, PDO::PARAM_STR);
        $stmt->bindParam(2, $short_desc, PDO::PARAM_STR);
        $stmt->bindParam(3, $long_desc, PDO::PARAM_STR);
        $stmt->bindParam(4, $price, PDO::PARAM_STR);
        $stmt->bindParam(5, $image, PDO::PARAM_STR);
        $stmt->bindParam(6, $status, PDO::PARAM_STR);
        $stmt->bindParam(7, $tags, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
        $Reg_done = true;
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            $_SESSION['error_message'] = "{$e->getMessage()}";
            header("Location: admin.php");
            exit();
        }
    }
    if ($Reg_done) {
        $_SESSION["Reg_successful"] = "thank you for adding this dinosaur!";
        header("Location:admin.php");
        exit();
    }
}

?>