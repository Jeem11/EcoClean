<?php
session_start();

// Database credentials
$servername = "localhost"; // Change to your database server
$username = "your_db_username"; // Change to your database username
$password = "your_db_password"; // Change to your database password
$dbname = "your_db_name"; // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM employees WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);

    // Execute the query
    $stmt->execute();

    // Store the result
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Correct credentials, start session
        $_SESSION['username'] = $username;
        echo "Login successful!";
        // Redirect to a different page (e.g., dashboard)
        // header("Location: dashboard.php");
        // exit();
    } else {
        // Incorrect credentials
        $error = "Incorrect username or password.";
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
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
        <?php if ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="" method="post">
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
    </div>
</body>
</html>
