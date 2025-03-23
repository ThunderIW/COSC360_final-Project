<?php
session_start();

define('DB_HOST', 'localhost');
define('DB_NAME', 'iwiessle');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

try {
    $conn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
    $pdo = new PDO($conn, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Default query: Get the top 4 most popular dinosaurs
    $stmt = $pdo->query("SELECT id, name, price, short_description, image_address FROM dino_catalogue LIMIT 4");
    $dinos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Handle AJAX filtering request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tags'])) {
    $tags = json_decode($_POST['tags'], true);
    $searchString = isset($_POST['search']) ? $_POST['search'] : '';

    $conditions = [];
    $params = [];

    if ($searchString) {
        $conditions[] = "(LOWER(name) LIKE ? OR LOWER(short_description) LIKE ? OR LOWER(long_description) LIKE ?)";
        $params[] = '%' . strtolower($searchString) . '%';
        $params[] = '%' . strtolower($searchString) . '%';
        $params[] = '%' . strtolower($searchString) . '%';
    }

    if (!empty($tags)) {
        foreach ($tags as $tag) {
            $conditions[] = "LOWER(tags) LIKE ?";
            $params[] = '%' . strtolower($tag) . '%';
        }
    }

    $sql = "SELECT id, name, price, short_description, image_address FROM dino_catalogue";
    if (!empty($conditions)) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $dinos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Generate filtered results as HTML for AJAX response
    if (!empty($dinos)) {
        foreach ($dinos as $dino) {
            echo '<a href="Product.php?id=' . htmlspecialchars($dino['id']) . '" class="product-link">
                    <div class="product">
                        <img src="' . htmlspecialchars($dino['image_address']) . '" alt="' . htmlspecialchars($dino['name']) . '">
                        <h3>' . htmlspecialchars($dino['name']) . '</h3>
                        <p>$' . htmlspecialchars($dino['price']) . '</p>
                        <p>' . htmlspecialchars($dino['short_description']) . '</p>
                    </div>
                </a>';
        }
    } else {
        echo '<p>No dinosaurs meet those criteria.</p>';
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="CSS/shopPage.css">
    <script src="scripts/profileDropDown.js" defer></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const checkboxes = document.querySelectorAll(".filter-checkbox");
            const searchInput = document.querySelector("#search-input");
            const searchButton = document.querySelector("#search-button");
            const clearSearchButton = document.querySelector("#clear-search-button");

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", fetchFilteredDinos);
            });

            searchButton.addEventListener("click", function() {
                fetchFilteredDinos(true); // Pass true to indicate a search
            });

            clearSearchButton.addEventListener("click", function() {
                searchInput.value = ''; // Clear search input
                fetchFilteredDinos(false); // Reset to default
            });

            function fetchFilteredDinos(isSearch = false) {
                let checkedTags = [];
                document.querySelectorAll(".filter-checkbox:checked").forEach(checkbox => {
                    checkedTags.push(checkbox.value.trim().toLowerCase());
                });

                let searchString = isSearch ? searchInput.value.trim() : '';

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "Shop.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        // If no checkboxes are checked and no search term, show first 4 rows
                        if (!checkedTags.length && !searchString) {
                            xhr.responseText = xhr.responseText.split('</a>').slice(0, 4).join('</a>') + '</a>';
                        }
                        document.querySelector(".products").innerHTML = xhr.responseText;
                    }
                };
                xhr.send("tags=" + JSON.stringify(checkedTags) + "&search=" + encodeURIComponent(searchString));
            }
        });
    </script>
</head>
<body>
    <nav>
        <div class="nav-container">
            <div class="logo">
                <img src="../src/assets/logos/dinosaur.png" alt="Company Logo" width="40" />
            </div>
            <div class="nav-links">
                <a href="homePage.html">Home</a>
                <a href="Shop.php" class="active">Shop</a>
                <a href="About_us.html">About Us</a>
                <a href="Contact.html">Contact us</a>
                <a href="checkout.html">Checkout</a>
            </div>
            <div class="profile-container">
                <button class="profile-button" id="user-menu-button">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="User Profile">
                </button>
                <div id="user-dropdown" class="dropdown-menu">
                    <a href="Profile.html">Your Profile</a>
                    <a href="login.html">Sign out</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="search-bar-container">
        <input type="text" placeholder="Search products..." id="search-input">
        <button type="submit" id="search-button">Search</button>
        <button type="button" id="clear-search-button">Clear Search</button>
    </div>

    <div class="shop-container">
        <aside class="sidebar">
            <h2>Filters</h2>
            <h3>Price</h3>
            <input type="range" class="price-range">
            <p>between $1-$100</p>
            <h3>Categories</h3>
            <ul>
                <?php 
                $tags = ["Companion", "Guard Dino", "Working Dino", "Farm Dino", "Flying", "Aquatic", 
                         "Scout Dino", "Smart", "Herbivore", "Gentle", "Search and Rescue", "Fast", 
                         "Mobility", "Messenger Dino", "Hunting Dino"];
                foreach ($tags as $tag): ?>
                    <li>
                        <input type="checkbox" class="filter-checkbox" value="<?= htmlspecialchars($tag); ?>">
                        <?= htmlspecialchars($tag); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </aside>

        <section class="products">
            <h2>Our Most Popular Dinos</h2>
            <div class="product-grid">
                <?php foreach ($dinos as $dino): ?>
                    <a href="Product.php?id=<?= htmlspecialchars($dino['id']); ?>" class="product-link">
                        <div class="product">
                            <img src="<?= htmlspecialchars($dino['image_address']); ?>" alt="<?= htmlspecialchars($dino['name']); ?>">
                            <h3><?= htmlspecialchars($dino['name']); ?></h3>
                            <p>$<?= htmlspecialchars($dino['price']); ?></p>
                            <p><?= htmlspecialchars($dino['short_description']); ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>
    </div>

    <footer>
        <p>&copy; 2025 Your Company. All rights reserved.</p>
    </footer>
</body>
</html>
