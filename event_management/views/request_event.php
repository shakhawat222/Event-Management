<!-- views/request_event.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Request Event</title>
    <link rel="stylesheet" href="/event_management/assets/css/style.css">
</head>
<body>
    <div class="event-form">
        <h2>Request Event</h2>
        <form id="requestEventForm">
            <input type="text" id="eventToken" placeholder="Enter Event Token" required>
            <button type="submit">Request Event</button>
        </form>
        <p id="requestMessage"></p>
    </div>
    <script src="/event_management/assets/js/request_event.js"></script>
</body>
</html>