<?php
include 'DBLaundryConnect.php';
session_start();
$login_error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Check connection
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        // Get user input
        $user_username = $_POST['username'] ?? '';
        $user_password = $_POST['password'] ?? '';

        // Check if username and password are not empty
        if (empty($user_username) || empty($user_password)) {
            throw new Exception("Username or password cannot be empty.");
        }

        // Prepare and bind
        $stmt = $conn->prepare("SELECT bs_ID, bs_username, bs_userpass FROM laundry_account WHERE bs_username = ?");
        $stmt->bind_param("s", $user_username);

        // Execute statement
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($bs_ID, $db_username, $db_password);

        if ($stmt->num_rows > 0) {
            $stmt->fetch();
            if (password_verify($user_password, $db_password)) {
                // User exists and password is correct, start session
                session_regenerate_id(true); // Prevent session fixation
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
    } catch (Exception $e) {
        // Log or display the error message
        error_log($e->getMessage());
        $login_error = "An error occurred. Please try again later.";
    }
}

if ($login_error) {
    // Display error message (or handle it in the frontend)
    echo "<p>$login_error</p>";
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Login Interface</title>
    <link rel="stylesheet" href="ologin.css">
</head>
<body>
    <header>
        <img src="logo.png" alt="EcoClean Logo" class="logo">
        <h1>Welcome to EcoClean: Your Partner in Perfect Laundry!</h1>
    </header>
    <div class="login-container">
        <h2>Owner Login</h2>
        <form action="ologin.php" method="post">
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
                <button type="button" onclick="window.location.href='business_Form.php'">Sign Up</button>
            </div>
        </form>
        <?php if ($login_error): ?>
            <p style="color: red;"><?php echo $login_error; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
