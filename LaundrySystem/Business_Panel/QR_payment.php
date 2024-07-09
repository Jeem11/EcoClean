<?php
// DBLaundryConnect.php
include 'DBLaundryConnect.php';

if (isset($_GET['plan'])) {
    $plan = $_GET['plan'];
    
    // Prepare the SQL statement to fetch the QR code
    $stmt = $conn->prepare("SELECT mime, data FROM subscription WHERE sub_cdname = ?");
    $stmt->bind_param("s", $plan);
    
    if ($stmt->execute()) {
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($mime, $data);
            $stmt->fetch();
            
            // Output the image
            header("Content-Type: $mime");
            echo $data;
        } else {
            http_response_code(404); // Not Found
            echo json_encode(['status' => 'error', 'message' => 'QR code not found']);
        }
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(['status' => 'error', 'message' => 'Database query failed']);
    }
    
    $stmt->close();
} else {
    http_response_code(400); // Bad Request
    echo json_encode(['status' => 'error', 'message' => 'Plan not specified']);
}

$conn->close();
