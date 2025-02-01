// assets/js/request_event.js
document.getElementById('requestEventForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const eventToken = document.getElementById('eventToken').value;

    fetch('/event_management/controllers/requestEventController.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ eventToken })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('requestMessage').innerText = 'Event request submitted!';
        } else {
            document.getElementById('requestMessage').innerText = data.message;
        }
    });
});