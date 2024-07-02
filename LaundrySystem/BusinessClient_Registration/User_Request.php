<?php
include 'DBLaundryConnect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ensure proper JSON response
header('Content-Type: application/json');

$response = [];

try {
    // Profile Pic
    if (!isset($_FILES['Client_File'])) {
        throw new Exception('No file uploaded.');
    }

    $original_name = $_FILES['Client_File']['name'];
    $mime = $_FILES['Client_File']['type'];
    $size = $_FILES['Client_File']['size'];
    $data = file_get_contents($_FILES['Client_File']['tmp_name']);

    if ($data === false) {
        throw new Exception('Failed to read uploaded file.');
    }

    $fileExtension = pathinfo($original_name, PATHINFO_EXTENSION);

    // User/Client Name
    $lname = $_POST['C_lname'];
    $fname = $_POST['C_fname'];
    $mname = $_POST['C_mname'];
    $ClientName = ($mname === '') ? $fname . ' ' . $lname : $fname . ' ' . $mname . ' ' . $lname;

    // User Contact
    $C_contact = $_POST['C_contact'];
    $C_email = $_POST['C_Email'];

    // User Address
    $C_add = $_POST['client_add'];
    $C_city = $_POST['City'];
    $C_brgy = $_POST['brgy'];

    // Account Info
    $C_username = $_POST['C_username'];
    $C_pass = $_POST['C_password'];

    // New File name
    $fileName = $lname . "_pic." . $fileExtension;

    // Upload user pic first to get rquserpic_ID
    $stmtpic = $conn->prepare("INSERT INTO request_userpic (rquser_name, mime, size, data) VALUES (?, ?, ?, ?)");
    if (!$stmtpic) {
        throw new Exception('Prepare failed for request_userpic: ' . $conn->error);
    }

    $null = NULL;
    $stmtpic->bind_param("sssb", $fileName, $mime, $size, $null);
    $stmtpic->send_long_data(3, $data);

    if (!$stmtpic->execute()) {
        throw new Exception('Failed to insert into request_userpic: ' . $stmtpic->error);
    }

    $rquserpic_ID = $stmtpic->insert_id;
    $stmtpic->close();

    // Insert data into request_user
    $stmt = $conn->prepare("INSERT INTO request_user "
            . "(rquser_ID, rquser_name, rquser_contact, rquser_email, rquser_add, rquser_city, rquser_brgy, rq_username, rq_userpass, rq_date) "
            . "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    if (!$stmt) {
        throw new Exception('Prepare failed for request_user: ' . $conn->error);
    }

    $stmt->bind_param("issssssss", $rquserpic_ID, $ClientName, $C_contact, $C_email, $C_add, $C_city, $C_brgy, $C_username, $C_pass);

    if ($stmt->execute()) {
        sendResponse('success', 'Request Successfully Submitted!', $rquserpic_ID);
    } else {
        throw new Exception('Execution failed: ' . $stmt->error);
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    sendResponse('failed', 'Error Occurred: ' . $e->getMessage());
}

function sendResponse($status, $message, $UserID = null) {
    $response = [
        'status' => $status,
        'message' => $message
    ];
    if ($UserID !== null) {
        $response['UserID'] = $UserID;
    }
    echo json_encode($response);
    exit;
}