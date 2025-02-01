<?php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $eventToken = $data['eventToken'];
    $customerId = $_SESSION['user_id'];

    // Get event ID from token
    $stmt = $conn->prepare("SELECT id FROM events WHERE token = ?");
    $stmt->execute([$eventToken]);
    $event = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($event) {
        $eventId = $event['id'];
        $stmt = $conn->prepare("INSERT INTO event_requests (event_id, customer_id) VALUES (?, ?)");
        if ($stmt->execute([$eventId, $customerId])) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Request failed']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Event not found']);
    }
}
?>