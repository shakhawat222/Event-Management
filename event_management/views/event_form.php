<!-- views/event_form.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Event</title>
    <link rel="stylesheet" href="/event_management/assets/css/style.css">
</head>
<body>
    <div class="event-form">
        <h2>Create Event</h2>
        <form id="eventForm">
            <input type="text" id="eventName" placeholder="Event Name" required>
            <textarea id="eventDescription" placeholder="Event Description" required></textarea>
            <input type="datetime-local" id="eventDate" required>
            <button type="submit">Create Event</button>
        </form>
        <p id="eventMessage"></p>
    </div>
    <script src="/event_management/assets/js/event_form.js"></script>
</body>
</html>