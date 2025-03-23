<?php
session_start();

$Reg_done=false;
include_once('SeverConfigs.php');
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['password'])&& isset($_POST['email'])) {
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] === UPLOAD_ERR_OK){
        $fileTmpPath = $_FILES['user_image']['tmp_name'];
        $fileType=mime_content_type($_FILES['user_image']['tmp_name']);

        if($fileType=="image/png"){
            $imageData = file_get_contents($_FILES['user_image']['tmp_name']);
        }
        else{
            $_SESSION['error_message'] = "Only PNG images are allowed.";
            header("Location: signup.php");
            exit();

        }

    }else{
        $imageData = file_get_contents("assets/emptyIcon.png");
    }


    try{
        $SQL="INSERT INTO users(firstName,lastName,password,email,user_image) VALUES(?,?,?,?,?) ";

        $firstNameSan=$pdo->quote($firstName);
        $lastNameSan=$pdo->quote($lastName);
        $emailSan=$pdo->quote($email);
        $passwordSan=$pdo->quote($password);



        $stmt = $pdo->prepare($SQL);
        $stmt->bindParam(1, $firstNameSan, PDO::PARAM_STR);
        $stmt->bindParam(2, $lastNameSan, PDO::PARAM_STR);
        $stmt->bindParam(3, $passwordSan, PDO::PARAM_STR);
        $stmt->bindParam(4, $emailSan, PDO::PARAM_STR);
        $stmt->bindParam(5, $imageData, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();

    }
    catch(PDOException $e){
        if ($e->getCode() == 23000) {
            $_SESSION['error_message'] = "{$email} has been already registered.";

        }





    }
    $Reg_done=true;
    echo "";
    if($Reg_done){
        $_SESSION["Reg_successful"]= "thank you for signing up, {$firstName}!";

        header("Location:login.php");
        exit();
    }




}




?>


