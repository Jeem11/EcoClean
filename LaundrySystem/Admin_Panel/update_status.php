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
        $query = "UPDATE request_business SET rqbs_status = ? WHERE rqbs_ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $newValue, $rowId);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            throw new Exception("Failed to update status");
        }

        if ($newValue === 'Approved') {
            $newStat = 'Unpaid';

            $update = $conn->prepare("INSERT INTO laundry_shops (bs_ID, bs_name, bs_owner, bs_add, bs_city, bs_brgy, bs_contact, bs_email, bs_regdate, bs_status)
            SELECT rqbs_ID, rqbs_name, rqbs_owner, rqbs_add, rqbs_city, rqbs_brgy, rqbs_contact, rqbs_email, rqbs_regdate, ? 
            FROM request_business
            WHERE rqbs_ID = ?");
            $update->bind_param('si', $newStat, $rowId);
            $update->execute();

            $account = $conn->prepare("INSERT INTO laundry_account (bs_ID, bs_username, bs_userpass)
            SELECT rqbs_ID, rqbs_username, rqbs_userpass
            FROM request_business
            WHERE rqbs_ID = ?");
            $account->bind_param('i', $rowId);
            $account->execute();

            $owner = $conn->prepare("INSERT INTO business_owner (bs_ID, bs_owner, bsowner_filenm, mime, size, data)
            SELECT rqbs_ID, rqbs_owner, rqbsowner_filenm, mime, size, data
            FROM request_bsOwner
            WHERE rqbs_ID = ?");
            $owner->bind_param('i', $rowId);
            $owner->execute();

            $logo = $conn->prepare("INSERT INTO laundry_Logo (bs_ID, bslogo_name, mime, size, data)
            SELECT rqbs_ID, rqbslogo_name, mime, size, data
            FROM request_bsLogo
            WHERE rqbs_ID = ?");
            $logo->bind_param('i', $rowId);
            $logo->execute();

            $DTI = $conn->prepare("INSERT INTO businessDTI_File (bs_ID, bsDTI_ID, bsDTI_name, bsDTI_No, mime, size, data)
            SELECT rqbsDTI_ID, rqbsDTI_ID, rqbsDTI_name, rqbsDTI_No, mime, size, data
            FROM request_bsDTI
            WHERE rqbsDTI_ID = ?");
            $DTI->bind_param('i', $rowId);
            $DTI->execute();

            $TIN = $conn->prepare("INSERT INTO businessTIN_File (bs_ID, bsTIN_ID, bsTIN_name, bsTIN_No, mime, size, data)
            SELECT rqbsTIN_ID, rqbsTIN_ID, rqbsTIN_name, rqbsTIN_No, mime, size, data
            FROM request_bsTIN
            WHERE rqbsTIN_ID = ?");
            $TIN->bind_param('i', $rowId);
            $TIN->execute();

            $sign = $conn->prepare("INSERT INTO business_Agreements (bs_ID, bs_owner, bsSign_name, mime, size, data)
            SELECT rqbs_ID, rqbs_owner, rqbsSign_name, mime, size, data
            FROM request_bsAgreement
            WHERE rqbs_ID = ?");
            $sign->bind_param('i', $rowId);
            $sign->execute();

            // Delete records from request tables
            $conn->query("DELETE FROM request_business WHERE rqbs_ID = $rowId");
            $conn->query("DELETE FROM request_bsOwner WHERE rqbs_ID = $rowId");
            $conn->query("DELETE FROM request_bsLogo WHERE rqbs_ID = $rowId");
            $conn->query("DELETE FROM request_bsDTI WHERE rqbsDTI_ID = $rowId");
            $conn->query("DELETE FROM request_bsTIN WHERE rqbsTIN_ID = $rowId");
            $conn->query("DELETE FROM request_bsAgreement WHERE rqbs_ID = $rowId");

        } elseif ($newValue === 'Rejected') {
            $rejected = $conn->prepare("INSERT INTO rejected_account (rq_username, rq_userpass)
            SELECT rqbs_username, rqbs_userpass
            FROM request_business
            WHERE rqbs_ID = ?");
            $rejected->bind_param('i', $rowId);
            $rejected->execute();

            // Delete records from request tables
            $conn->query("DELETE FROM request_business WHERE rqbs_ID = $rowId");
            $conn->query("DELETE FROM request_bsOwner WHERE rqbs_ID = $rowId");
            $conn->query("DELETE FROM request_bsLogo WHERE rqbs_ID = $rowId");
            $conn->query("DELETE FROM request_bsDTI WHERE rqbsDTI_ID = $rowId");
            $conn->query("DELETE FROM request_bsTIN WHERE rqbsTIN_ID = $rowId");
            $conn->query("DELETE FROM request_bsAgreement WHERE rqbs_ID = $rowId");
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
