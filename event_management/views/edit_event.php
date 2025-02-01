<?php
require_once '../controllers/editEventShowInfo.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Event</title>
    <link rel="stylesheet" href="/event_management/assets/css/style.css">
</head>
<body>
    <div class="event-form">
        <h2>Edit Event</h2>
        <form action="../controllers/editEventController.php" method="POST">
            <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
            <input type="text" name="event_name" value="<?= htmlspecialchars($event['event_name']) ?>" required>
            <textarea name="event_description" required><?= htmlspecialchars($event['event_description']) ?></textarea>
            <input type="datetime-local" name="event_date" value="<?= date('Y-m-d\TH:i', strtotime($event['event_date'])) ?>" required>
            <button type="submit">Update Event</button>
            <a href="../views/admin_dashboard.php" class="logout-button">Go Back</a>
        </form>
    </div>
</body>
</html>
