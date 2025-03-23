<?php
session_start();
include_once("SeverConfigs.php");
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["password"])){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordSan=$pdo->quote($password);
    $emailSan=$pdo->quote($email);
    try{
        $sql="SELECT * FROM users WHERE email=? and password=?";
        $stmt=$pdo->prepare($sql);
        $stmt->bindValue(1,$emailSan,PDO::PARAM_STR);
        $stmt->bindValue(2,$passwordSan,PDO::PARAM_STR);
        $result=$stmt->execute();
        $userinfo=$stmt->fetch(PDO::FETCH_ASSOC);




        if (!empty($userinfo) && $passwordSan==$userinfo['password'] && $emailSan==$userinfo['email']) {
            $_SESSION["login_success"] = "You have successfully logged in!";
            $_SESSION["id"] = $userinfo['id'];
            $_SESSION["email"] = $userinfo['email'];
            $_SESSION["firstName"] = $userinfo['firstName'];
            $_SESSION["lastName"] = $userinfo['lastName'];
            $_SESSION["user_image"] = $userinfo["user_image"]
                ? 'data:image/png;base64,' . base64_encode($userinfo["user_image"])
                : 'assets/emptyIcon.png';

            header("Location: homePage.php"); // Or wherever you want to send them after login
            exit();
        }

        if (empty($userinfo)) {

            $_SESSION["error_message_login"] = "Invalid login credentials!";
            header("Location: login.php"); // Reload login with error message
            exit();
        }






    }catch(PDOException $e){
        die($e->getMessage());


    }
}



?>
