<?php
session_start();
include_once("SeverConfigs.php");


$message_to_be_displayed="";

if (isset($_SESSION["Reg_successful"])){
    $message=$_SESSION["Reg_successful"];
    $message_to_be_displayed=$message;
    unset($_SESSION["Reg_successful"]);


}
if(isset($_SESSION["error_message"])){
    header("Location:signup.php");


}










?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="assets/CSS/login.css" />
    <script src="scripts/vaildateLogin.js" defer></script>
    <script src="scripts/profileDropDown.js" defer></script>
    <script src="scripts/autoHideSign&IN&OUT.js" defer></script>
</head>
<body>
<!-- Navbar -->
<nav>
    <div class="nav-container">
        <div class="logo">
            <img
                src="../src/assets/logos/dinosaur.png"
                alt="Company Logo"
                width="40"
            />
        </div>
        <div class="nav-links">
            <a href="homePage.php" class="active">Home</a>
            <a href="Shop.html">Shop</a>
            <a href="About_us.html">About Us</a>
            <a href="Contact.html">Contact us</a>
        </div>

        <div class="profile-container">
            <button class="profile-button" id="user-menu-button">
                <img src="../src/assets/emptyIcon.png" alt="User Profile" />
            </button>
            <div id="user-dropdown" class="dropdown-menu">
                <a href="Profile.php">Your Profile</a>
            </div>
        </div>
    </div>
</nav>

<main>
    <section class="login">
        <h2>Welcome to Jurassic Care!</h2>
        <p>Feel free to login or create a new account!</p>

        <form id="loginform" method="POST" novalidate action="login.php">
            <div class="form-group">
                <label for="email"> Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter email"
                    class="Inputs"
                />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter password"
                    class="Inputs"
                />
            </div>
            <button type="submit" class="submit">Log In</button>
            <div class="account-creation">
                <p>Don't have an account?</p>
                <a href="signup.php">Create an account here!</a>
            </div>
        </form>
        <div style="display: flex; justify-content: center; width: 100%;">
            <p class="signup-success-message"  style="color: green ; font-weight: bold"><?php echo $message_to_be_displayed;?></p>
        </div>



    </section>

</main>


<!-- Footer -->
<footer>
    <p>&copy; 2025 Your Company. All rights reserved.</p>
</footer>
</body>
</html>


<?php
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

        if (!empty($userinfo)) {
            $_SESSION["login_success"] = "You have successfully logged in!";
            header("Location: homePage.php"); // Or wherever you want to send them after login
            exit();
        }

        if (empty($userinfo)) {
            $_SESSION["error_message_login"] = "Invalid login credentials!";
            header("Location: login.php"); // Reload login with error message
            exit();
        }






    }catch(PDOException $e){

    }
}



?>




