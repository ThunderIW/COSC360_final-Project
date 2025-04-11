<?php

include_once('SeverConfigs.php');
session_start();
$userFirstName = "Joe";
$userLastName = "Doe";
$userEmail = "joe.doe@gmail.com";
$userImage = $_SESSION["user_image"];


if ($_SESSION["email"] && isset($_SESSION["firstName"]) && isset($_SESSION["lastName"])) {
    $userFirstName = $_SESSION["firstName"];
    $userLastName = $_SESSION["lastName"];
    $user_id = $_SESSION["id"];
    $userEmail = $_SESSION["email"];
    $userFirstNameTrimmed = TRIM($userFirstName, "'");
    $userLastNameTrimmed = TRIM($userLastName, "'");
    $userEmailTrimmed = TRIM($userEmail, "'");

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$userEmail]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && $user["user_image"]) {
            $userImageBase64 = base64_encode($user["user_image"]);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }


}

$ordersHistory = [];
try {
    $stmt = $pdo->prepare("SELECT o.id, o.date, SUM(o.quantity) as total
                            FROM orders o
                            WHERE o.user_id = ? 
                            GROUP by o.id,o.date
                            ORDER BY o.date DESC");
    $stmt->execute([$user_id]);
    $ordersHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error: " . $e->getMessage());
}

$reviewsHistory = [];
try {
    $stmt = $pdo->prepare("SELECT r.id,r.text,d.name
                            FROM reviews r
                            JOIN dino_catalogue d ON r.dino_id = d.id 
                            WHERE r.user_id = ?");
    $stmt->execute([$user_id]);
    $reviewsHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error: " . $e->getMessage());
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
    <script src="scripts/autoHideSignInOut.js" defer></script>

</head>

<body>
    <div style="display: flex; justify-content: center; width: 100%;">
        <p id="flash-message" class="signup-success-message"
            style="color: <?php echo isset($_SESSION['error_message_for_profile_updates']) ? 'red' : 'green'; ?>;">
            <?php
            if (isset($_SESSION["success_message_for_profile_update"])) {
                echo $_SESSION["success_message_for_profile_update"];
                unset($_SESSION["success_message_for_profile_update"]);
            } elseif (isset($_SESSION["error_message_for_profile_updates"])) {
                echo $_SESSION["error_message_for_profile_updates"];
                unset($_SESSION["error_message_for_profile_updates"]);
            }
            ?>
        </p>
    </div>

    <nav>
        <div class="nav-container">
            <div class="logo">
                <img src="assets/logos/dinosaur.png" alt="Company Logo" width="40" />
            </div>
            <div class="nav-links">
                <a href="homePage.php">Home</a>
                <a href="Shop.php">Shop</a>
                <a href="About_us.php">About us</a>
                <a href="Contact.php">Contact us</a>
                <a href="checkout.html"> Checkout</a>
                <?php
                if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) {
                    echo '<a href="admin.php"> Admin</a>';
                }
                ?>
                <a href="checkout.php"> Checkout</a>

            </div>
            <div class="profile-container">
                <button class="profile-button" id="user-menu-button">
                    <img src="<?php
                    echo (!empty($_SESSION['user_image']))
                        ? 'data:image/png;base64,' . $_SESSION['user_image']
                        : 'assets/emptyIcon.png';
                    ?>" alt="User Profile" />

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
            <p><strong>Email:</strong><?php echo htmlspecialchars($userEmailTrimmed) ?> </p>
            <p><strong>Job:</strong> Software Engineer</p>
            <p><strong>Location:</strong> New York, USA</p>
            <br />
        </div>
        <div class="profile-image">
            <img src="<?php echo $userImageBase64
                ? 'data:image/jpeg;base64,' . $userImageBase64
                : 'assets/images/default-user.png'; ?>" alt="Profile Picture" />

        </div>
    </div>

    <div class="profile-content">
        <h3>Order History</h3>
        <?php if (empty($ordersHistory)): ?>
            <p> You haven't placed any orders!</p>
        <?php else: ?>
            <table class="order_table" border="1">
                <tr>
                    <th>Order ID:</th>
                    <th>Quantity Ordered:</th>
                    <th>Time of Order:</th>
                </tr>
                <?php foreach ($ordersHistory as $order): ?>
                    <tr>
                        <td><?php echo $order['id']; ?></td>
                        <td><?php echo $order['total']; ?></td>
                        <td><?php echo date('M,j,Y', strtotime($order['date'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

    </div>

    <div class="profile-content">
        <h3>Review History</h3>
        <?php if (empty($reviewsHistory)): ?>
            <p> You haven't posted any reviews!</p>
        <?php else: ?>
            <table class="order_table" border="1">
                <tr>
                    <th>Review ID:</th>
                    <th>Review:</th>
                    <th>Dinosaur Name:</th>
                </tr>
                <?php foreach ($reviewsHistory as $review): ?>
                    <tr>
                        <td><?php echo $review['id']; ?></td>
                        <td><?php echo $review['text']; ?></td>
                        <td><?php echo $review['name']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

    </div>

    <div class="profile-content">
        <h3>Edit Your Profile</h3>
        <form method="POST" action="updateProfile.php" enctype="multipart/form-data">
            <label for="firstname">First Name:</label><br>
            <input type="text" name="firstname" id="firstname"
                value="<?php echo htmlspecialchars($userFirstNameTrimmed); ?>" required><br><br>

            <label for="lastname">Last Name:</label><br>
            <input type="text" name="lastname" id="lastname"
                value="<?php echo htmlspecialchars($userLastNameTrimmed); ?>" required><br><br>

            <label for="password">New Password (leave blank to keep current):</label><br>
            <input type="password" name="password" id="password"><br><br>

            <label for="user_image">New Profile Image (PNG only):</label><br>
            <input type="file" name="user_image" id="user_image" accept="image/png"><br><br>

            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($userEmailTrimmed); ?>"
                required><br><br>



            <button type="submit">Save Changes</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Jurassic-Care. All rights reserved.</p>
    </footer>
</body>

</html>