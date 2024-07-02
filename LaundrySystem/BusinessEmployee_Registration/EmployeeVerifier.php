<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

include 'DBLaundryConnect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $lname = $_POST['E_lname'];
    $fname = $_POST['E_fname'];
    $mname = $_POST['E_mname'];
    $EmployeeName;
    $E_email = $_POST['E_Email'];
    
    if ($mname === ''){
        $EmployeeName = $fname . ' ' . $lname;
    }else{
        $EmployeeName = $fname . ' ' . $mname . ' ' . $lname;
    }
    
    $check = "SELECT rquser_name, rquser_email FROM request_user WHERE rquser_name = ? OR rquser_email = ?";
    
    $checkstmt  = $conn->prepare($check);
    $checkstmt->bind_param("ss", $EmployeeName, $E_email);
    $checkstmt->execute();
    $result = $checkstmt->get_result();
    
    if($result->num_rows > 0){
        echo 'exists';
    }else{
        echo 'not_exists';
    }
}