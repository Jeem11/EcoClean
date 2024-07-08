<?php
$servername = "localhost";
$username = "root";
$password = "ccis";
$dbname = "dba_laundry";
$port = 3306; // Default MySQL port

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Interface</title>
    <link rel="stylesheet" href="elanding.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="content">
        <h1>Customer Status</h1>
        <table>
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Laundry Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Handle status update if form is submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['status']) && isset($_POST['customer_id'])) {
                    // Prepare SQL statement to update status based on customer ID
                    $status = $_POST['status'];
                    $customer_id = $_POST['customer_id'];

                    $sql = "UPDATE user_info SET laundry_status = '$status' WHERE user_ID = $customer_id";

                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Status updated successfully');</script>";
                    } else {
                        echo "<script>alert('Error updating status: " . $conn->error . "');</script>";
                    }
                }

                // SQL query to fetch data
                $sql_select = "SELECT user_ID, user_name, laundry_status FROM user_info";
                $result = $conn->query($sql_select);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["user_name"]. "</td>
                                <td class='status-cell'>
                                    <form method='post' class='status-form'>
                                        <input type='hidden' name='customer_id' value='" . $row["user_ID"] . "'>
                                        <input type='hidden' class='status-input' name='status' value='" . $row["laundry_status"] . "'>
                                        <div class='dropdown'>
                                            <span class='dropdown-btn'>" . $row["laundry_status"] . "</span>
                                            <div class='dropdown-content'></div>
                                        </div>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No records found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="elanding.js"></script> <!-- Separate JavaScript file -->
</body>
</html>
