<?php
// Updated loginController.php with role-based redirection
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once '../config/db.php';

    // Sanitize and validate input
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    if (empty($username) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Username and password are required.']);
        exit;
    }

    // Check user in database
    $stmt = $conn->prepare("SELECT id, password, user_type FROM users WHERE username = ?");
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Query preparation failed: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param("s", $username);
    if (!$stmt->execute()) {
        echo json_encode(['success' => false, 'message' => 'Query execution failed: ' . $stmt->error]);
        exit;
    }

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) { // Compare plain text passwords
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_type'] = $user['user_type'];

            // Redirect based on user type
            $redirectMap = [
                'admin' => '/event_management/views/admin_dashboard.php',
                'host' => '/event_management/views/host_dashboard.php',
                'customer' => '/event_management/views/customer_dashboard.php'
            ];

            $redirect = $redirectMap[$user['user_type']] ?? '/event_management/views/dashboard.php';
            echo json_encode(['success' => true, 'redirect' => $redirect]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid credentials.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>