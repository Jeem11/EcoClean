<?php
include 'DBLaundryConnect.php';

ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'C:\xampp\php\logs\php_error_log'); // Ensure this path is writable
error_reporting(E_ALL);
ob_start();

header('Content-Type: application/json');

$response = [];

try{
    $conn->begin_transaction();

    //shop name
    $shopName = $_POST['business_name'];
    $shop = str_replace(' ', '', $shopName);

    //Owner name
    $lname = $_POST['b_lname'];
    $fname = $_POST['b_fname'];
    $mname = $_POST['b_mname'];
    $OwnerName = ($mname === '') ? $fname . ' ' . $lname : $fname . ' ' . $mname . ' ' . $lname;
    $Owner = str_replace(' ', '', $OwnerName);
    //Additional info
    $B_add = $_POST['business_add'];
    $B_city = $_POST['City'];
    $B_brgy = $_POST['brgy'];
    $B_contact = $_POST['B_contact'];
    $B_email = $_POST['B_Email'];
    $B_username = $_POST['B_username'];
    $B_userpass = $_POST['B_password'];

    //File no. info
    $DTI_no = $_POST['DTI'];
    $TIN_no = $_POST['TIN'];

    //Insert Profile Picture
    if(isset($_FILES['Owner_File']) && $_FILES['Owner_File']['error'] === UPLOAD_ERR_OK){
        $original_name = $_FILES['Owner_File']['name'];
        $mime = $_FILES['Owner_File']['type'];
        $size = $_FILES['Owner_File']['size'];
        $data = file_get_contents($_FILES['Owner_File']['tmp_name']);
        $fileExtension = pathinfo($original_name, PATHINFO_EXTENSION);
        $pic_name = $Owner . "_pic." . $fileExtension;

        $stmtpic = $conn->prepare("INSERT INTO request_bsOwner (rqbs_owner, rqbsowner_filenm, mime, size, data)
        VALUES (?, ?, ?, ?, ?)");
        if(!$stmtpic){
            throw new Exception('Prepare failed for request_bsOwner: ' . $conn->error);
        }
        $stmtpic->bind_param("ssssb", $OwnerName, $pic_name, $mime, $size, $data);
        if(!$stmtpic->execute()){
            throw new Exception('Failed to insert into request_bsOwner: ' . $stmtpic->error);
        }
        $rqbspic_ID = $stmtpic->insert_id;
        $stmtpic->close();
    }else{
        error_log("Owner_File is not set or has an error");
    }

    //Insert Logo Picture
    if(isset($_FILES['B_logo']) && $_FILES['B_logo']['error'] === UPLOAD_ERR_OK){
        $original_name = $_FILES['B_logo']['name'];
        $mime = $_FILES['B_logo']['type'];
        $size = $_FILES['B_logo']['size'];
        $data = file_get_contents($_FILES['B_logo']['tmp_name']);
        $fileExtension = pathinfo($original_name, PATHINFO_EXTENSION);
        $logo_name = $shop . "_logo." . $fileExtension;

        $stmtLogo = $conn->prepare("INSERT INTO request_bsLogo(rqbs_ID, rqbslogo_name, mime, size, data) 
        VALUES(?, ?, ?, ?, ?)");
        if(!$stmtLogo){
            throw new Exception('Prepare failed for request_bsLogo: ' . $conn->error);
        }
        $stmtLogo->bind_param("isssi", $rqbspic_ID, $logo_name, $mime, $size, $data);
        if(!$stmtLogo->execute()){
            throw new Exception('Failed to insert into request_bsLogo: ' . $stmtLogo->error);
        }
        $stmtLogo->close();
    }else{
        error_log("B_logo is not set or has an error.");
    }

    //Insert DTI PDF file
    if(isset($_FILES['DTI_File']) && $_FILES['DTI_File']['error'] === UPLOAD_ERR_OK){
        $original_name = $_FILES['DTI_File']['name'];
        $mime = $_FILES['DTI_File']['type'];
        $size = $_FILES['DTI_File']['size'];
        $data = file_get_contents($_FILES['DTI_File']['tmp_name']);
        $fileExtension = pathinfo($original_name, PATHINFO_EXTENSION);
        $DTI_name = $shop . "_DTI." . $fileExtension;

        $stmtDTI = $conn->prepare("INSERT INTO request_bsDTI(rqbsDTI_ID, rqbsDTI_name, mime, size, data) 
        VALUES (?, ?, ?, ?, ?)");
        if(!$stmtDTI){
            throw new Exception('Prepare failed for request_bsDTI: ' . $conn->error);
        }
        $stmtDTI->bind_param("isssi", $rqbspic_ID, $DTI_name, $mime, $size, $data);
        if(!$stmtDTI->execute()){
            throw new Exception('Failed to insert into request_bsDTI: ' . $stmtDTI->error);
        }
        $stmtDTI->close();
    }else{
        error_log("DTI_File is not set or has an error");
    }

    //Insert TIN PDF file
    if(isset($_FILES['TIN_File']) && $_FILES['TIN_File']['error'] === UPLOAD_ERR_OK){
        $original_name = $_FILES['TIN_File']['name'];
        $mime = $_FILES['TIN_File']['type'];
        $size = $_FILES['TIN_File']['size'];
        $data = file_get_contents($_FILES['TIN_File']['tmp_name']);
        $fileExtension = pathinfo($original_name, PATHINFO_EXTENSION);
        $TIN_name = $shop . "_TIN." . $fileExtension;

        $stmtTIN = $conn->prepare("INSERT INTO request_bsTIN(rqbsTIN_ID, rqbsTIN_name, mime, size, data) 
        VALUES (?, ?, ?, ?, ?)");
        if(!$stmtTIN){
            throw new Exception('Prepare failed for request_bsTIN: ' . $conn->error);
        }
        $stmtTIN->bind_param("isssi", $rqbspic_ID, $TIN_name, $mime, $size, $data);
        if(!$stmtTIN->execute()){
            throw new Exception('Failed to insert into request_bsTIN: ' . $stmtTIN->error);
        }
        $stmtTIN->close();
    }else{
        error_log("TIN_File is not set or has an error");
    }

    //Insert Business Owner Agreement
    if(isset($_FILES['B_Sign']) && $_FILES['B_Sign']['error'] === UPLOAD_ERR_OK){
        $original_name = $_FILES['B_Sign']['name'];
        $mime = $_FILES['B_Sign']['type'];
        $size = $_FILES['B_Sign']['size'];
        $data = file_get_contents($_FILES['B_Sign']['tmp_name']);
        $fileExtension = pathinfo($original_name, PATHINFO_EXTENSION);
        $Sign_name = $Owner . "_Sign." . $fileExtension;

        $stmtAgreement = $conn->prepare("INSERT INTO request_bsAgreement(rqbs_ID, rqbs_owner, rqbsSign_name, mime, size, data) 
        VALUES (?, ?, ?, ?, ?, ?)");
        if(!$stmtAgreement){
            throw new Exception('Prepare failed for request_bsAgreement: ' . $conn->error);
        }
        $stmtAgreement->bind_param("issssi", $rqbspic_ID, $OwnerName, $Sign_name, $mime, $size, $data);
        if(!$stmtAgreement->execute()){
            throw new Exception('Failed to insert into request_bsAgreement: ' . $stmtAgreement->error);
        }
        $stmtAgreement->close();
    }else{
        error_log("B_Sign is not set or has an error");
    }

    //Insert Business Registration Data
    $stmtBs = $conn->prepare("INSERT INTO request_business (rqbs_ID, rqbs_name, rqbs_owner, rqbs_add, rqbs_city, rqbs_brgy, rqbs_contact, rqbs_email, rqbs_username, rqbs_userpass, rqbs_regdate) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    if(!$stmtBs){
        throw new Exception('Prepare failed for request_business: ' . $conn->error);
    }
    $stmtBs->bind_param("isssssssss", $rqbspic_ID, $shopName, $OwnerName, $B_add, $B_city, $B_brgy, $B_contact, $B_email, $B_username, $B_userpass);
    if(!$stmtBs->execute()){
        throw new Exception('Failed to insert into request_business: ' . $stmtBs->error);
    }
    $stmtBs->close();

    //Commit transaction
    $conn->commit();
    $response['status'] = 'success';
    $response['message'] = 'Business registration and file uploads completed successfully.';
}catch(Exception $e){
    //Rollback transaction on error
    $conn->rollback();
    $response['status'] = 'error';
    $response['message'] = $e->getMessage();
    error_log($e->getMessage());
}

//output JSON response
echo json_encode($response);
ob_end_flush();

// Close database connection
$conn->close();