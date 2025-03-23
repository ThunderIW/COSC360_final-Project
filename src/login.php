<?php
session_start();
$red_text=false;
$green_text=false;
$message_to_be_displayed="";

if (isset($_SESSION["Reg_successful"])){
    $message=$_SESSION["Reg_successful"];
    $message_to_be_displayed=$message;
    $green_text=true;
    unset($_SESSION["Reg_successful"]);



}
if(isset($_SESSION["error_message"])){
    header("Location:signup.php");



}

if(isset($_SESSION["NotLogIN"])){
    $red_text=true;
    $message_to_be_displayed=$_SESSION["NotLogIN"];
    unset($_SESSION["NotLogIN"]);
}

if(isset($_SESSION["error_message_login"])){
    $message_to_be_displayed=$_SESSION["error_message_login"];
    $red_text=true;
    unset($_SESSION["error_message_login"]);
}







?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="assets/CSS/login.css" />
    <script src="scripts/profileDropDown.js" defer></script>
    <script src="scripts/validateLogin.js" defer></script>
    <script src="scripts/autoHideSignInOut.js" defer ></script>
</head>
<body>
<!-- Navbar -->
<nav>
    <div class="nav-container">
        <div class="logo">
            <img
                src="assets/logos/dinosaur.png"
                alt="Company Logo"
                width="40"
            />
        </div>
        <div class="nav-links">
            <a href="homePage.php" class="active">Home</a>
            <a href="Shop.php">Shop</a>
            <a href="About_us.php">About Us</a>
            <a href="Contact.php">Contact us</a>
        </div>

        <div class="profile-container">
            <button class="profile-button" id="user-menu-button">
                <img
                        src="<?php
                        if (isset($_SESSION['email'])) {
                            // Show logged-in user's image (replace with dynamic one if available)
                            echo 'assets/images/user-avatar.png'; // replace this with DB-fetched one if needed
                        } else {
                            // Show default guest image
                            echo 'assets/emptyIcon.png';
                        }
                        ?>"
                        alt="User Profile"
                />
            </button>

            <div id="user-dropdown" class="dropdown-menu">
                <?php if (isset($_SESSION["email"])): ?>
                    <a href="Profile.php">Your Profile</a>
                    <a href="logout.php">Sign out</a>
                <?php else: ?>
                    <a href="login.php">Sign In</a>
                    <a href="signup.php">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<main>
    <section class="login">
        <h2>Welcome to Jurassic Care!</h2>
        <p>Feel free to login or create a new account!</p>

        <form id="loginform" method="POST" action="login_validate.php" novalidate>
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
            <p class="signup-success-message" style="color: <?php echo $green_text ? 'green' : ($red_text ? 'red' : 'green'); ?>;  font-weight: bold">
		    <?php echo $message_to_be_displayed;?></p>
        </div>



    </section>

</main>


<!-- Footer -->
<footer>
    <p>&copy; 2025 Your Company. All rights reserved.</p>
</footer>
</body>
</html>



