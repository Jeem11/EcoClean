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

        // Prepare and bind for laundry_account
        $stmt = $conn->prepare("SELECT a.bs_ID, a.bs_username, a.bs_userpass, b.bs_name, b.bs_status 
                                FROM laundry_account a 
                                JOIN laundry_shops b ON a.bs_ID = b.bs_ID 
                                WHERE a.bs_username = ?");
        $stmt->bind_param("s", $user_username);

        // Execute statement
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($bs_ID, $db_username, $db_password, $bs_name, $db_status);

        if ($stmt->num_rows > 0) {
            $stmt->fetch();
            // Validate password using password_verify() if passwords are hashed
            if ($user_password === $db_password) { // Direct string comparison (consider using password_verify() if passwords are hashed)
                // User exists and password is correct, start session
                session_regenerate_id(true); // Prevent session fixation
                $_SESSION['username'] = $user_username;
                $_SESSION['bs_ID'] = $bs_ID;
                $_SESSION['bs_name'] = $bs_name;

                if ($db_status === 'Unpaid') {
                    // Redirect to Subscription.php
                    header("Location: Subscription.php");
                    exit();
                } else {
                    header("Location: ologin.php"); // Redirect to employee interface (change to your actual employee interface page)
                    exit();
                }
            } else {
                // Incorrect password
                $login_error = "Invalid username or password.";
            }
        } else {
            // Check request_business table
            $stmt = $conn->prepare("SELECT rqbs_username, rqbs_userpass 
                                    FROM request_business 
                                    WHERE rqbs_username = ?");
            $stmt->bind_param("s", $user_username);

            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($rqbs_username, $rqbs_userpass);

            if ($stmt->num_rows > 0) {
                $stmt->fetch();
                if ($user_password === $rqbs_userpass) {
                    // Request is still under review
                    $login_error = "Your request is still under review.";
                } else {
                    // Incorrect password
                    $login_error = "Invalid username or password.";
                }
            } else {
                // Check rejected_account table
                $stmt = $conn->prepare("SELECT rq_username, rq_userpass 
                                        FROM rejected_account 
                                        WHERE rq_username = ?");
                $stmt->bind_param("s", $user_username);

                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($rq_username, $rq_userpass);

                if ($stmt->num_rows > 0) {
                    $stmt->fetch();
                    if ($user_password === $rq_userpass) {
                        // Request has been rejected
                        $login_error = "Your request for business has been rejected.";
                    } else {
                        // Incorrect password
                        $login_error = "Invalid username or password.";
                    }
                } else {
                    // User does not exist in any table
                    $login_error = "Business Doesn't Exist.";
                }
            }
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
    echo "<script>console.log('" . addslashes($login_error) . "');</script>";
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
