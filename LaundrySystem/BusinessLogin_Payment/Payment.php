<?php
// Start or resume session
session_start();

// Check if bs_ID, bs_name, and plan are set in session
if (isset($_SESSION['bs_ID'], $_SESSION['bs_name'], $_GET['plan'])) {
    // Retrieve bs_ID, bs_name, and plan from session
    $bs_ID = $_SESSION['bs_ID'];
    $bs_name = $_SESSION['bs_name'];
    $plan = $_GET['plan'];

    // Log bs_ID, bs_name, and plan to console (optional for debugging)
    echo "<script>";
    echo "console.log('Business ID: " . $bs_ID . "');";
    echo "console.log('Business Name: " . $bs_name . "');";
    echo "console.log('Plan: " . $plan . "');";
    echo "</script>";
} else {
    // Redirect or handle case where session variables are not set
    echo "<script>";
    echo "console.log('Session variables not set.');";
    echo "window.location = 'ologin.php';"; // Redirect to login page if session variables are not set
    echo "</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Style_Payment.css" type="text/css"/>
    <title>Payment</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <form id="payment_page" method="post" enctype="multipart/form-data" action="payment_process.php">
        <div class="container">
            <div class="pay">
                <img src="GCash-Logo.png" alt="GCash Logo" class="logo">
                <div class="qr">
                    <?php
                    if (isset($plan)) {
                        echo '<img src="QR_payment.php?plan=' . htmlspecialchars($plan) . '" alt="QR Code">';
                    } else {
                        echo '<p>No plan selected.</p>';
                    }
                    ?>
                </div>
                <div class="instruction">
                    <p>Please scan the QR code to complete your payment via GCash and upload a screenshot of the payment confirmation as proof.</p>
                </div>
                <div class="pay_info">
                    <label for="F_Pay">Proof of Payment: </label>
                    <input type="file" name="Payment_File" id="F_Pay" accept="image/*" required>
                </div>
            </div>
            <div class="btn-group">
                <button type="button" class="pay-btn back-btn" onclick="window.location.href = 'ologin.php';">Back</button>
                <button type="submit" class="pay-btn sub-btn">Submit</button>
            </div>
        </div>
        <!-- Hidden inputs to store session variables -->
        <input type="hidden" name="bs_ID" value="<?php echo htmlspecialchars($bs_ID); ?>">
        <input type="hidden" name="bs_name" value="<?php echo htmlspecialchars($bs_name); ?>">
        <input type="hidden" name="plan" value="<?php echo htmlspecialchars($plan); ?>">
    </form>
    <script src="Script_Payment.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>
