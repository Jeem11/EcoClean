<?php
include 'DBLaundryConnect.php'; 

// Assuming rqbs_ID is passed as a query parameter
if (isset($_GET['rqbs_id'])) {
    $rqbs_id = $_GET['rqbs_id']; // Correct the variable name to match $_GET['rqbs_id']

    // Query to fetch DTI file data from request_bsDTI table
    $query = "SELECT mime, data FROM request_bsTIN WHERE rqbsTIN_ID = $rqbs_id";
    $result = $conn->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $mime_type = $row['mime'];
            $file_data = $row['data'];

            // Send the appropriate headers and output the file
            header("Content-type: $mime_type");
            echo $file_data;
            exit;
        } else {
            echo "Error: DTI file not found for rqbs_id $rqbs_id";
        }
    } else {
        echo "Error fetching DTI file: " . $conn->error;
    }
} else {
    echo "Error: rqbs_id parameter is missing.";
}
