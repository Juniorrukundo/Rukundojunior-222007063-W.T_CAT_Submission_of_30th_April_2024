<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Delivery Service - Login</title>
    <style>
        /* Your CSS styles here */
        .container {
            margin: 0 auto;
            max-width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login to Your Account</h1>
        <form id="loginForm" action="login.php" method="post">
            <input type="email" id="email" name="email" placeholder="Email Address" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
        <a href="registration.html" class="register-link">Don't have an account? Register here</a>
    </div>

    <script>
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;

            // Simple validation: check if email and password fields are not empty
            if (!email || !password) {
                alert("Please enter both email and password.");
                event.preventDefault(); // Prevent form submission
            }
        });
    </script>
</body>
</html>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate user input
    if (!empty($email) && !empty($password)) {
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "restaurant_management_system";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute SQL query
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($sql);

        // Check if a matching user is found
        if ($result->num_rows > 0) {
            // Redirect to user dashboard
            header("Location: user_dashboard.html");
            exit();
        } else {
            // Invalid credentials, display error message
            echo "<script>alert('Invalid email or password.');</script>";
        }

        // Close database connection
        $conn->close();
    } else {
        // Fields are empty, display error message
        echo "<script>alert('Please enter both email and password.');</script>";
    }
}
?>
