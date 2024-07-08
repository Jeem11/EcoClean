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
        $query = "UPDATE request_employee SET rqemp_status = ? WHERE rqemp_ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $newValue, $rowId);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            throw new Exception("Failed to update status");
        }

        if ($newValue === 'Approved') {
            $newStat = 'Approved';

            $update = $conn->prepare("INSERT INTO employee (emp_ID, emp_name, emp_bday, emp_contact, emp_email, emp_add, emp_city, emp_brgy, work_shop, rg_date, emp_username, emp_userpass, emp_status)
            SELECT rqemp_ID, rqemp_name, rqemp_bday, rqemp_contact, rqemp_email, rqemp_add, rqemp_city, rqemp_brgy, rq_shop, rq_date, rqemp_username, rqemp_userpass, ? 
            FROM request_employee
            WHERE rqemp_ID = ?");
            $update->bind_param('si', $newStat, $rowId);
            $update->execute();

            $profile = $conn->prepare("INSERT INTO employee_profile(emppic_ID, emp_name, mime, size, data)
            SELECT rqemppic_ID, rqemp_name, mime, size, data
            FROM request_employeepic
            WHERE rqemppic_ID = ?");
            $profile->bind_param('i', $rowId);
            $profile->execute();

            $sss = $conn->prepare("INSERT INTO employee_SSS (empSSS_ID, empSSS_name, empSSS_No, mime, size, data)
            SELECT rqempSSS_ID, rqempSSS_name, rqempSSS_no, mime, size, data 
            FROM request_empSSS 
            WHERE rqempSSS_ID = ?");
            $sss->bind_param('i', $rowId);
            $sss->execute();

            $phil = $conn->prepare("INSERT INTO employee_Phil (empPhil_ID, empPhil_name, empPhil_No, mime, size, data)
            SELECT rqempPhil_ID, rqempPhil_name, rqempPhil_No, mime, size, data 
            FROM request_empPhil 
            WHERE rqempPhil_ID = ?");
            $phil->bind_param('i', $rowId);
            $phil->execute();

            $pb = $conn->prepare("INSERT INTO employee_PB (empPB_ID, empPB_name, empPB_No, mime, size, data) 
            SELECT rqempPB_ID, rqempPB_name, rqempPB_no, mime, size, data 
            FROM request_empPB 
            WHERE rqempPB_ID = ?");
            $pb->bind_param('i', $rowId);
            $pb->execute();

            // Delete records from request tables
            $delEmployee = $conn->prepare("DELETE FROM request_employee WHERE rqemp_ID = ?");
            $delEmployee->bind_param('i', $rowId);
            $delEmployee->execute();

            $delProfile = $conn->prepare("DELETE FROM request_employeepic WHERE rqemppic_ID = ?");
            $delProfile->bind_param('i', $rowId);
            $delProfile->execute();

            $delSSS = $conn->prepare("DELETE FROM request_empSSS WHERE rqempSSS_ID = ?");
            $delSSS->bind_param('i', $rowId);
            $delSSS->execute();

            $delPhil = $conn->prepare("DELETE FROM request_empPhil WHERE rqempPhil_ID = ?");
            $delPhil->bind_param('i', $rowId);
            $delPhil->execute();

            $delPB = $conn->prepare("DELETE FROM request_empPB WHERE rqempPB_ID = ?");
            $delPB->bind_param('i', $rowId);
            $delPB->execute();

        } elseif ($newValue === 'Rejected') {
            $rejected = $conn->prepare("INSERT INTO rejected_account (rq_username, rq_userpass)
            SELECT rqemp_username, rqemp_userpass
            FROM request_employee
            WHERE rqemp_ID = ?");
            $rejected->bind_param('i', $rowId);
            $rejected->execute();

            // Delete records from request tables
            $delEmployee = $conn->prepare("DELETE FROM request_employee WHERE rqemp_ID = ?");
            $delEmployee->bind_param('i', $rowId);
            $delEmployee->execute();

            $delProfile = $conn->prepare("DELETE FROM request_employeepic WHERE rqemppic_ID = ?");
            $delProfile->bind_param('i', $rowId);
            $delProfile->execute();

            $delSSS = $conn->prepare("DELETE FROM request_empSSS WHERE rqempSSS_ID = ?");
            $delSSS->bind_param('i', $rowId);
            $delSSS->execute();

            $delPhil = $conn->prepare("DELETE FROM request_empPhil WHERE rqempPhil_ID = ?");
            $delPhil->bind_param('i', $rowId);
            $delPhil->execute();

            $delPB = $conn->prepare("DELETE FROM request_empPB WHERE rqempPB_ID = ?");
            $delPB->bind_param('i', $rowId);
            $delPB->execute();
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
