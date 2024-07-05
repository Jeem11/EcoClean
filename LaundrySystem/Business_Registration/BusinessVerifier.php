<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

include 'DBLaundryConnect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $shopName = $_POST['business_name'];
    
    $check = "SELECT rqbs_name FROM request_business WHERE rqbs_name = ?
            UNION
            SELECT bs_name FROM laundry_shops WHERE bs_name = ?";
    
    $checkstmt  = $conn->prepare($check);
    $checkstmt->bind_param("ss", $shopName, $shopName);
    $checkstmt->execute();
    $result = $checkstmt->get_result();
    
    if($result->num_rows > 0){
        echo 'exists';
    }else{
        echo 'not_exists';
    }
}