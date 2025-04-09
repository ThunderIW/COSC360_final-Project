<?php
session_start();
include_once("SeverConfigs.php");

$userImage = $_SESSION["user_image"];

try {
    // Get the 'id' parameter from the URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Fetch the row from the dino_catalogue table where id matches
        $query = "SELECT name, price, short_description, long_description, image_address, status, tags FROM dino_catalogue WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            $name = $product['name'];
            $price = $product['price'];
            $short_description = $product['short_description'];
            $long_description = $product['long_description'];
            $image_address = $product['image_address'];
            $status = $product['status'];
            $tags = $product['tags'];
        } else {
            echo "Product not found.";
            exit;
        }
    } else {
        echo "No product ID provided.";
        exit;
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Product</title>
        <link rel="stylesheet" href="assets/CSS/productPage.css" />
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
                <a href="Shop.php" class="active">Shop</a>
                <a href="About_us.php">About us</a>
                <a href="Contact.php">Contact us</a>
                <a href="checkout.html">Checkout</a>
            </div>
            <div class="profile-container">
                <button class="profile-button" id="user-menu-button">
                    <img src="<?php echo isset($_SESSION['email']) && !empty($_SESSION['user_image']) ? 'data:image/png;base64,' . $_SESSION['user_image'] : 'assets/emptyIcon.png'; ?>" alt="User Profile" />
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
    
    <h2 style="margin-left: 10px">Product Page</h2>
    <div id="ProductItem">
        <div id="ProductImage">
            <img src="<?php echo $image_address; ?>" alt="Product Image" width="300" />
        </div>
        <div id="ProductDesc">
            <h3><?php echo $name; ?></h3>
            <p id="Price"><strong>Price:</strong> $<?php echo $price; ?></p>
            <p><strong>Description:</strong> <?php echo $long_description; ?></p>
            <div id="Amount">
                <div id="inputs">
                    <label for="quantity">How many:</label>
                    <input type="number" id="quantity" name="quantity" min="1" value="1" />
                    <button>Add to Cart</button>
                </div>
            </div>
            <div id="review">
                <h4>Provide Feedback / Review this Dinosaur</h4>
                <button id="addReview">Add your review</button>
            </div>
        </div>
    </div>
    
    <div id="Reviews">
        <h3>Latest Reviews</h3>
        <?php
        // Fetch reviews from the database
        $reviewQuery = "SELECT name, text FROM reviews WHERE dino_id = :id";
        $reviewStmt = $pdo->prepare($reviewQuery);
        $reviewStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $reviewStmt->execute();
        $reviews = $reviewStmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($reviews) {
            foreach ($reviews as $review) {
                echo '<div class="r-message">';
                echo '<p><strong>Review by ' . htmlspecialchars($review['name']) . ':</strong></p>';
                echo '<p>"' . htmlspecialchars($review['text']) . '"</p>';
                echo '</div>';
            }
        } else {
            echo '<p>No reviews available.</p>';
        }
        ?>
    </div>
    
    <script>
    document.getElementById("addReview").addEventListener("click", function() {
        <?php if (!isset($_SESSION['id'])): ?>
            alert("You must be logged in to leave a review");
        <?php else: ?>
            let userId = <?php echo json_encode($_SESSION['id']); ?>;
            let dinoId = <?php echo json_encode($_GET['id']); ?>;
            
            // Query to check if the user has purchased the dinosaur
            let query = "SELECT * FROM orders WHERE user_id = :user_id AND dino_id = :dino_id";
            let stmt = <?php echo json_encode($pdo); ?>.prepare(query);
            stmt.bindParam(':user_id', userId, PDO::PARAM_INT);
            stmt.bindParam(':dino_id', dinoId, PDO::PARAM_INT);
            
            stmt.execute()
                .then(response => {
                    if (response.rowCount > 0) {
                        window.location.href = "Review.php?id=" + dinoId;
                    } else {
                        alert("You can only review dinosaurs you've purchased");
                    }
                })
                .catch(error => console.error("Error:", error));
        <?php endif; ?>
    });
    </script>
    
    <footer>
        <p>&copy; 2025 Your Company. All rights reserved.</p>
    </footer>
    </body>
    </html>
    
    <?php
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
