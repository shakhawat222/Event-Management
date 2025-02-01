<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /event_management/views/login.php");
    exit;
}

$customerId = $_SESSION['user_id'];
$query = "SELECT event_name, event_description, event_date, status, token FROM events WHERE created_by = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $customerId);
$stmt->execute();
$result = $stmt->get_result();
$events = $result->fetch_all(MYSQLI_ASSOC);
?>