<!-- views/view_event.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Event</title>
    <link rel="stylesheet" href="/event_management/assets/css/style.css">
</head>
<body>
    <div class="event-form">
        <h2>View Event</h2>
        <form id="viewEventForm">
            <input type="text" id="eventToken" placeholder="Enter Event Token" required>
            <button type="submit">View Event</button>
        </form>
        <div id="eventDetails"></div>
    </div>
    <script src="/event_management/assets/js/view_event.js"></script>
</body>
</html>