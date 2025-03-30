<?php
session_start();
include_once("SeverConfigs.php");

try {
    // Check if session['id'] is set. If not, redirect to login.php
    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit();
    }

    // If $_GET['id'] is not an integer between 1 and 14 (both inclusive), show an error msg saying "Invalid id"
    if (!isset($_GET['id']) || !is_numeric($_GET['id']) || $_GET['id'] < 1 || $_GET['id'] > 14) {
        echo "Invalid id";
        exit;
    }

    $id = $_GET['id'];

    // Fetch the row from the dino_catalogue table where id matches
    $query = "SELECT name FROM dino_catalogue WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $name = $product['name'];
    } else {
        echo "Product not found.";
        exit;
    }

    // Handle form submission for review
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if review text is not empty
        if (!empty($_POST['reviewText'])) {
            $reviewText = trim($_POST['reviewText']);
            
            // Check if the user has purchased the dinosaur
            $checkPurchaseQuery = "SELECT * FROM orders WHERE user_id = :userId AND dino_id = :dinoId";
            $checkStmt = $pdo->prepare($checkPurchaseQuery);
            $checkStmt->bindParam(':userId', $_SESSION['id'], PDO::PARAM_INT);
            $checkStmt->bindParam(':dinoId', $id, PDO::PARAM_INT);
            $checkStmt->execute();

            if ($checkStmt->rowCount() > 0) {
                // User has purchased the dinosaur, now insert the review
                $userName = $_SESSION['firstname'] . $_SESSION['lastname'];
                $insertReviewQuery = "INSERT INTO reviews (user_id, dino_id, review_text, user_name) 
                                      VALUES (:userId, :dinoId, :reviewText, :userName)";
                $insertStmt = $pdo->prepare($insertReviewQuery);
                $insertStmt->bindParam(':userId', $_SESSION['id'], PDO::PARAM_INT);
                $insertStmt->bindParam(':dinoId', $id, PDO::PARAM_INT);
                $insertStmt->bindParam(':reviewText', $reviewText, PDO::PARAM_STR);
                $insertStmt->bindParam(':userName', $userName, PDO::PARAM_STR);
                $insertStmt->execute();

                // Redirect back to the Product page
                header("Location: Product.php?id=$id");
                exit();
            } else {
                echo "<script>alert('You can\'t review a dinosaur you haven\'t bought.');</script>";
            }
        } else {
            echo "<script>alert('Please enter your review before submitting');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Review Product</title>
    <script src="scripts/newsletterEmailValidation.js" defer></script>
</head>
<body>
    <h2>Review <?php echo htmlspecialchars($name); ?></h2>

    <form id="reviewForm" action="" method="POST">
        <textarea id="reviewText" name="reviewText" placeholder="Write your review here..." maxlength="480"></textarea>
        <br>
        <button type="submit" id="submitReview">Submit</button>
        <button type="button" id="cancelReview" onclick="window.location.href='Product.php?id=<?php echo $_GET['id']; ?>'">Cancel</button>
    </form>

    <script>
        document.getElementById("submitReview").addEventListener("click", function(event) {
            event.preventDefault(); // Prevent form submission

            var reviewText = document.getElementById("reviewText").value.trim();
            if (reviewText === "") {
                alert("Please enter your review before submitting");
            } else {
                // Form will be submitted automatically when the button is clicked
                document.getElementById("reviewForm").submit();
            }
        });
    </script>
</body>
</html>

<?php
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
