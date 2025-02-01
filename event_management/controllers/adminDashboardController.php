<?php
session_start();
require_once '../config/db.php';

// Fetch all events with the host name (if accepted)
function fetchEvents($conn) {
    $query = "
        SELECT 
            events.id, 
            events.event_name, 
            events.event_date, 
            events.status, 
            users.username AS accepted_by 
        FROM events
        LEFT JOIN users ON events.accepted_by = users.id
    ";

    return $conn->query($query);
}

$events = fetchEvents($conn);
?>
