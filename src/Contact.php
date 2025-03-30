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
    <title>Contact</title>
    <link rel="stylesheet" href="assets/CSS/contactPage.css" />
    <script src="scripts/profileDropDown.js" defer></script>
    <script src="scripts/formValidation.js" defer></script>
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
          <a href="Shop.php">Shop</a>
          <a href="About_us.php">About us</a>
          <a href="Contact.php" class="active">Contact us</a>
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

    <!-- Contact Section -->
    <header class="hero">
      <h1>Contact Us</h1>
      <p>
        We would love to hear from you. Fill out the form below to get in touch.
      </p>
    </header>

    <section class="contact-form">
      <form id="contact-form" method="POST">
        <div class="form-group">
          <label for="name">Full Name</label>
          <input type="text" name="name" id="name" />
        </div>
        <div class="form-group">
          <label for="email">Email ✉️</label>
          <input type="text" name="email" id="email" />
        </div>
        <div class="form-group">
          <label for="message">Message 💬</label>
          <textarea name="message" id="message" rows="4"></textarea>
        </div>
        <div class="form-group">
          <label for="phone">Phone Number 📞</label>
          <input placeholder="123-456-789" type="tel" name="phone" id="phone" />
        </div>

        <button type="submit">Send Message</button>
      </form>
    </section>

    <!-- Footer -->
    <footer>
      <p>&copy; 2025 Your Company. All rights reserved.</p>
    </footer>
  </body>
</html>
