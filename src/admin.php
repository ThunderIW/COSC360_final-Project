<?php
session_start();
if (isset($_SESSION["login_success"])) {
    $alertToSend = $_SESSION["login_success"];
    unset($_SESSION["login_success"]);
}
$userImage = $_SESSION["user_image"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <link rel="stylesheet" href="./assets/CSS/admin.css" />
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

    <!-- Features Section -->
    <section class>
        <form class="admin">
            <div class="admingroup">
                <h2> List of Users</h2>
                <?php
                include_once("SeverConfigs.php");
                $conn = new PDO("mysql:host=localhost;dbname=users", "root", "");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
                $sql = "SELECT id, firstName, lastName, email FROM users WHERE isAdmin = 0";
                $userList = $conn->prepare($sql);
                $userList->execute();
                $rows = $userList->fetchAll(PDO::FETCH_ASSOC);
                if (count($rows) === 0) {
                    echo "<h3>There are active users!</h3>";
                } else {
                    echo '<div class="table">';
                    echo "<table border = '1'>";
                    echo " <tr> 
                <th>ID</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Email</th>
                <th>Delete User?</th>
                </tr>";
                    foreach ($rows as $eachRow) {
                        echo "<tr>";
                        echo "<td>" . $eachRow["id"] . "</td>";
                        echo "<td>" . $eachRow["firstName"] . "</td>";
                        echo "<td>" . $eachRow["lastName"] . "</td>";
                        echo "<td>" . $eachRow["email"] . "</td>";
                        echo "<td>
                    <form method='POST' action='deleteFromDb.php'>
                    <input type='hidden' name='id' value='" . $eachRow["id"] . "'>
                    <button type='submit'>Delete User</button>
                    </form>
                    </td>";
                        echo "</tr>";

                        echo "</table>";
                    }
                }
                ?>
            </div>
        </form>

    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Jurassic-Care. All rights reserved.</p>
    </footer>
</body>

</html>