<?php
session_start();
$green_text = false;
$red_text = false;
$message_to_be_displayed = "";

if (isset($_SESSION["toast_success"])) {
    $message_to_be_displayed = $_SESSION["toast_success"];
    $green_text = true;
    unset($_SESSION["toast_success"]);
}

if (isset($_SESSION["login_success"])) {
    $alertToSend = $_SESSION["login_success"];
    unset($_SESSION["login_success"]);
}
if (isset($_SESSION["error_message"])) {
    $message_to_be_displayed = $_SESSION["error_message"];
    $red_text = true;
    unset($_SESSION["error_message"]);
}
$userImage = $_SESSION["user_image"];
function cleanValue($value)
{
    return htmlspecialchars(trim($value, "'\""));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <link rel="stylesheet" href="assets/CSS/admin.css" />
    <script src="scripts/profileDropDown.js" defer></script>
    <script src="scripts/confirmDelete.js" defer></script>
    <script src="scripts/autoHideSignInOut.js" defer></script>
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
                    echo '<a href="admin.php" class="active"> Admin</a>';
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

    <div style="display: flex; justify-content: center; width: 100%;">
        <p class="signup-success-message"
            style="color: <?php echo $green_text ? 'green' : ($red_text ? 'red' : 'green'); ?>;  font-weight: bold">
            <?php echo $message_to_be_displayed; ?>
        </p>
    </div>

    <section class="admin">
        <div class="adminform">
            <div class="delete">
                <h2> List of Users</h2>
                <div class="searching_users">
                    <form method="GET" action="admin.php">
                        <input type="text" name="findUsers"
                            value="<?php echo isset($_GET['findUsers']) ? htmlspecialchars($_GET['findUsers']) : ''; ?>"
                            placeholder="Search for users by first name, last name or email address">
                        <button class="search" type="submit">Filter</button>
                    </form>
                </div>
                <?php
                include_once("SeverConfigs.php");
                $conn = new PDO("mysql:host=localhost;dbname=users", "root", "");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

                if (isset($_GET['findUsers']) && !empty($_GET['findUsers'])) {
                    $searchResults = $_GET['findUsers'];
                    $searchSQL = "SELECT * FROM users WHERE isAdmin = 0 AND CONCAT(firstName,' ',lastName,' ',email) LIKE :searchResults";
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
                    echo "<h3>No users found.</h3>";
                } else {
                    echo "<table border='1'>
                <tr> 
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Delete User</th>
                </tr>";

                    foreach ($rows as $eachRow) {
                        $id = cleanValue($eachRow["id"]);
                        $firstName = cleanValue($eachRow["firstName"]);
                        $lastName = cleanValue($eachRow["lastName"]);
                        $email = cleanValue($eachRow["email"]);
                        $username = $firstName . ' ' . $lastName;

                        echo "<tr>
                        <td>$id</td>
                        <td>$firstName</td>
                        <td>$lastName</td>
                        <td>$email</td>
                        <td>
                            <form method='POST' action='deleteFromDb.php' class='delete-user-form' data-username='" . htmlspecialchars($username) . "'>
                                <input type='hidden' name='id' value='$id'>
                                <button type='submit'>Delete User</button>
                            </form>
                        </td>
                    </tr>";
                    }

                    echo "</table>";
                }
                ?>
            </div>
        </div>

        <div class="add_dino">
            <h2> Add a Dinosaur!</h2>
            <form class="add_dino_form_section" method="POST" action="dinosaur_validate.php"
                enctype="multipart/form-data">
                <label> Name:</label>
                <input type="text" id="name" name="name" placeholder="Dinosaur Name" required><br>
                <label> Short Description:</label>
                <input type="text" id="short_desc" name="short_desc" placeholder="Add a short description" required><br>
                <label> Long Description:</label>
                <input type="text" id="long_desc" name="long_desc" placeholder="Add a long description" required><br>
                <label> Price: $ </label>
                <input type="text" id="price" name="price" placeholder="Add a Dinosaur Price" required><br>
                <label> image_address:</label>
                <input type="text" id="dino_image" name="dino_image" placeholder="Add image link" required><br>
                <label> Status:</label>
                <input type="text" id="status" name="status" placeholder="Add a status"><br>
                <label> Tags:</label>
                <input type="text" id="tags" name="tags" placeholder="Add tags (make sure to use commas)"><br>
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

    <!-- Delete Confirmation Modal -->
    <div id="confirmModal" class="modal-overlay" style="display: none;">
        <div class="modal-box">
            <p>Are you sure you want to delete this user?</p>
            <div class="modal-buttons">
                <button id="confirmYes" class="btn btn-danger">Yes, Delete</button>
                <button id="confirmNo" class="btn btn-cancel">Cancel</button>
            </div>
        </div>
    </div>

    <?php /*
if (isset($green_text) && $green_text): ?>
<div id="toast" class="toast">
<?php echo $message_to_be_displayed; ?>
</div>
<script>
setTimeout(() => {
const toast = document.getElementById("toast");
if (toast) toast.remove();
}, 4000);
</script>
<?php endif;
*/ ?>

</body>

</html>