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
    <link rel="stylesheet" href="assets/CSS/cart.css" />
    <script src="scripts/newsletterEmailValidation.js" defer></script>
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

    <div class="cart_list">
        <h2>List of Dinosaurs in your cart:</h2>
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
                        <p class="quantity">Quantity: </p>
                        <input type="number" id="quantity_<?php echo $dino['dino_id']; ?>"
                            value="<?php echo $dino['quantity']; ?>" min="1"
                            onchange="updateQuantity(<?php echo $dino['dino_id']; ?>,<?php echo $dino['price']; ?>)" />
                        <p class="price" id="subtotal_<?php echo $dino['dino_id']; ?>">Subtotal:
                            $<?php echo number_format($dino['price'] * $dino['quantity'], 2); ?></p>
                        <button class="delete_dino" type="submit" onclick="removeDinosaur(<?php echo $dino['dino_id']; ?>)">
                            Delete Dinosaur</button>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="totals">
                <h3> Total Amount:</h3>
                <p class="total_price" id="total_price">Total Price: $<?php echo number_format($total, 2); ?></p>
                <p class="total_quantity" id="total_quantity">Total Number of
                    Dinosaurs: <?php echo array_sum(array_column($Dinosaurs, 'quantity')); ?> </p>
                <button class="shopmore" onclick="window.location.href = 'Shop.php';">
                    Want more dinosaurs? Continue shopping here!
                </button><br>
                <button class="shopmore" onclick="window.location.href = 'checkout.php';">
                    Finalize your purchase? Checkout here!
                </button><br>
            </div>

        <?php endif; ?>
    </div>


    <script>
        function updateQuantity(dinoid, price) {
            const quantity = document.getElementById('quantity_' + dinoid);
            const subtotal = document.getElementById('subtotal_' + dinoid);

            const quantityOfDino = parseInt(quantity.value);
            const newSubtotal = quantityOfDino * price;
            subtotal.textContent = "Subtotal: $" + newSubtotal.toFixed(2);

            updateTotal();
            updateDinosaur(dinoid, quantityOfDino);
        }

        function updateTotal() {
            const allQuantities = document.querySelectorAll('input[id^="quantity_"]');

            let totalPrice = 0;
            let totalQuantity = 0;

            allQuantities.forEach(input => {
                const dinoId = input.id.replace('quantity_', '');
                const quantity = parseInt(input.value);

                const priceElement = input.closest('.dinosaur_details').querySelector('.price');
                const priceText = priceElement.textContent;
                const price = parseFloat(priceText.replace('Price: $', '').trim().replace(',', ''));

                totalQuantity += quantity;
                totalPrice += price * quantity;
            });
            document.getElementById('total_price').textContent = 'Total Amount: $' + totalPrice.toFixed(2);
            document.getElementById('total_quantity').textContent = 'Total Quantity: ' + totalQuantity;


        }

        function updateDinosaur(dinoid, quantity) {
            fetch("updateDinosaur.php", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    dino_id: dinoid,
                    quantity: quantity
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (!data.success) {
                        alert(data.message);
                    }
                }).catch(error => {
                    alert(error);
                })
        }



        function removeDinosaur(dinoid) {
            if (confirm("Would you like to remove this dinosaur from your cart?")) {
                fetch("removeDinosaur.php", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        dino_id: dinoid
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
            }
        }

    </script>




    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Jurassic-Care. All rights reserved.</p>
    </footer>
</body>

</html>