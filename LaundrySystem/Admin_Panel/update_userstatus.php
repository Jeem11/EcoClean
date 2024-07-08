<?php
include 'DBLaundryConnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rowId = $_POST['rowId'];
    $newValue = $_POST['newValue'];

    // Perform SQL update operation
    $query = "UPDATE request_user SET rquser_status = '$newValue' WHERE rquser_ID = $rowId";

    if ($conn->query($query) === TRUE) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . $conn->error;
    }
}

$conn->close();