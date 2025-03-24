<?php
session_start();
include_once("SeverConfigs.php");
//define('DB_HOST', 'localhost');
//define('DB_NAME', 'iwiessle');
//define('DB_USERNAME', 'iwiessle');
//define('DB_PASSWORD', 'iwiessle');

$userImage =  $_SESSION["user_image"];




try {
    //$conn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
    //$pdo = new PDO($conn, DB_USERNAME, DB_PASSWORD);
    //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
        }
    } else {
        echo "No product ID provided.";
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
                <a href="Shop.php" class="active">Shop</a>
                <a href="About_us.php">About us</a>
                <a href="Contact.php">Contact us</a>
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

    <!-- Product Content -->
    <h2 style="margin-left: 10px">Product Page</h2>
    <div id="ProductItem">
        <div id="ProductImage">
            <!-- Display the image from the database -->
            <img src="<?php echo $image_address; ?>" alt="Product Image" width="300" />
        </div>
        <div id="ProductDesc">
            <!-- Display product details from the database -->
            <h3><?php echo $name; ?></h3>
            <p id="Price"><strong>Price:</strong> $<?php echo $price; ?></p>
            <p>
                <strong>Description:</strong> <?php echo $long_description; ?>
            </p>

            <div id="Amount">
                <div id="inputs">
                    <label for="quantity">How many:</label>
                    <input
                            type="number"
                            id="quantity"
                            name="quantity"
                            min="1"
                            value="1"
                    />
                    <button>Add to Cart</button>
                </div>
            </div>
            <div id="review">
                <h4>Provide Feedback / Review this Dinosaur</h4>
                <textarea placeholder="Write your review here..."></textarea>
                <button type="submit" id="submitReview">Submit Review</button>
            </div>
        </div>
    </div>

    <div id="Reviews">
        <h3>Latest Reviews</h3>
        <div class="r-message">
            <img src="review1.jpg" alt="Sally X Review Photo" width="100" />
            <p><strong>Amazing service! - 5 Stars</strong></p>
            <p>
                "From the moment I placed my order, I felt like a VIP. The delivery
                team even taught me how to command my dino! Now, my backyard is the
                talk of the neighborhood. 10/10 would recommend!" - <em>By Sally X</em>
            </p>
        </div>
        <div class="r-message">
            <img
                    src="review2.jpg"
                    alt="Jimmy Firecracker Review Photo"
                    width="100"
            />
            <p><strong>I love my terrifying looking baby! - 4 Stars</strong></p>
            <p>
                "Writing review live from this tree. My terrifying looking adorable
                baby accidentally smashed the roof of my house. My dog mysteriously
                disappeared the day I got my delivery, but I have never had a more
                cutsie pet!" - <em>By Jimmy Firecracker</em>
            </p>
        </div>
        <div class="r-message">
            <img
                    src="review3.jpg"
                    alt="WhiskersTheWonderCat Review Photo"
                    width="100"
            />
            <p>
                <strong>
                    Revolutionary! Takes the lead in assistance! - 5 Stars</strong>
            </p>
            <p>
                "Finally, a pet that can fetch my groceries in one bite! My dinosaur also
                doubles as an incredible deterrent against door-to-door salesmen. My
                productivity has skyrocketed!" - <em>By WhiskersTheWonderCat</em>
            </p>
        </div>
    </div>

    <h3 id="newsletterHeader">Follow the Trend with Our Newsletter</h3>
    <div id="Newsletter">
        <label for="email">Email:</label>
        <input
                type="email"
                id="email"
                name="email"
                placeholder="Enter your email"
        />
        <span id="emailError" class="error-message"></span>
        <!-- Inline Error Message -->
        <button id="newsletterSubmit" type="submit">Submit</button>
    </div>

    <div class="socials">
        <img src="assets/email_16.png" />
        <img src="assets/facebook_16.png" />
        <img src="assets/twitter_16.png" />
    </div>

    <!-- Footer -->
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
