<?php
session_start();
$message=$_SESSION["Reg_successful"]
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

        <form id="loginform" method="POST" novalidate>
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
            <p style="color: green;"><?php echo $message; ?></p>
        </div>



    </section>

</main>


<!-- Footer -->
<footer>
    <p>&copy; 2025 Your Company. All rights reserved.</p>
</footer>
</body>
</html>

