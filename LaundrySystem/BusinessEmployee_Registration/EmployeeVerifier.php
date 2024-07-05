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
    
    $check = "SELECT rqemp_name, rqemp_email FROM request_employee WHERE rqemp_name = ? OR rqemp_email = ?
        UNION
        SELECT emp_name, emp_email FROM employee WHERE emp_name = ? OR emp_email = ?";
    
    $checkstmt  = $conn->prepare($check);
    $checkstmt->bind_param("ssss", $EmployeeName, $E_email, $EmployeeName, $E_email);
    $checkstmt->execute();
    $result = $checkstmt->get_result();
    
    if($result->num_rows > 0){
        echo 'exists';
    }else{
        echo 'not_exists';
    }
}