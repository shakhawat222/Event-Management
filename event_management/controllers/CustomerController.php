<?php
session_start();
require_once '../config/db.php';
require_once '../models/EventModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventName = htmlspecialchars(trim($_POST['event_name']));
    $eventDescription = htmlspecialchars(trim($_POST['event_description']));
    $eventDate = htmlspecialchars(trim($_POST['event_date']));
    $customerId = $_SESSION['user_id'];
    $token = rand(100000, 999999); // Generate a random token for the event

    $eventModel = new EventModel($conn);
    $success = $eventModel->createEvent($eventName, $eventDescription, $eventDate, $customerId, $token);

    if ($success) {
        $_SESSION['message'] = "Event created successfully.";
        header("Location: ../views/customer_dashboard.php");
        exit;
    } else {
        $_SESSION['error'] = "Failed to create event.";
        header("Location: ../views/customer_dashboard.php");
        exit;
    }
} else {
    header("Location: ../views/customer_dashboard.php");
    exit;
}
?>
