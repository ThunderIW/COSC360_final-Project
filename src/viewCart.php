<?php
session_start();
include_once("SeverConfigs.php");

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["id"];
$Dinosaurs = []; //the dinosaurs in your cart
$total = 0; //total price of all dinosaurs

try {
    $dinosaurs = "SELECT c.dino_id, c.quantity, d.name,d.price,d.image_address
            FROM cart c
            JOIN dino_catalogue d ON c.dino_id = d.id
            WHERE c.user_id = ?";

    $stmt = $pdo->prepare($dinosaurs);
    $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
    $stmt->execute();

    $Dinosaurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($Dinosaurs as $dino) {
        $total += $dino['price'] * $dino['quantity'];
    }
} catch (PDOException $e) {
    die($e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dinosaur Cart</title>
    <link rel="stylesheet" href="../src/cart.css" />
    <script src="scripts/newsletterEmailValidation.js" defer></script>
    <script src="scripts/profileDropDown.js" defer></script>
</head>

<body>
    <nav>
        <div class="nav-container">
            <div class="logo">
                <img src="assets/logos/dinosaur.png" alt="Company Logo" width="40" />
            </div>
            <div class="nav-links">
                <a href="homePage.php">Home</a>
                <a href="Shop.php">Shop</a>
                <a href="About_us.php">About Us</a>
                <a href="Contact.php">Contact us</a>
                <a href="viewCart.php" class="active">Cart</a>
                <?php
                if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) {
                    echo '<a href="admin.php"> Admin</a>';
                }
                ?>
                <a href="checkout.php"> Checkout</a>

            </div>
            <div class="profile-container">
                <button class="profile-button" id="user-menu-button">
                    <img src="<?php echo isset($_SESSION['email']) && !empty($_SESSION['user_image']) ? 'data:image/png;base64,' . $_SESSION['user_image'] : 'assets/emptyIcon.png'; ?>"
                        alt="User Profile" />
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

    <div class="cart_list">
        <h2>All Dinosaurs in your cart!</h2>
        <?php if (empty($Dinosaurs)): ?>
            <div class="empty-cart">
                <p> There are no dinosaurs in your cart!</p>
                <a href="Shop.php">Add Dinosaurs to your cart!</a>
            </div>
        <?php else: ?>
            <?php foreach ($Dinosaurs as $dino): ?>
                <div class="dinosaur_item">
                    <div class="dinosaur_image">
                        <img src="<?php echo $dino['image_address']; ?>" alt="<?php echo $dino['name']; ?>">
                    </div>
                    <div class="dinosaur_details">
                        <h3><?php echo $dino['name']; ?></h3>
                        <p class="price">Price: $<?php echo number_format($dino['price'], 2); ?> </p>
                        <p class="quantity">Quantity: <?php echo $dino['quantity']; ?> </p>
                        <p class="price">Subtotal: $<?php echo number_format($dino['price'] * $dino['quantity'], 2); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>

        <!-- Footer -->
        <footer>
            <p>&copy; 2025 Jurassic-Care. All rights reserved.</p>
        </footer>
</body>

</html>