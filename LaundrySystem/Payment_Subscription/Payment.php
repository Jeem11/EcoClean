<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Style_Payment.css" type="text/css"/>
    <title>Payment</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <form id="payment_page" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="pay">
                <img src="GCash-Logo.png" alt="GCash Logo" class="logo">
                <!-- Display the QR code -->
                <div>
                    <img src="qrcode.png" alt="QR Code">
                </div>
                <div class="instruction">
                    <p>Please scan the QR code to complete your payment via GCash and upload a screenshot of the payment confirmation as proof.</p>
                </div>
                <div class="pay_info">
                    <label for="F_Pay">Proof of Payment: </label>
                    <input type="file" name="Payment_File" id="F_Pay" accept="image/*">
                </div>
            </div>
            <div class="btn-group">
                <button type="button" class="pay-btn back-btn">Back</button>
                <button type="submit" class="pay-btn sub-btn">Submit</button>
            </div>
        </div>
    </form>
</body>
</html>
