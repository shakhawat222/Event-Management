<?php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $eventName = $data['eventName'];
    $eventDescription = $data['eventDescription'];
    $eventDate = $data['eventDate'];
    $createdBy = $_SESSION['user_id'];
    $token = uniqid('event_', true); // Generate a unique token

    $stmt = $conn->prepare("INSERT INTO events (event_name, event_description, event_date, created_by, token) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$eventName, $eventDescription, $eventDate, $createdBy, $token])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Event creation failed']);
    }
}
?>