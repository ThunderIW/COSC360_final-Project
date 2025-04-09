<?php
session_start();
include_once("SeverConfigs.php");
header('Content-Type: application/json');
if (!isset($_SESSION["id"])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged into your account in order to put dinosaurs in your cart']);
    exit;
}

$user_id = $_SESSION["id"];

$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

if ($data && isset($data['dino_id']) && isset($data['quantity'])) {
    $dino_id = $data['dino_id'];
    $quantity = (int) $data['quantity'];

    try {
        //checks if the dinosaur exists from the dino_catalogue database
        $dinoExists = "SELECT * FROM dino_catalogue WHERE id = :dino_id AND status ='available'";
        $dinostmt = $pdo->prepare($dinoExists);
        $dinostmt->bindParam(':dino_id', $dino_id, PDO::PARAM_INT);
        $dinostmt->execute();


        $checkCart = "SELECT * FROM cart WHERE user_id = :user_id AND dino_id = :dino_id";
        $cartstmt = $pdo->prepare($checkCart);
        $cartstmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $cartstmt->bindParam(':dino_id', $dino_id, PDO::PARAM_INT);
        $cartstmt->execute();

        //Checking whether there is an existing dinosaur in the cart. If there is one in the cart, the dinosaur is updated. Otherwise, add a new dinosaur into the cart
        if ($cartstmt->rowCount() > 0) {
            $updateDino = "UPDATE cart SET quantity = quantity + :quantity, created_at = CURRENT_TIMESTAMP WHERE user_id =:user_id AND dino_id = :dino_id";
            $updatestmt = $pdo->prepare($updateDino);
            $updatestmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $updatestmt->bindParam(':dino_id', $dino_id, PDO::PARAM_INT);
            $updatestmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $updatestmt->execute();
            echo json_encode(['success' => true, 'message' => 'Your quantity of dinosaurs has been updated!']);
        } else {
            $insertDino = "INSERT INTO cart (user_id,dino_id,quantity) VALUES (:user_id,:dino_id,:quantity)";
            $insertstmt = $pdo->prepare($insertDino);
            $insertstmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $insertstmt->bindParam(':dino_id', $dino_id, PDO::PARAM_INT);
            $insertstmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $insertstmt->execute();
            echo json_encode(['success' => true, 'message' => 'This dinosaur(s) has been added to your cart!']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Connection issues:' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Unsuccessful']);
}
?>