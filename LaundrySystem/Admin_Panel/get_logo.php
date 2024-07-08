<?php
include 'DBLaundryConnect.php'; // Adjust include path as per your file structure

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT mime, data FROM request_bsLogo WHERE rqbs_ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($mime, $data);

    if($stmt->fetch()) {
        header("Content-Type: $mime");
        echo $data;
    } else {
        // Handle case where image with that ID was not found
        // For example, echo a default image or error message
        header("Content-Type: image/jpeg"); // Example default image type
        readfile('path_to_default_image.jpg'); // Example default image file
    }

    $stmt->close();
} else {
    // Handle case where ID parameter is not provided
    header("Content-Type: image/jpeg"); // Example default image type
    readfile('path_to_default_image.jpg'); // Example default image file
}

$conn->close();
