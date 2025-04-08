<?php
session_start();

$Reg_done = false;
include_once('SeverConfigs.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['name']) && isset($_POST['short_desc']) && isset($_POST['price'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $short_desc = $_POST['short_desc'];

    if (isset($_FILES['dino_image']) && $_FILES['dino_image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['dino_image']['tmp_name'];
        $fileType = mime_content_type($_FILES['dino_image']['tmp_name']);

        if ($fileType == "image/png") {
            $imageData = file_get_contents($_FILES['user_image']['tmp_name']);
        } else {
            $_SESSION['error_message'] = "Only PNG images are allowed.";
            header("Location: admin.php");
            exit();

        }

    } else {
        $imageData = file_get_contents("assets/emptyIcon.png");
    }


    try {
        $SQL = "INSERT INTO dino_catalogue(id,name,short_desc,price,dino_image) VALUES(?,?,?,?,?) ";

        $IdSan = $pdo->quote($id);
        $NameSan = $pdo->quote($name);
        $shortDescSan = $pdo->quote($short_desc);
        $PriceSan = $pdo->quote($price);


        $stmt = $pdo->prepare($SQL);
        $stmt->bindParam(1, $IdSan, PDO::PARAM_STR);
        $stmt->bindParam(2, $NameSan, PDO::PARAM_STR);
        $stmt->bindParam(3, $shortDescSan, PDO::PARAM_STR);
        $stmt->bindParam(4, $PriceSan, PDO::PARAM_STR);
        $stmt->bindParam(5, $imageData, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();

    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            $_SESSION['error_message'] = "{$email} has been already registered.";

        }
    }
    $Reg_done = true;
    echo "";
    if ($Reg_done) {
        $_SESSION["Reg_successful"] = "thank you for adding this dinosaur, {$firstName}!";

        header("Location:admin.php");
        exit();
    }


}




?>