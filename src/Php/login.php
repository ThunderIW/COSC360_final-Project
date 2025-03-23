<?php
session_start();
include("ServerConfigs.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $pass = $_POST["password"];

    $passwordSan = $pdo->quote($pass);
    $emailSan = $pdo->quote($email);
    try {
        $sql = "SELECT email,password FROM users WHERE email = ?";
        $stmt = $pdo->prepare(($sql));
        $stmt->bindParam(1, $emailSan, PDO::PARAM_STR);
        $results->execute();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            if (trim("'", $row['email']) == $emailSan && trim("'", $row['password']) == $passwordSan) {
                $_SESSION['email'] = $emailSan;
                header('Location: homePage.html');
                exit();
            } else {
                header('Location: login.html');
                exit();
            }
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>