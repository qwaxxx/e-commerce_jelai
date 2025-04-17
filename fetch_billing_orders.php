<?php
header('Content-Type: application/json');
session_start();
include 'api/conn.php';

$user_id = $_SESSION['user_id'] ?? null;
$temp_id = $_SESSION['temp_id'] ?? null;

$response = [];

if ($user_id || $temp_id) {
    $id_field = $user_id ? "user_id" : "temp_id";
    $id_value = $user_id ?? $temp_id;

    $stmt = $conn->prepare("SELECT * FROM billing_orders WHERE billing_$id_field = ?");
    $stmt->bind_param("s", $id_value);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($billing = $result->fetch_assoc()) {
        $response = $billing;
    }
}

echo json_encode($response);
