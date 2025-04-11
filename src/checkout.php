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
                <a href="homePage.php" class="active">Home</a>
                <a href="Shop.php">Shop</a>
                <a href="About_us.php">About Us</a>
                <a href="Contact.php">Contact us</a>
                <a href="viewCart.php">Cart</a>
                <?php
                if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) {
                    echo '<a href="admin.php"> Admin</a>';
                }
                ?>
                <a href="checkout.php" class="active"> Checkout</a>

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

                <button id="finalize"> Finalize Order</button>
            </div>

        </section>
    </main>
    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Your Company. All rights reserved.</p>
    </footer>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const button = document.getElementById("finalize");
        if (button) {
            button.addEventListener('click', makeOrder);
        }
        function makeOrder() {
            const getPaymentMethods = document.querySelectorAll('input[name="paymenttype"]');
            let chosenPaymentMethod = null;

            for (const method of getPaymentMethods) {
                if (method.checked) {
                    chosenPaymentMethod = method.value;
                    break;
                }
            }
            if (!chosenPaymentMethod) {
                alert('You need to select a specific payment method in otder to finalize your order!');
                return;
            }
            fetch('finalizeOrder.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    payment_method: chosenPaymentMethod
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        clearCart();
                        document.getElementById('total_price').textContent = 'Total Price: $0.00';
                        document.getElementById('total_quantity').textContent = 'Total Number of Dinosaurs: 0';



                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    alert(error);
                })
        }
    })

    function clearCart() {
        const cart = document.querySelector('.cart_list');
        if (!cart) return;
        cart.innerHTML = '';
        const cartIsEmpty = document.createElement('div');
        cartIsEmpty.className = 'empty_cart';

        const message = document.createElement('p');
        message.textContent = 'No dinosaurs are in your cart!';

        const button = document.createElement('button');
        button.className = 'shopmore';
        button.textContent = 'Add dinosaurs to your cart!';
        button.onclick = function () {
            window.location.href = 'Shop.php';
        };

        cartIsEmpty.appendChild(message);
        cartIsEmpty.appendChild(button);
        cart.appendChild(cartIsEmpty);
    }

</script>

</html>