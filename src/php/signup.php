<?php
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
    <link rel="stylesheet" href="signUp.css" />
    <script src="scripts/validateSignUp.js" defer></script>
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
            <a href="homePage.html" class="active">Home</a>
            <a href="Shop.html">Shop</a>
            <a href="About_us.html">About Us</a>
            <a href="Contact.html">Contact us</a>
        </div>

        <div class="profile-container">
            <button class="profile-button" id="user-menu-button">
                <img src="../src/assets/emptyIcon.png" alt="User Profile" />
            </button>
            <div id="user-dropdown" class="dropdown-menu">
                <a href="Profile.html">Your Profile</a>
            </div>
        </div>
    </div>
</nav>

<main>
    <section class="signup">
        <h2>Create your account here</h2>

        <form id="signupform" method="POST" novalidate action="vaildate.php">
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
            <button type="submit" class="submit">Create Account</button>
            <div class="login">
                <p>Already have an account?</p>
                <a href="login.html">Login here!</a>
            </div>
        </form>
    </section>
</main>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Your Company. All rights reserved.</p>
</footer>
</body>
</html>

