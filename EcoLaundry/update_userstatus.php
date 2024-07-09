<?php
include 'DBLaundryConnect.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rowId = $_POST['rowId'];
    $newValue = $_POST['newValue'];

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Perform SQL update operation
        $query = "UPDATE request_user SET rquser_status = ? WHERE rquser_ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $newValue, $rowId);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            throw new Exception("Failed to update status");
        }

        if ($newValue === 'Approved') {
            // Insert into user_info
            $user = $conn->prepare("INSERT INTO user_info(user_ID, user_name, user_contact, user_email, user_add, user_city, user_brgy, rg_date, user_username, user_userpass)
            SELECT rquser_ID, rquser_name, rquser_contact, rquser_email, rquser_add, rquser_city, rquser_brgy, NOW(), rq_username, rq_userpass 
            FROM request_user 
            WHERE rquser_ID = ?");
            $user->bind_param('i', $rowId);
            $user->execute();

            // Check if user insertion was successful
            if ($user->affected_rows === 0) {
                throw new Exception("Failed to insert into user_info");
            }

            // Insert into user_profile
            $profile = $conn->prepare("INSERT INTO user_profile(userpic_ID, user_name, mime, size, data)
            SELECT rquserpic_ID, rquser_name, mime, size, data 
            FROM request_userpic 
            WHERE rquserpic_ID = ?");
            $profile->bind_param('i', $rowId);
            $profile->execute();

            // Check if profile insertion was successful
            if ($profile->affected_rows === 0) {
                throw new Exception("Failed to insert into user_profile");
            }

            // Delete records from request tables after transferring
            $delUser = $conn->prepare("DELETE FROM request_user WHERE rquser_ID = ?");
            $delUser->bind_param('i', $rowId);
            $delUser->execute();

            $delProfile = $conn->prepare("DELETE FROM request_userpic WHERE rquserpic_ID = ?");
            $delProfile->bind_param('i', $rowId);
            $delProfile->execute();
        } elseif ($newValue === 'Rejected') {
            $rejected = $conn->prepare("INSERT INTO rejected_account (rq_username, rq_userpass)
            SELECT rq_username, rq_userpass
            FROM request_user
            WHERE rquser_ID = ?");
            $rejected->bind_param('i', $rowId);
            $rejected->execute();

            // Delete records from request tables
            $delUser = $conn->prepare("DELETE FROM request_user WHERE rquser_ID = ?");
            $delUser->bind_param('i', $rowId);
            $delUser->execute();

            $delProfile = $conn->prepare("DELETE FROM request_userpic WHERE rquserpic_ID = ?");
            $delProfile->bind_param('i', $rowId);
            $delProfile->execute();
        }

        // Commit transaction
        $conn->commit();
        $response['success'] = true;
        $response['message'] = 'Status updated and records transferred successfully';
    } catch (Exception $e) {
        // Rollback transaction
        $conn->rollback();
        $response['success'] = false;
        $response['message'] = 'Error updating status and transferring records: ' . $e->getMessage();
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Invalid request method';
}

// Close database connection
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
