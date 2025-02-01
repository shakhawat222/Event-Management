document.getElementById('registerForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const userType = document.getElementById('userType').value;

    if (password !== confirmPassword) {
        document.getElementById('registerMessage').innerText = 'Passwords do not match.';
        return;
    }

    fetch('/event_management/controllers/registerController.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ username, password, confirmPassword, userType })
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                window.location.href = '/event_management/views/login.php';
            } else {
                document.getElementById('registerMessage').innerText = data.message;
            }
        })
        .catch(error => {
            console.error('Error occurred:', error);
            document.getElementById('registerMessage').innerText = 'An error occurred. Please try again.';
        });
});
