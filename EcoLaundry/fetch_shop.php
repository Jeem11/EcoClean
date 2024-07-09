<?php
include 'DBLaundryConnect.php'; // Assuming this includes your database connection script

$brgy = isset($_GET['brgy']) ? $_GET['brgy'] : null;
$job = isset($_GET['job']) ? $_GET['job'] : null;

// Check if connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind parameters
$stmt = $conn->prepare("SELECT bs_name FROM laundry_shops WHERE bs_city = ? AND bs_brgy = ?");
$stmt->bind_param("ss", $job, $brgy,);
$stmt->execute();
$result = $stmt->get_result();

$shops = [];
while ($row = $result->fetch_assoc()) {
    $shops[] = $row['bs_name'];
}

header('Content-Type: application/json');
echo json_encode($shops);
