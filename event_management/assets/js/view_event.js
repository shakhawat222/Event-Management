// assets/js/view_event.js
document.getElementById('viewEventForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const eventToken = document.getElementById('eventToken').value;

    fetch(`/event_management/controllers/viewEventController.php?token=${eventToken}`)
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const eventDetails = document.getElementById('eventDetails');
            eventDetails.innerHTML = `
                <h3>${data.event.event_name}</h3>
                <p>${data.event.event_description}</p>
                <p>Date: ${new Date(data.event.event_date).toLocaleString()}</p>
            `;
        } else {
            document.getElementById('eventDetails').innerText = data.message;
        }
    });
});