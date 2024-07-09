<?php

include 'DBLaundryConnect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$query = "SELECT a.bs_ID, bs_name, bs_owner, CONCAT(bs_city, ', ', bs_brgy) AS address, bs_regdate, bs_status, bs_contact, bs_email, bsDTI_No, bsTIN_No 
FROM laundry_shops a
LEFT JOIN businessDTI_File ON a.bs_ID = bsDTI_ID 
LEFT JOIN businessTIN_File ON a.bs_ID = bsTIN_ID
WHERE bs_status = 'Approved'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<tbody>";

    while ($row = $result->fetch_assoc()) {
        // Fetch logo data if available
        $logo_query = "SELECT data, mime FROM laundry_Logo WHERE bs_ID = {$row['bs_ID']}";
        $logo_result = $conn->query($logo_query);

        // Check if logo exists
        if ($logo_result->num_rows > 0) {
            $logo_data = $logo_result->fetch_assoc();
            $logo_mime = $logo_data['mime'];
            $logo_image = base64_encode($logo_data['data']);
            $logo_src = "data:{$logo_mime};base64,{$logo_image}";
        } else {
            // Default logo source or placeholder if logo does not exist
            $logo_src = "path/to/default/logo.png";
        }

        // Construct HTML for main row, logo, and status select
        echo "<tr class='main-row' data-row-id='{$row['bs_ID']}'>
                <td>{$row['bs_name']}</td>
                <td>{$row['bs_owner']}</td>
                <td>{$row['address']}</td>
                <td>{$row['bs_regdate']}</td>
                <td>{$row['bs_status']}'</td>
            </tr>";

        // Display hidden rows for contact, email, DTI, and TIN with buttons
        echo "<tr class='hidden-row' style='display: none;'>
                <td><img src='{$logo_src}' alt='Logo' style='width: 50px; height: 50px;'></td>
                <td><strong>Contact:</strong> {$row['bs_contact']}</td>
                <td><strong>Email:</strong> {$row['bs_email']}</td>
                <td><strong>DTI No:</strong> <button onclick=\"window.open('get_FDTI.php?bs_ID={$row['bs_ID']}')\">{$row['bsDTI_No']}</button></td>
                <td><strong>TIN No:</strong> <button onclick=\"window.open('get_FTIN.php?bs_ID={$row['bs_ID']}')\">{$row['bsTIN_No']}</button></td>
            </tr>";

    }

    echo "</tbody>";
} else {
    echo "<tbody><tr><td colspan='5'>There are no Registered Business</td></tr></tbody>";
}

$conn->close();
