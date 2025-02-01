<?php
// Updated viewEventController.php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include_once '../config/db.php';

    // Validate event token
    $eventToken = htmlspecialchars(trim($_GET['token']));

    if (empty($eventToken)) {
        echo json_encode(['success' => false, 'message' => 'Event token is required.']);
        exit;
    }

    // Retrieve event details
    $stmt = $conn->prepare("SELECT name, description, date FROM events WHERE token = ?");
    $stmt->bind_param("s", $eventToken);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $event = $result->fetch_assoc();
        echo json_encode(['success' => true, 'event' => $event]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Event not found.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>