<?php
session_start();
$login_error = '';

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
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
    $stmt = $conn->prepare("SELECT user_ID, user_username, user_userpass FROM user_info WHERE user_username = ?");
    $stmt->bind_param("s", $user_username);

    // Execute statement
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_ID, $db_username, $db_password);
    
    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($user_password, $db_password)) {
            // User exists and password is correct, start session
            $_SESSION['username'] = $user_username;
            header("Location: elanding.php"); // Redirect to employee interface
            exit();
        } else {
            // Incorrect password
            $login_error = "Invalid username or password.";
        }
    } else {
        // User does not exist
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
    <title>Client Login Interface</title>
    <link rel="stylesheet" href="clogin.css">
</head>
<body>
    <header>
        <img src="logo.png" alt="EcoClean Logo" class="logo">
        <h1>Welcome to EcoClean: Your Partner in Perfect Laundry!</h1>
    </header>
    <div class="login-container">
        <h2>Client Login</h2>
        <form action="login.php" method="post">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
            </div>
            <div class="button-group">
                <button type="submit">Login</button>
                <button type="button" onclick="window.location.href='client_Form.php'">Sign Up</button>
            </div>
        </form>
        <?php if ($login_error): ?>
            <p style="color: red;"><?php echo $login_error; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
