<?php
require_once '../controllers/customerDashboardController.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="/event_management/assets/css/style.css">
</head>
<body>
    <div class="dashboard">
        <h2>Customer Dashboard</h2>
        <a href="../views/login.php" class="logout-button">Logout</a>
        <h3>Event Creation</h3>
        <form method="POST" action="../controllers/CustomerController.php">
            <input type="text" name="event_name" placeholder="Event Name" required>
            <textarea name="event_description" placeholder="Event Description" required></textarea>
            <input type="datetime-local" name="event_date" required>
            <button type="submit">Request Event</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Event Description</th>
                    <th>Event Date</th>
                    <th>Status</th>
                    <th>Token</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($events)): ?>
                    <?php foreach ($events as $event): ?>
                        <tr>
                            <td><?= html_entity_decode($event['event_name']) ?></td>
                            <td><?= html_entity_decode($event['event_description']) ?></td>
                            <td><?= htmlspecialchars($event['event_date']) ?></td>
                            <td><?= htmlspecialchars($event['status'] ?? 'pending') ?></td>
                            <td><?= htmlspecialchars($event['token']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No events found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>