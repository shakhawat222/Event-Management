<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session only if none is active
}

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/EventModel.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../views/login.php");
    exit;
}

$eventModel = new EventModel($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_event_id'])) {
        $success = $eventModel->deleteEvent($_POST['delete_event_id']);
        $_SESSION['message'] = $success ? "Event deleted successfully." : "Failed to delete event.";
        header("Location: ../views/admin_dashboard.php");
        exit;
    }

    if (isset($_POST['edit_event_id'], $_POST['event_name'], $_POST['event_date'], $_POST['event_description'])) {
        $success = $eventModel->updateEvent($_POST['edit_event_id'], $_POST['event_name'], $_POST['event_date'], $_POST['event_description']);
        $_SESSION['message'] = $success ? "Event updated successfully." : "Failed to update event.";
        header("Location: ../views/admin_dashboard.php");
        exit;
    }
}

$events = $eventModel->getAllEvents();
?>
