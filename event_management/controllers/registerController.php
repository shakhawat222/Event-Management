<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once '../config/db.php';

    // Decode JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    // Debugging log
    if (!$input) {
        echo json_encode(['success' => false, 'message' => 'Invalid JSON input.']);
        exit;
    }

    $username = htmlspecialchars(trim($input['username']));
    $password = htmlspecialchars(trim($input['password']));
    $confirmPassword = htmlspecialchars(trim($input['confirmPassword']));
    $userType = htmlspecialchars(trim($input['userType']));

    // Validation
    if (empty($username) || empty($password) || empty($confirmPassword) || empty($userType)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    if ($password !== $confirmPassword) {
        echo json_encode(['success' => false, 'message' => 'Passwords do not match.']);
        exit;
    }

    // Insert into the database
    $stmt = $conn->prepare("INSERT INTO users (username, password, user_type) VALUES (?, ?, ?)");
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Database error: Unable to prepare statement.']);
        exit;
    }

    $stmt->bind_param("sss", $username, $password, $userType);
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Registration successful.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error: Unable to register user.']);
    }

    $stmt->close();
    $conn->close();
    exit;
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}
?>
