<?php
include 'DBLaundryConnect.php';

ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'C:\xampp\php\logs\php_error_log'); // Ensure this path is writable
error_reporting(E_ALL);
ob_start();

header('Content-Type: application/json');

$response = [];

try {
    $conn->begin_transaction();

    // Retrieve and sanitize employee data
    $lname = $_POST['E_lname'];
    $fname = $_POST['E_fname'];
    $mname = $_POST['E_mname'];
    $EmployeeName = ($mname === '') ? $fname . ' ' . $lname : $fname . ' ' . $mname . ' ' . $lname;
    $bday = $_POST['EBday'];
    $E_contact = $_POST['E_contact'];
    $E_email = $_POST['E_Email'];
    $E_add = $_POST['employee_add'];
    $E_city = $_POST['City'];
    $E_brgy = $_POST['brgy'];
    $shop = 'Laundry Shop';
    $E_username = $_POST['E_username'];
    $E_pass = $_POST['E_password'];
    $SSS_no = $_POST['SSS'];
    $PHealth_no = $_POST['PHealth'];
    $PIbig_no = $_POST['P_Ibig'];

    // Insert Profile Picture
    if (isset($_FILES['Employee_File']) && $_FILES['Employee_File']['error'] === UPLOAD_ERR_OK) {
        $original_name = $_FILES['Employee_File']['name'];
        $mime = $_FILES['Employee_File']['type'];
        $size = $_FILES['Employee_File']['size'];
        $data = file_get_contents($_FILES['Employee_File']['tmp_name']);
        $fileExtension = pathinfo($original_name, PATHINFO_EXTENSION);
        $pic_name = $lname . "_pic." . $fileExtension;

        $stmtPic = $conn->prepare("INSERT INTO request_employeepic (rqemp_name, mime, size, data) VALUES (?, ?, ?, ?)");
        if (!$stmtPic) {
            throw new Exception('Prepare failed for request_employeepic: ' . $conn->error);
        }
        $null = NULL;
        $stmtPic->bind_param("sssb", $pic_name, $mime, $size, $null);
        $stmtPic->send_long_data(3, $data);
        if (!$stmtPic->execute()) {
            throw new Exception('Failed to insert into request_employeepic: ' . $stmtPic->error);
        }
        $rqemppic_ID = $stmtPic->insert_id; // Get the last inserted ID
        $stmtPic->close();
    } else {
        error_log("Employee_File is not set or has an error.");
    }

    // Insert SSS File
    if (isset($_FILES['SSS_File']) && $_FILES['SSS_File']['error'] === UPLOAD_ERR_OK) {
        $original_name = $_FILES['SSS_File']['name'];
        $mime = $_FILES['SSS_File']['type'];
        $size = $_FILES['SSS_File']['size'];
        $data = file_get_contents($_FILES['SSS_File']['tmp_name']);

        $stmtSSS = $conn->prepare("INSERT INTO request_empsss (rqempSSS_ID, rqempSSS_name, rqempSSS_no, mime, size, data) VALUES (?, ?, ?, ?, ?, ?)");
        if (!$stmtSSS) {
            throw new Exception('Prepare failed for request_empsss: ' . $conn->error);
        }
        $stmtSSS->bind_param("issssi", $rqemppic_ID, $EmployeeName, $SSS_no, $mime, $size, $data);
        if (!$stmtSSS->execute()) {
            throw new Exception('Failed to insert into request_empsss: ' . $stmtSSS->error);
        }
        $stmtSSS->close();
    } else {
        error_log("SSS_File is not set or has an error.");
    }

    // Insert PhilHealth File
    if ($PHealth_no !== '') {
        if (isset($_FILES['PHealth_File']) && $_FILES['PHealth_File']['error'] === UPLOAD_ERR_OK) {
            $original_name = $_FILES['PHealth_File']['name'];
            $mime = $_FILES['PHealth_File']['type'];
            $size = $_FILES['PHealth_File']['size'];
            $data = file_get_contents($_FILES['PHealth_File']['tmp_name']);

            $stmtPhil = $conn->prepare("INSERT INTO request_empphil (rqempPhil_ID, rqempPhil_name, rqempPhil_no, mime, size, data) VALUES (?, ?, ?, ?, ?, ?)");
            if (!$stmtPhil) {
                throw new Exception('Prepare failed for request_empphil: ' . $conn->error);
            }
            $stmtPhil->bind_param("issssi", $rqemppic_ID, $EmployeeName, $PHealth_no, $mime, $size, $data);
            if (!$stmtPhil->execute()) {
                throw new Exception('Failed to insert into request_empphil: ' . $stmtPhil->error);
            }
            $stmtPhil->close();
        } else {
            error_log("PHealth_File is not set or has an error.");
        }
    }

    // Insert Pag-IBIG File
    if ($PIbig_no !== '') {
        if (isset($_FILES['PIbig_File']) && $_FILES['PIbig_File']['error'] === UPLOAD_ERR_OK) {
            $original_name = $_FILES['PIbig_File']['name'];
            $mime = $_FILES['PIbig_File']['type'];
            $size = $_FILES['PIbig_File']['size'];
            $data = file_get_contents($_FILES['PIbig_File']['tmp_name']);

            $stmtPB = $conn->prepare("INSERT INTO request_emppb (rqempPB_ID, rqempPB_name, rqempPB_no, mime, size, data) VALUES (?, ?, ?, ?, ?, ?)");
            if (!$stmtPB) {
                throw new Exception('Prepare failed for request_emppb: ' . $conn->error);
            }
            $stmtPB->bind_param("isssi", $rqemppic_ID, $EmployeeName, $PIbig_no, $mime, $size, $data);
            if (!$stmtPB->execute()) {
                throw new Exception('Failed to insert into request_emppb: ' . $stmtPB->error);
            }
            $stmtPB->close();
        } else {
            error_log("PIbig_File is not set or has an error.");
        }
    }

    // Insert Employee Agreement File
    if (isset($_FILES['E_Sign']) && $_FILES['E_Sign']['error'] === UPLOAD_ERR_OK) {
        $original_name = $_FILES['E_Sign']['name'];
        $mime = $_FILES['E_Sign']['type'];
        $size = $_FILES['E_Sign']['size'];
        $data = file_get_contents($_FILES['E_Sign']['tmp_name']);

        $stmtAgreement = $conn->prepare("INSERT INTO request_empagreement (rqemp_ID, rqemp_name, rqempSign_name, mime, size, data) VALUES (?, ?, ?, ?, ?, ?)");
        if (!$stmtAgreement) {
            throw new Exception('Prepare failed for request_empagreement: ' . $conn->error);
        }
        $stmtAgreement->bind_param("issssi", $rqemppic_ID, $EmployeeName, $lname, $mime, $size, $data);
        if (!$stmtAgreement->execute()) {
            throw new Exception('Failed to insert into request_empagreement: ' . $stmtAgreement->error);
        }
        $stmtAgreement->close();
    } else {
        error_log("E_Sign is not set or has an error.");
    }

    // Insert Employee Registration Data
    $stmtEmp = $conn->prepare("INSERT INTO request_employee (rqemp_ID, rqemp_name, rqemp_username, rqemp_userpass, rqemp_contact, rqemp_email, rqemp_bday, rqemp_add, rqemp_city, rqemp_brgy, rq_shop, rq_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    if (!$stmtEmp) {
        throw new Exception('Prepare failed for request_employee: ' . $conn->error);
    }
    $stmtEmp->bind_param("issssssssss", $rqemppic_ID, $EmployeeName, $E_username, $E_pass, $E_contact, $E_email, $bday, $E_add, $E_city, $E_brgy, $shop);
    if (!$stmtEmp->execute()) {
        throw new Exception('Failed to insert into request_employee: ' . $stmtEmp->error);
    }
    $stmtEmp->close();

    // Commit transaction
    $conn->commit();
    $response['status'] = 'success';
    $response['message'] = 'Employee registration and file uploads completed successfully.';
} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    $response['status'] = 'error';
    $response['message'] = $e->getMessage();
    error_log($e->getMessage());
}

// Output JSON response
echo json_encode($response);
ob_end_flush();

// Close database connection
$conn->close();