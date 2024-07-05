<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

include 'DBLaundryConnect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $lname = $_POST['C_lname'];
    $fname = $_POST['C_fname'];
    $mname = $_POST['C_mname'];
    $ClientName;
    $C_email = $_POST['C_Email'];
    
    if ($mname === ''){
        $ClientName = $fname . ' ' . $lname;
    }else{
        $ClientName = $fname . ' ' . $mname . ' ' . $lname;
    }
    
    $check = "SELECT rquser_name, rquser_email FROM request_user WHERE rquser_name = ? OR rquser_email = ?
            UNION
            SELECT user_name, user_email FROM user_info WHERE user_name = ? OR user_email = ?";
    
    $checkstmt  = $conn->prepare($check);
    $checkstmt->bind_param("ssss", $ClientName, $C_email, $ClientName, $C_email);
    $checkstmt->execute();
    $result = $checkstmt->get_result();
    
    if($result->num_rows > 0){
        echo 'exists';
    }else{
        echo 'not_exists';
    }
}