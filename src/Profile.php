

<?php
include_once('SeverConfigs.php');
session_start();
$userFirstName="Joe";
$userLastName="Doe";
$userEmail="joe.doe@gmail.com";
$userImageBase64 = null;

if (!isset($_SESSION["email"])){
    $_SESSION["NotLogIN"]="You are not logged in please log in first";
    header("Location: login.php");
    exit();
}


if($_SESSION["email"] && isset($_SESSION["firstName"]) && isset($_SESSION["lastName"])){
    $userFirstName=$_SESSION["firstName"];
    $userLastName=$_SESSION["lastName"];
    $userEmail=$_SESSION["email"];
    $userFirstNameTrimmed=TRIM($userFirstName,"'");
    $userLastNameTrimmed=TRIM($userLastName,"'");
    $userEmailTrimmed=TRIM($userEmail,"'");

    try{
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$userEmail]);
        $user=$stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && $user["user_image"]) {
            $userImageBase64 = base64_encode($user["user_image"]);}
    }catch(PDOException $e){
        echo $e->getMessage();
    }


}
?>


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
          <a href="Shop.php">Shop</a>
          <a href="About_us.php">About us</a>
          <a href="Contact.php">Contact us</a>
          <a href="checkout.html"> Checkout</a>
        </div>
          <div class="profile-container">
              <button class="profile-button" id="user-menu-button">
                  <img
                          src="<?php
                          if (isset($_SESSION['email'])) {
                              // Show logged-in user's image (replace with dynamic one if available)
                              echo 'data:image/jpeg;base64,' . $userImageBase64;; // replace this with DB-fetched one if needed
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

    <div class="profile-container">
      <div class="profile-info">
          <p><strong>FirstName:</strong> <?php echo htmlspecialchars($userFirstNameTrimmed) ?></p>
          <p><strong>LastName:</strong> <?php echo htmlspecialchars($userLastNameTrimmed); ?></p>
            <p><strong>Email:</strong><?php echo  htmlspecialchars($userEmailTrimmed) ?> </p>
            <p><strong>Job:</strong> Software Engineer</p>
            <p><strong>Location:</strong> New York, USA</p>
            <br/>
            <button id="Setting-Button">Edit Profile</button>
      </div>
      <div class="profile-image">
          <img
                  src="<?php echo $userImageBase64
                      ? 'data:image/jpeg;base64,' . $userImageBase64
                      : 'assets/images/default-user.png'; ?>"
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
