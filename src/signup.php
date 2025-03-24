<?php
$message_to_be_displayed="";
session_start();
if(isset($_SESSION["error_message"])){
    $message_to_be_displayed=$_SESSION["error_message"]; 
    unset($_SESSION["error_message"]);

}
$userImage =  $_SESSION["user_image"]






?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
    <link rel="stylesheet" href="assets/CSS/signUp.css" />
    <script src="scripts/validateSignUp.js" defer></script>
    <script src="scripts/autoHideSignInOut.js" defer></script>
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
                <img src="assets/emptyIcon.png" alt="User Profile" />
            </button>
            <div id="user-dropdown" class="dropdown-menu">
                <a href="Profile.php">Your Profile</a>
            </div>
        </div>
    </div>
</nav>

<main>
    <section class="signup">
        <h2>Create your account here</h2>

        <form id="signupform" method="POST" action="vaildate.php" enctype="multipart/form-data" novalidate>
            <p>Fill in the form!</p>
            <div class="form-group">
                <label for="firstname"> First Name</label>
                <input
                    type="text"
                    id="firstname"
                    name="firstname"
                    placeholder="Enter First Name"
                    required
                />
            </div>

            <div class="form-group">
                <label for="username"> Last Name</label>
                <input
                    type="text"
                    id="lastname"
                    name="lastname"
                    placeholder="Enter Last Name"
                    required
                />
            </div>

            <div class="form-group">
                <label for="username"> Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter Email"
                    required
                />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter Password"
                    required
                />
            </div>
            <div class="form-group">
                <label for="user_image">Profile Image 🖼️</label>
                <input type="file" id="user_image" name="user_image" accept="image/png" />
            </div>

            <button type="submit" class="submit">Create Account</button>
            <div class="login">
                <p>Already have an account?</p>
                <a href="login.php">Login here!</a>
            </div>
        </form>
         <div style="display: flex; justify-content: center; width: 100%;">
            <p class="signup-success-message" style="color: red ; font-weight: bold">
		<?php echo $message_to_be_displayed;?>
	</p>
        </div>


    </section>
</main>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Your Company. All rights reserved.</p>
</footer>
</body>
</html>
