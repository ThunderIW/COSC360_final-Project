<?php
session_start();
if (isset($_SESSION["user_image"])) {
    $userImage = $_SESSION["user_image"];

}
$userImage =  $_SESSION["user_image"]



?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About</title>
    <link rel="stylesheet" href="assets/CSS/About_us.css" />
    <script src="scripts/profileDropDown.js" defer></script>
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
                <a href="homePage.php">Home</a>
                <a href="Shop.php" >Shop</a>
                <a href="About_us.php" class="active">About Us</a>
                <a href="Contact.php">Contact us</a>
                <a href="checkout.html"> Checkout</a>
            </div>

                <div class="profile-container">
                    <button class="profile-button" id="user-menu-button">
                        <img
                                src="<?php
                                if (isset($_SESSION['email']) && !empty($_SESSION['user_image'])) {
                                    echo 'data:image/png;base64,' . $_SESSION['user_image'];
                                } else {
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
    </nav>

    <section
      style="text-align: center; padding: 2rem; font-family: Arial, sans-serif"
    >
      <h1>About Us</h1>
      <div style="max-width: 600px; margin: auto">
        <p style="font-size: 1.2rem">
          Welcome to the best (and only) Dino shop in the world!
        </p>
        <p>
          Need a **T-Rex** to guard your house? A **Velociraptor** to fetch your
          groceries? Or maybe a **gentle Brachiosaurus** to help with
          tree-trimming? We’ve got you covered. Our dinos are obedient (mostly),
          friendly (usually), and guaranteed to make your neighbors jealous!
        </p>
        <p style="font-style: italic; color: gray">
          *Disclaimer: We are not responsible for any minor inconveniences, such
          as missing pets, accidentally destroyed cars, fences, or entire city
          blocks.
        </p>
      </div>
    </section>

    <footer>
      <p>&copy; 2025 Your Company. All rights reserved.</p>
    </footer>
  </body>
</html>
