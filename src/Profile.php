


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>
    <link rel="stylesheet" href="assets/CSS/ProfilePage.css" />
    <link rel="stylesheet" href="assets/CSS/homePage.css" />
    <!-- Ensure both stylesheets are included -->
    <script src="scripts/profileDropDown.js" defer></script>
  </head>
  <body>
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
          <a href="Shop.html">Shop</a>
          <a href="About_us.html">About us</a>
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
            <a href="Profile.html">Your Profile</a>
            <a href="login.html">Sign out</a>
          </div>
        </div>
      </div>
    </nav>

    <div class="profile-container">
      <div class="profile-info">
        <p><strong>Username:</strong> JohnDoe123</p>
        <p><strong>Email:</strong> johndoe@example.com</p>
        <p><strong>Job:</strong> Software Engineer</p>
        <p><strong>Location:</strong> New York, USA</p>
        <br />
        <button id="Setting-Button">Edit Profile</button>
      </div>
      <div class="profile-image">
        <img
          src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
          alt="Profile Picture"
        />
      </div>
    </div>

    <div class="profile-content">
      <h3>Order History</h3>
      <select id="order-history-select">
        <option>Select an order</option>
        <option>Order #001 - Jan 5, 2024</option>
        <option>Order #002 - Feb 12, 2024</option>
        <option>Order #003 - Mar 20, 2024</option>
      </select>
      <ul id="order-history-list">
        <li>Order #001 - Jan 5, 2024</li>
        <li>Order #002 - Feb 12, 2024</li>
        <li>Order #003 - Mar 20, 2024</li>
      </ul>
    </div>

    <div class="profile-content">
      <h3>Wishlist</h3>
      <select id="wishlist-select">
        <option>Select an item</option>
        <option>Smartphone</option>
        <option>Wireless Headphones</option>
        <option>Gaming Laptop</option>
      </select>
    </div>

    <footer>
      <p>&copy; 2025 Jurassic-Care. All rights reserved.</p>
    </footer>
  </body>
</html>
