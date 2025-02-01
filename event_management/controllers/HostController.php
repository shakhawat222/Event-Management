<?php
session_start();
require_once '../config/db.php';
require_once '../models/EventModel.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit;
}

$eventModel = new EventModel($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accept_event_id'])) {
    $eventId = intval($_POST['accept_event_id']);
    $hostId = $_SESSION['user_id'];

    $success = $eventModel->acceptEvent($eventId, $hostId);
    $_SESSION['message'] = $success ? "Event accepted successfully!" : "Failed to accept event.";
    header("Location: ../views/host_dashboard.php");
    exit;
}

$events = $eventModel->getPendingEvents();
if (!$events) {
    $events = [];
}
?>
