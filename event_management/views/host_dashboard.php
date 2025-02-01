<?php
require_once '../controllers/HostController.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Host Dashboard</title>
    <link rel="stylesheet" href="/event_management/assets/css/style.css">
</head>
<body>
    <div class="dashboard">
        <h2>Host Dashboard</h2>
        <a href="../views/login.php" class="logout-button">Logout</a>

        <?php if (isset($_SESSION['message'])): ?>
            <p class="success-message"><?= htmlspecialchars($_SESSION['message']) ?></p>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Event Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($events)): ?>
                    <?php foreach ($events as $event): ?>
                        <tr>
                            <td><?= htmlspecialchars($event['event_name']) ?></td>
                            <td><?= htmlspecialchars($event['event_date']) ?></td>
                            <td>
                                <form method="POST" action="../controllers/HostController.php">
                                    <input type="hidden" name="accept_event_id" value="<?= $event['id'] ?>">
                                    <button type="submit">Accept</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No pending events.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
