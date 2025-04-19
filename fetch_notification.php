<?php
session_start();
header('Content-Type: application/json');
include("api/conn.php");

$user_id = $_SESSION['user_id'];
$limit   = isset($_GET['all']) ? 1000 : 10;

// 1) Get the unread count
$countSql  = "SELECT COUNT(*) AS unread_count
              FROM notifications
              WHERE user_id = ? AND status = 'unread'";
$countStmt = $conn->prepare($countSql);
$countStmt->bind_param("i", $user_id);
$countStmt->execute();
$countRow     = $countStmt->get_result()->fetch_assoc();
$unread_count = (int)$countRow['unread_count'];

// 2) Fetch the notifications themselves
$sql  = "SELECT 
            id,
            addcart_id,
            message,
            status,        -- so you know which are read/unread
            created_at
         FROM notifications
         WHERE user_id = ?
         ORDER BY created_at DESC
         LIMIT ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $limit);
$stmt->execute();
$result = $stmt->get_result();

$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

// 3) Return both in one JSON response
echo json_encode([
    'unread_count'  => $unread_count,
    'notifications' => $notifications
]);
