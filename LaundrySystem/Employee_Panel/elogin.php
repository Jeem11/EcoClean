<?php
include 'DBLaundryConnect.php';

session_start();
$login_error = '';

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        // Get user input
        $user_username = $_POST['username'];
        $user_password = $_POST['password'];

        // Prepare and bind
        $stmt = $conn->prepare("SELECT emp_ID, emp_username, emp_userpass, emp_status FROM employee WHERE emp_username = ?");
        $stmt->bind_param("s", $user_username);

        // Execute statement
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($emp_Id, $emp_username, $emp_userpass, $emp_status);
            $stmt->fetch();

            // Verify password
            if ($user_password === $emp_userpass) {
                session_regenerate_id(true);
                $_SESSION['username'] = $user_username;

                if ($emp_status === 'Approved') {
                    echo "<script>alert('Login Successful!'); window.location.href='Edashboard.php';</script>";
                    exit();
                } else {
                    $login_error = "Invalid username or password.";
                }
            } else {
                $login_error = "Invalid username or password.";
            }
        } else {
            // Check if user exists in the request_employee table
            $stmt = $conn->prepare("SELECT rqemp_username, rqemp_userpass FROM request_employee WHERE rqemp_username = ?");
            $stmt->bind_param("s", $user_username);

            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($rqemp_username, $rqemp_userpass);
                $stmt->fetch();

                if ($user_password === $rqemp_userpass) {
                    $login_error = "Your account is still under review.";
                } else {
                    $login_error = "Invalid username or password.";
                }
            } else {
                // Check if user exists in the rejected_account table
                $stmt = $conn->prepare("SELECT rq_username, rq_userpass FROM rejected_account WHERE rq_username = ?");
                $stmt->bind_param("s", $user_username);

                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {
                    $stmt->bind_result($rq_username, $rq_userpass);
                    $stmt->fetch();

                    if ($user_password === $rq_userpass) {
                        $login_error = "Your request for an employee account has been rejected.";
                    } else {
                        $login_error = "Invalid username or password.";
                    }
                } else {
                    $login_error = "Invalid username or password.";
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
        <form action="elogin.php" method="post">
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
                <button type="button" onclick="window.location.href='employee_Form.php'">Sign Up</button>
            </div>
        </form>
        <?php
        if (!empty($login_error)) {
            echo "<p class='error-message'>$login_error</p>";
        }
        ?>
    </div>
</body>
</html>
