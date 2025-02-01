<?php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventId = intval($_POST['event_id']);
    $eventName = htmlspecialchars(trim($_POST['event_name']));
    $eventDate = htmlspecialchars(trim($_POST['event_date']));
    $eventDescription = htmlspecialchars(trim($_POST['event_description']));

    $stmt = $conn->prepare("UPDATE events SET event_name = ?, event_date = ?, event_description = ? WHERE id = ?");
    $stmt->bind_param("sssi", $eventName, $eventDate, $eventDescription, $eventId);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Event updated successfully.";
    } else {
        $_SESSION['error'] = "Failed to update event.";
    }
    header("Location: ../views/admin_dashboard.php");
    exit;
}
?>
