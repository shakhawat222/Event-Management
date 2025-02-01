<?php
session_start();
require_once '../config/db.php';

if (!isset($_GET['id'])) {
    echo "Invalid request.";
    exit;
}

$eventId = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
$stmt->bind_param("i", $eventId);
$stmt->execute();
$event = $stmt->get_result()->fetch_assoc();
?>