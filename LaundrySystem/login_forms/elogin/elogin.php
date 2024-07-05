<?php
session_start();
$login_error = '';

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost:3307";
    $username = "root";
    $password = "ccis";
    $dbname = "dba_laundry";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user input
    $user_username = $_POST['username'];
    $user_password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT rqemp_ID, rqemp_username, rqemp_userpass FROM request_employee WHERE rqemp_username = ? AND rqemp_userpass = ?");
    $stmt->bind_param("ss", $user_username, $user_password);

    // Execute statement
    $stmt->execute();

    // Store result
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // User exists, start session
        $_SESSION['username'] = $user_username;
        header("Location: employee_interface.php");
        exit();
    } else {
        // User does not exist or wrong credentials
        $login_error = "Invalid username or password.";
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Login Interface</title>
    <link rel="stylesheet" href="elogin.css">
</head>
<body>
    <header>
        <img src="logo.png" alt="EcoClean Logo" class="logo">
        <h1>Welcome to EcoClean: Your Partner in Perfect Laundry!</h1>
    </header>
    <div class="login-container">
        <h2>Employee Login</h2>
        <form action="login.php" method="post">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <?php
        if (!empty($login_error)) {
            echo "<p class='error-message'>$login_error</p>";
        }
        ?>
    </div>
</body>
</html>
