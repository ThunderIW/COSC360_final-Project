<?php
session_start();
include_once("SeverConfigs.php");

header('Content-Type: application/json');

if (!isset($_SESSION["id"])) {
    echo json_encode(['success' => false, 'message' => 'You are not logged in!']);
    exit();
}

$user_id = $_SESSION["id"];


$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

if (!isset($data['payment_method'])) {
    echo json_encode(['success' => false, 'message' => 'You need to choose a payment method!']);
    exit();
}

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("SELECT c.dino_id,c.quantity FROM cart c 
    JOIN dino_catalogue d ON c.dino_id = d.id
    WHERE c.user_id = ?");
    $stmt->execute([$user_id]);
    $Dinosaurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($Dinosaurs)) {
        $pdo->rollBack();
        echo json_encode(['success' => false, 'message' => 'You have an empty cart!']);
        exit();
    }
    $date = date('Y-m-d');

    $stmt = $pdo->prepare("INSERT INTO orders(user_id,dino_id,quantity,date) VALUES(?,?,?,?)");
    $orderIds = [];

    foreach ($Dinosaurs as $dino) {
        $stmt->execute([
            $user_id,
            $dino['dino_id'],
            $dino['quantity'],
            $date
        ]);
        $orderIds[] = $pdo->lastInsertId();
    }
    $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $pdo->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Order has been finalized!',
        'order_date' => $date,
        'order_id' => $orderIds[0] ?? null
    ]);
} catch (PDOException $e) {
    $pdo->rollBack();
    error_log("order issues:" . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error!']);
}

?>