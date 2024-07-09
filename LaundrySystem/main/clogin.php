<?php
include 'DBLaundryConnect.php';
session_start();
$login_error = '';

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user input
    $user_username = $_POST['username'];
    $user_password = $_POST['password'];

    // Prepare and bind for user_info table
    $stmt = $conn->prepare("SELECT user_ID, user_username, user_userpass FROM user_info WHERE user_username = ?");
    $stmt->bind_param("s", $user_username);

    // Execute statement
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_ID, $db_username, $db_password);
        $stmt->fetch();

        // Verify password
        if ($user_password === $db_password) {
            // User exists and password is correct, start session
            $_SESSION['username'] = $user_username;
            header("Location: elanding.php"); // Redirect to employee interface
            exit();
        } else {
            // Incorrect password
            $login_error = "Invalid username or password.";
        }
    } else {
        // Check if user exists in request_user table
        $stmt = $conn->prepare("SELECT rquser_username, rquser_userpass FROM request_user WHERE rquser_username = ?");
        $stmt->bind_param("s", $user_username);

        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($rquser_username, $rquser_userpass);
            $stmt->fetch();

            // User exists in request_user, account under review
            $login_error = "Your account is still under review.";
        } else {
            // Check if user exists in rejected_account table
            $stmt = $conn->prepare("SELECT rq_username, rq_userpass FROM rejected_account WHERE rq_username = ?");
            $stmt->bind_param("s", $user_username);

            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($rq_username, $rq_userpass);
                $stmt->fetch();

                // User exists in rejected_account, account rejected
                $login_error = "Your request for an account has been rejected.";
            } else {
                // User doesn't exist in any table
                $login_error = "User doesn't exist.";
            }
        }
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
