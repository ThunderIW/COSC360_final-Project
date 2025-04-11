<?php
session_start();
include_once("SeverConfigs.php");
if (isset($_SESSION["login_success"])) {
    $alertToSend = $_SESSION["login_success"];
    unset($_SESSION["login_success"]);
}

$userImage = $_SESSION["user_image"];


if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$dino_id = $_GET['id'];
$user_id = $_SESSION['id'];

try {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM orders WHERE user_id = ? AND dino_id = ?");
    $stmt->execute([$user_id, $dino_id]);
    $purchased = ($stmt->fetchColumn() > 0);

    if (!$purchased) {
        header("Location: Product.php?id=" . $dino_id . "&error=notPurchasedBefore");
        exit();
    }

    $stmt = $pdo->prepare("SELECT name,image_address FROM dino_catalogue WHERE id = ?");
    $stmt->execute([$dino_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        header("Location: Shop.php");
        exit();
    }

    $dino_name = $result['name'];
    $dino_image = $result['image_address'];

    $user = $pdo->prepare("SELECT firstName,lastName FROM users WHERE id =?");
    $user->execute([$user_id]);
    $userResult = $user->fetch(PDO::FETCH_ASSOC);
    $user_name = $userResult['firstName'] . ' ' . $userResult['lastName'];

} catch (PDOException $e) {
    error_log("Error " . $e->getMessage());
    header("Location: Shop.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Review</title>
    <link rel="stylesheet" href="../src/makereview.css" />
    <script src="scripts/profileDropDown.js" defer></script>
</head>

<body>
    <?php
    if (isset($alertToSend)) {
        echo "<script type='text/javascript'>alert('$alertToSend');</script>";
    }
    ?>
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

    <div class="review">
        <h2>Write your review for <?php echo $dino_name; ?></h2>
        <form action="submitReview.php" method="POST">
            <input type="hidden" name="dino_id" value="<?php echo $dino_id; ?>">
            <textarea name="review" placeholder="Write your review ..." required></textarea><br>
            <button>Submit review</button>
        </form>
    </div>


    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Jurassic-Care. All rights reserved.</p>
    </footer>
</body>

</html>