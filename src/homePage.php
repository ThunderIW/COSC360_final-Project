<?php
session_start();
if(isset($_SESSION["login_success"])){
    $alertToSend=$_SESSION["login_success"];
    unset($_SESSION["login_success"]);
}


$userImage =  $_SESSION["user_image"];
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HomePage</title>
    <link rel="stylesheet" href="assets/CSS/homePage.css" />
    <script src="scripts/profileDropDown.js" defer></script>
</head>
<body>
<?php
if(isset($alertToSend)){
    echo "<script type='text/javascript'>alert('$alertToSend');</script>";
}
?>
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
            <a href="checkout.html"> Checkout</a>
        </div>

        <div class="profile-container">
            <button class="profile-button" id="user-menu-button">
                <img
                        src="<?php
                        echo (!empty($_SESSION['user_image']))
                            ? 'data:image/png;base64,' . $_SESSION['user_image']
                            : 'assets/emptyIcon.png';
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
</nav>

<!-- Hero Section -->
<header class="hero">
    <h1>Jurassic-Care</h1>
    <p>Prehistoric power to modern solutions</p>
    <a href="Shop.php">Shop Now</a>
</header>

<!-- Features Section -->
<section class="features">
    <h2>Why Choose Us?</h2>
    <div class="feature-item">
        <h3>Quality Products</h3>
        <p>We provide the best quality products at affordable prices.</p>
    </div>
    <div class="feature-item">
        <h3>Fast Shipping</h3>
        <p>Get your orders delivered quickly and safely.</p>
    </div>
    <div class="feature-item">
        <h3>24/7 Support</h3>
        <p>Our team is always here to help you with any questions.</p>
    </div>
</section>

<!-- Call to Action (CTA) -->
<section class="cta">
    <h2>Join Our Community</h2>
    <p>Stay updated with our latest deals and offers.</p>
    <a href="Contact.php">Contact Us</a>
</section>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Jurassic-Care. All rights reserved.</p>
</footer>
</body>
</html>
