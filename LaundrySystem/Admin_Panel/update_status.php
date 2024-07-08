<?php
include 'DBLaundryConnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rowId = $_POST['rowId'];
    $newValue = $_POST['newValue'];

    // Perform SQL update operation
    $query = "UPDATE request_business SET rqbs_status = '$newValue' WHERE rqbs_ID = $rowId";

    if ($conn->query($query) === TRUE) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . $conn->error;
    }
}

$conn->close();