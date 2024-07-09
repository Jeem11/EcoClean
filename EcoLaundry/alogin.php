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

    // Prepare and bind
    $stmt = $conn->prepare("SELECT admin_ID, admin_username, admin_password FROM admin WHERE admin_username = ? AND admin_password = ?");
    $stmt->bind_param("ss", $user_username, $user_password);

    // Execute statement
    $stmt->execute();

    // Store result
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // User exists, start session
        $_SESSION['username'] = $user_username;
        echo "<script>
                alert('Login Successful!');
                window.location.href = 'Admin_Dashboard.php';
              </script>";
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
    <title>Admin Login Interface</title>
    <link rel="stylesheet" href="alogin.css">
</head>
<body>
    <header>
        <img src="logo.png" alt="EcoClean Logo" class="logo">
        <h1>Welcome to EcoClean: Your Partner in Perfect Laundry!</h1>
    </header>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form action="alogin.php" method="post">
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
            </div>
        </form>
        <?php if ($login_error): ?>
            <p style="color: red;"><?php echo $login_error; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
