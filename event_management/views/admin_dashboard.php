<?php
require_once '../controllers/adminDashboardController.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/event_management/assets/css/style.css">
</head>
<body>
    <div class="dashboard">
        <h2>Admin Dashboard</h2>
        <a href="../views/login.php" class="logout-button">Logout</a>
        <h3>All Events</h3>
        <table>
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Event Date</th>
                    <th>Status</th>
                    <th>Accepted By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($event = $events->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($event['event_name']) ?></td>
                        <td><?= htmlspecialchars($event['event_date']) ?></td>
                        <td><?= htmlspecialchars($event['status'] ?? 'pending') ?></td>
                        <td><?= htmlspecialchars($event['accepted_by'] ?? 'N/A') ?></td>
                        <td>
                            <a href="edit_event.php?id=<?= $event['id'] ?>">Edit</a>
                            <form method="POST" action="../controllers/AdminController.php" style="display:inline;">
                                <input type="hidden" name="delete_event_id" value="<?= $event['id'] ?>">
                                <button type="submit" style="color:white; background-color:green; padding:5px; border:none; cursor:pointer;">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
