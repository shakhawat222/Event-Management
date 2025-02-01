// assets/js/event_form.js
document.getElementById('eventForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const eventName = document.getElementById('eventName').value;
    const eventDescription = document.getElementById('eventDescription').value;
    const eventDate = document.getElementById('eventDate').value;

    fetch('/event_management/controllers/eventController.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ eventName, eventDescription, eventDate })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('eventMessage').innerText = 'Event created successfully!';
        } else {
            document.getElementById('eventMessage').innerText = data.message;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('eventMessage').innerText = 'An error occurred. Please try again.';
    });
});