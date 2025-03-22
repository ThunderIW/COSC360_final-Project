<?php
session_start();

$Reg_done=false;
include_once('SeverConfigs.php');
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['password'])&& isset($_POST['email'])) {
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    try{
    $SQL="INSERT INTO users(firstName,lastName,password,email) VALUES(?,?,?,?) ";

    $firstNameSan=$pdo->quote($firstName);
    $lastNameSan=$pdo->quote($lastName);
    $passwordSan=$pdo->quote($password);
    $emailSan=$pdo->quote($email);



    $stmt = $pdo->prepare($SQL);
    $stmt->bindParam(1, $firstNameSan, PDO::PARAM_STR);
    $stmt->bindParam(2, $lastNameSan, PDO::PARAM_STR);
    $stmt->bindParam(3, $passwordSan, PDO::PARAM_STR);
    $stmt->bindParam(4, $emailSan, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();

    }
    catch(PDOException $e){
        die($e->getMessage());
    }
    $Reg_done=true;
    echo "";
    if($Reg_done){
        $_SESSION["Reg_successful"]= "<script>alert('hank you for signing up, {$firstName}!');</script>";

        header("Location:login.php");
        exit();
    }




}




?>


