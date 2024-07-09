<?php
include 'DBLaundryConnect.php'; 

if (isset($_GET['rqemp_ID'])) {
    $rqemp_ID = $_GET['rqemp_ID'];

    $query = "SELECT mime, data FROM request_emppb WHERE rqempPB_ID = $rqemp_ID";
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
            echo "Error: PB file not found for rqemp_ID $rqemp_ID";
        }
    } else {
        echo "Error fetching PB file: " . $conn->error;
    }
} else {
    echo "Error: rqemp_ID parameter is missing.";
}
