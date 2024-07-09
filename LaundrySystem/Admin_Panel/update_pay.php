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
        $query = "UPDATE laundry_shops SET bs_status = ? WHERE bs_ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $newValue, $rowId);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            throw new Exception("Failed to update status");
        }

        if($newValue === 'Approved') {
            // Insert into payment table
            $paid = $conn->prepare("
                INSERT INTO payment (bs_ID, sub_ID, total_pay, pay_date, paypic_ID)
                SELECT a.bs_ID, a.sub_ID, a.total_pay, NOW(), b.paypic_ID 
                FROM pending_payment a 
                JOIN laundry_shops c ON a.bs_ID = c.bs_ID 
                JOIN proof_payment b ON c.bs_name = b.bs_name 
                WHERE a.bs_ID = ?");
            $paid->bind_param('i', $rowId);
            $paid->execute();

            if ($paid->affected_rows === 0) {
                throw new Exception("Failed to insert into payment table");
            }

            // Delete from pending_payment table
            $delPay = $conn->prepare("DELETE FROM pending_payment WHERE bs_ID = ?");
            $delPay->bind_param('i', $rowId);
            $delPay->execute();

            if ($delPay->affected_rows === 0) {
                throw new Exception("Failed to delete from pending_payment table");
            }
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
