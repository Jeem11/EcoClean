<?php
include 'DBLaundryConnect.php';
session_start();

$response = ['status' => 'error', 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all necessary POST data are set
    if (isset($_POST['bs_ID'], $_POST['bs_name'], $_POST['plan'])) {
        $bs_ID = $_POST['bs_ID'];
        $bs_name = $_POST['bs_name'];
        $plan = $_POST['plan'];

        // Debugging: Log received POST data
        error_log("Received POST data: bs_ID=$bs_ID, bs_name=$bs_name, plan=$plan");

        try {
            // Check connection
            if ($conn->connect_error) {
                throw new Exception("Connection failed: " . $conn->connect_error);
            }

            // Begin transaction
            $conn->begin_transaction();

            // Insert Proof of Payment image into proof_payment table
            if (isset($_FILES['Payment_File']) && $_FILES['Payment_File']['error'] === UPLOAD_ERR_OK) {
                $original_name = $_FILES['Payment_File']['name'];
                $mime = $_FILES['Payment_File']['type'];
                $size = $_FILES['Payment_File']['size'];
                $data = file_get_contents($_FILES['Payment_File']['tmp_name']);
                $fileExtension = pathinfo($original_name, PATHINFO_EXTENSION);
                $pic_name = "{$bs_name}_pic.{$fileExtension}";

                $stmt = $conn->prepare("INSERT INTO proof_payment (bs_name, paypic_name, mime, size, data) VALUES (?, ?, ?, ?, ?)");
                if (!$stmt) {
                    throw new Exception('Prepare failed for proof_payment: ' . $conn->error);
                }
                $stmt->bind_param("sssib", $bs_name, $pic_name, $mime, $size, $data);
                $stmt->send_long_data(4, $data);
                if (!$stmt->execute()) {
                    throw new Exception('Failed to insert into proof_payment: ' . $stmt->error);
                }
                $paypic_ID = $stmt->insert_id; // Get the inserted ID
                $stmt->close();
            } else {
                throw new Exception('Proof of payment file upload error.');
            }

            // Insert into pending_payment table
            $stmt = $conn->prepare("INSERT INTO pending_payment (bs_ID, sub_ID, total_pay, last_pay, due_pay) 
                SELECT ?, a.sub_ID, a.sub_price, IFNULL(b.pay_date, NULL), NOW()
                FROM subscription a
                LEFT JOIN payment b 
                ON a.sub_ID = b.sub_ID AND b.bs_ID = ?
                WHERE a.sub_cdname = ? AND a.sub_cdname = ?
                LIMIT 1 ");
            if (!$stmt) {
                throw new Exception('Prepare failed for pending_payment: ' . $conn->error);
            }
            $stmt->bind_param("isis", $bs_ID, $bs_ID, $plan, $plan);
            if (!$stmt->execute()) {
                throw new Exception('Failed to insert into pending_payment: ' . $stmt->error);
            }
            $sub_ID = $stmt->insert_id; // Optional: Get the inserted ID
            $stmt->close();

            // Commit transaction
            $conn->commit();

            // Return success response
            $response['status'] = 'success';
            $response['message'] = 'Payment and proof of payment uploaded successfully.';
            $response['PayID'] = $paypic_ID; // Optional: Return the last inserted ID
        } catch (Exception $e) {
            // Rollback transaction on error
            $conn->rollback();
            error_log($e->getMessage());
            $response['message'] = $e->getMessage();
        }
    } else {
        $response['message'] = 'Missing POST data.';
    }
} else {
    $response['message'] = 'Invalid request method.';
}

// Close database connection
$conn->close();

// Send JSON response


if ($response['status'] === 'success') {
    echo '<script>';
    echo 'alert("Payment and proof of payment uploaded successfully.");';
    echo 'window.location.href = "ologin.php";';
    echo '</script>';
    exit; // Ensure script stops executing further
}