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
          <a href="homePage.html" class="active">Home</a>
          <a href="Shop.php">Shop</a>
          <a href="About_us.html">About Us</a>
          <a href="Contact.html">Contact us</a>
          <a href="checkout.html"> Checkout</a>
        </div>
        <div class="profile-container">
          <button class="profile-button" id="user-menu-button">
            <img
              src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
              alt="User Profile"
            />
          </button>
          <div id="user-dropdown" class="dropdown-menu">
            <a href="Profile.php">Your Profile</a>
            <a href="login.html">Sign out</a>
          </div>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
      <h1>Jurassic-Care</h1>
      <p>Prehistoric power to modern solutions</p>
      <a href="Shop.html">Shop Now</a>
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
      <a href="Contact.html">Contact Us</a>
    </section>

    <!-- Footer -->
    <footer>
      <p>&copy; 2025 Jurassic-Care. All rights reserved.</p>
    </footer>
  </body>
</html>
