<?php
include 'DBLaundryConnect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$query = "SELECT a.bs_ID, a.bs_name, a.bs_owner, CONCAT(a.bs_brgy, ', ', a.bs_city) AS address, a.bs_regdate, 
b.sub_cdname, a.bs_status, 
a.bs_contact, a.bs_email, c.total_pay,
d.bsDTI_No, e.bsTIN_No
FROM laundry_shops a 
JOIN pending_payment c ON a.bs_ID = c.bs_ID
JOIN subscription b ON c.sub_ID = b.sub_ID
JOIN businessDTI_File d ON a.bs_ID = d.bs_ID
JOIN businessTIN_File e ON a.bs_ID = e.bs_ID
WHERE a.bs_status = 'Unpaid'";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<tbody>";

    while ($row = $result->fetch_assoc()) {
        // Escape bs_name for SQL query
        $bs_name = $conn->real_escape_string($row['bs_name']);
        
        // Query to fetch payment data
        $payment_query = "SELECT data, mime FROM proof_payment WHERE bs_name = '{$bs_name}'";
        $payment_result = $conn->query($payment_query);

        // Check if payment exists
        if ($payment_result && $payment_result->num_rows > 0) {
            $payment_data = $payment_result->fetch_assoc();
            $payment_mime = $payment_data['mime'];
            $payment_image = base64_encode($payment_data['data']);
            $payment_src = "data:{$payment_mime};base64,{$payment_image}";
        } else {
            // Default payment source or placeholder if payment does not exist
            $payment_src = "path/to/default/payment.png";
        }

        echo "<tr class='main-row' data-row-id='{$row['bs_ID']}'>
                <td>{$row['bs_name']}</td>
                <td>{$row['bs_owner']}</td>
                <td>{$row['address']}</td>
                <td>{$row['bs_regdate']}</td>
                <td>{$row['sub_cdname']}</td>
                <td class='status-cell'>
                    <select class='status-payselect' data-original-value='{$row['bs_status']}'>
                        <option value='Pending' " . ($row['bs_status'] === 'Pending' ? 'selected' : '') . ">Pending</option>
                        <option value='Approved' " . ($row['bs_status'] === 'Approved' ? 'selected' : '') . ">Approved</option>
                        <option value='Rejected' " . ($row['bs_status'] === 'Rejected' ? 'selected' : '') . ">Rejected</option>
                    </select>
                </td>
            </tr>";

            echo "<tr class='hidden-row' style='display: none;'>
            <td><strong>DTI No:</strong> <button onclick=\"window.open('get_FDTI.php?bs_ID={$row['bs_ID']}')\">{$row['bsDTI_No']}</button></td>
            <td><strong>TIN No:</strong> <button onclick=\"window.open('get_FTIN.php?bs_ID={$row['bs_ID']}')\">{$row['bsTIN_No']}</button></td>
            <td><strong>Total Payment:</strong> {$row['total_pay']}</td>
            <td><img src='{$payment_src}' alt='Logo' style='width: 100%; height: 100%;'></td>
            <td><td>
        </tr>";
    }

    echo "</tbody>";
} else {
    echo "<p>No unpaid laundry shops found.</p>";
}

$conn->close();
