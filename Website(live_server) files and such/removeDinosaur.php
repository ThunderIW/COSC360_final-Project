<?php
session_start(); // ✅ Required to access the session
include_once("SeverConfigs.php");
header('Content-Type: application/json');

if (!isset($_SESSION["id"])) {
    echo json_encode(['success' => false, 'message' => 'You need to be logged!']);
    exit();
}

$user_id = $_SESSION["id"];

$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

if ($data && isset($data['dino_id'])) {
    $dino_id = $data['dino_id'];
    try {
        $deletion = $pdo->prepare("DELETE FROM cart WHERE dino_id = :dino_id AND user_id = :user_id");
        $deletion->bindParam(':dino_id', $dino_id, PDO::PARAM_INT);
        $deletion->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $result = $deletion->execute();


        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Dinosaur was successfully removed!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Dinosaur was not removed']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Connection issues:' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Request is not working']);
}

?>