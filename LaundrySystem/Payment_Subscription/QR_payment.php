<?php
require "vendor/autoload.php";

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

if (isset($_GET['plan'])) {
    $plan = $_GET['plan'];

    // Determine price based on the selected plan
    switch ($plan) {
        case 'basic':
            $price = '1';
            break;
        case 'standard':
            $price = '2';
            break;
        case 'premium':
            $price = '3';
            break;
        case 'vip':
            $price = '4';
            break;
        default:
            $price = '0';
            break;
    }

    // Construct QR code data
    $data = "https://example.com/payment?plan=$plan&price=$price";

    // Create QR code instance
    $qrCode = QrCode::create($data)
        ->setSize(300)
        ->setMargin(10);

    // Create writer
    $writer = new PngWriter();

    // Generate QR code image and save it as a file in the images directory
    $filePath = 'images/qrcode.png';
    $qrCodeImage = $writer->write($qrCode);
    $qrCodeImage->saveToFile($filePath);

    // Check if file is created successfully
    if (file_exists($filePath)) {
        // Redirect to Payment.php with the plan parameter
        header("Location: Payment.php?plan=$plan");
        exit;
    } else {
        echo 'Error generating QR code.';
        exit;
    }
} else {
    echo 'Invalid request. Please select a subscription plan.';
    exit;
}
