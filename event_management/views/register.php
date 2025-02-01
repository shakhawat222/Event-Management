<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/event_management/assets/css/style.css">
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form id="registerForm">
            <input type="text" id="username" placeholder="Type Username" required>
            <input type="password" id="password" placeholder="Type Password" required>
            <input type="password" id="confirmPassword" placeholder="Confirm Password" required>
            <h5>User Type:</h5>
            <select id="userType" required>
                <option value="host">Host</option>
                <option value="customer">Customer</option>
            </select>
            <button type="submit">Register</button>
        </form>
        <p id="registerMessage"></p>
        <p>Already have an account? <a href="login.php">Click me</a></p>
    </div>
    <script src="/event_management/assets/js/register.js"></script>
</body>
</html>
