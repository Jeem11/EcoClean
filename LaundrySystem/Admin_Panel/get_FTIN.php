<?php
include 'DBLaundryConnect.php'; 

if (isset($_GET['bs_ID'])) {
    $bs_ID = $_GET['bs_ID'];

    $query = "SELECT mime, data FROM businessTIN_File WHERE bs_ID = $bs_ID";
    $result = $conn->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $mime_type = $row['mime'];
            $file_data = $row['data'];

            header("Content-type: $mime_type");
            echo $file_data;
            exit;
        } else {
            echo "Error: SSS file not found for bs_ID $bs_ID";
        }
    } else {
        echo "Error fetching SSS file: " . $conn->error;
    }
} else {
    echo "Error: bs_ID parameter is missing.";
}
