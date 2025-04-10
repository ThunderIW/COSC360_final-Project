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
    <title>Checkout</title>
    <link rel="stylesheet" href="assets/CSS/checkout.css" />
    <script src="scripts/profileDropDown.js" defer></script>
</head>

<body>
    <!-- Navbar -->
    <nav>
        <div class="nav-container">
            <div class="logo">
                <img src="assets/logos/dinosaur.png" alt="Company Logo" width="40" />
            </div>
            <div class="nav-links">
                <a href="homePage.php">Home</a>
                <a href="Shop.php">Shop</a>
                <a href="#">Projects</a>
                <a href="Contact.php">Contact us</a>
                <a href="checkout.html" class="active"> Checkout</a>
            </div>
            <div class="profile-container">
                <button class="profile-button" id="user-menu-button">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                        alt="User Profile" />
                </button>
                <div id="user-dropdown" class="dropdown-menu">
                    <a href="#">Your Profile</a>
                    <a href="login.html">Sign out</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="checkout">
        <section class="prompt">
            <h1>Ready to Checkout?</h1>
            <h2>Finalize your order right here!</h2>
        </section>

        <section class="shoppinglist">
            <h2>Here is the list of dinosaurs in your cart:</h2>
            <div class="cart_list">
                <?php if (empty($Dinosaurs)): ?>
                    <div class="empty_cart">
                        <p> There are no dinosaurs in your cart!</p>
                        <button class="shopmore" onclick="window.location.href = 'Shop.php';">
                            Add dinosaurs to your cart!
                        </button>
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
                                <p class="quantity">Quantity: <?php echo $dino['quantity']; ?></p>
                                <p class="price" id="subtotal_<?php echo $dino['dino_id']; ?>">Subtotal:
                                    $<?php echo number_format($dino['price'] * $dino['quantity'], 2); ?></p>
                            </div>

                        </div>
                    <?php endforeach; ?>


                <?php endif; ?>
            </div>

            </div>
            <div class="more_dinos">
                <p>Want to add more dinosaurs to your cart?</p>
                <button class="shopmore" onclick="window.location.href = 'Shop.php';">
                    Redirect Me!
                </button>
            </div>
        </section>

        <section class="pay">
            <h2>How would you like to pay for your dinosaurs?</h2>
            <input type="radio" id="creditcard" name="paymenttype" value="creditcard" />
            <label>Credit Card</label>
            <br />
            <input type="radio" id="debitcard" name="paymenttype" value="debitcard" />
            <label>Debit Card</label>
            <br />
            <input type="radio" id="paypal" name="paymenttype" value="paypal" />
            <label>PayPal</label>

            <div class="totals">
                <h3> Total Amount:</h3>
                <p class="total_price" id="total_price">Total Price: $<?php echo number_format($total, 2); ?></p>
                <p class="total_quantity" id="total_quantity">Total Number of
                    Dinosaurs: <?php echo array_sum(array_column($Dinosaurs, 'quantity')); ?> </p>

                <button class="finalize"> Finalize Order</button>
            </div>

        </section>
    </main>
    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Your Company. All rights reserved.</p>
    </footer>
</body>

</html>