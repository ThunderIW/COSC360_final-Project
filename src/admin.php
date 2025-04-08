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
    <link rel="stylesheet" href="../src/admin.css" />
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
                <a href="homePage.php">Home</a>
                <a href="Shop.php">Shop</a>
                <a href="About_us.php">About Us</a>
                <a href="Contact.php">Contact us</a>
                <?php
                if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) {
                    echo '<a href="admin.php" class="active"> Admin</a>';
                }
                ?>
                <a href="checkout.php"> Checkout</a>

            </div>

            <div class=" profile-container">
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

    <!-- Deletion, Search and Add Dinosaur Section -->
    <section class="admin">
        <form class="adminform">
            <div class="delete">
                <h2> List of Users</h2>
                <div class="searching_users">
                    <input type="text" name="findUsers" value="<?php if (isset($_GET['findUsers'])) {
                        echo $_GET['findUsers'];
                    } ?>" placeholder="Search for users by first name, last name or email address">
                    <button class="search" type="submit">Filter</button>
                </div>

                <?php
                include_once("SeverConfigs.php");
                $conn = new PDO("mysql:host=localhost;dbname=users", "root", "");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

                if (isset($_GET['findUsers']) && !empty($_GET['findUsers'])) {
                    $searchResults = $_GET['findUsers'];
                    $searchSQL = "SELECT * FROM users WHERE isAdmin = 0 && CONCAT(firstName,' ',lastName,' ',email) LIKE :searchResults";
                    $searchSQL_running = $conn->prepare($searchSQL);
                    $searchSQL_running->execute([':searchResults' => '%' . $searchResults . '%']);
                    $rows = $searchSQL_running->fetchAll(PDO::FETCH_ASSOC);

                } else {
                    $sql = "SELECT id, firstName, lastName, email FROM users WHERE isAdmin = 0";
                    $userList = $conn->prepare($sql);
                    $userList->execute();
                    $rows = $userList->fetchAll(PDO::FETCH_ASSOC);
                }

                if (count($rows) === 0) {
                    echo "<h3>There are active users!</h3>";
                } else {
                    echo "<table border = '1' > 
                <tr> 
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Delete User</th>
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
                    }
                    echo "</table>";
                }
                ?>
            </div>
        </form>


        <div class="add_dino">
            <h2> Add a Dinosaur!</h2>
            <form class="add_dino_form_section" method="POST" action="dinosaur_validate.php">
                <label> Name:</label>
                <input type="text" id="name" name="name" placeholder="Dinosaur Name" required></input> <br>
                <label> Short Description:</label>
                <input type="text" id="short_desc" name="short_desc" placeholder="Add a short description"
                    required></input> <br>
                <label> Price: $ </label>
                <input type="text" id="price" name="price" placeholder="Add a Dinosaur Price" required></input> <br>
                <label> image_address:</label>
                <input type="file" id="dino_image" name="dino_image" accept="image/png" required /> <br>
                <label> Status:</label>
                <input type="text" id="status" name="status" placeholder="Add a status"></input> <br>
                <label> Tags:</label>
                <input type="text" id="tags" name="tags"></input>
                <div class="add_dino_button">
                    <button class="add_dino_button" type="submit">Add a Dinosaur!</button>
                </div>
            </form>
        </div>

    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Jurassic-Care. All rights reserved.</p>
    </footer>
</body>

</html>