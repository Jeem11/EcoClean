<?php

include 'DBLaundryConnect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$query = "SELECT rqbs_ID, rqbs_name, rqbs_owner, CONCAT(rqbs_city, ', ', rqbs_brgy) AS address, rqbs_regdate, rqbs_status, rqbs_contact, rqbs_email, rqbsDTI_No, rqbsTIN_No 
FROM request_business 
LEFT JOIN request_bsdti ON rqbs_ID = rqbsDTI_ID 
LEFT JOIN request_bstin ON rqbs_ID = rqbsTIN_ID";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<tbody>";

    while ($row = $result->fetch_assoc()) {
        // Fetch logo data if available
        $logo_query = "SELECT data, mime FROM request_bsLogo WHERE rqbs_ID = {$row['rqbs_ID']}";
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
        echo "<tr class='main-row' data-row-id='{$row['rqbs_ID']}'>
                <td>{$row['rqbs_name']}</td>
                <td>{$row['rqbs_owner']}</td>
                <td>{$row['address']}</td>
                <td>{$row['rqbs_regdate']}</td>
                <td class='status-cell'>
                    <select class='status-select' data-original-value='{$row['rqbs_status']}'>
                        <option value='Pending' " . ($row['rqbs_status'] === 'Pending' ? 'selected' : '') . ">Pending</option>
                        <option value='Approved' " . ($row['rqbs_status'] === 'Approved' ? 'selected' : '') . ">Approved</option>
                        <option value='Rejected' " . ($row['rqbs_status'] === 'Rejected' ? 'selected' : '') . ">Rejected</option>
                    </select>
                </td>
            </tr>";

        // Display hidden rows for contact, email, DTI, and TIN with buttons
        echo "<tr class='hidden-row' style='display: none;'>
                <td><img src='{$logo_src}' alt='Logo' style='width: 50px; height: 50px;'></td>
                <td><strong>Contact:</strong> {$row['rqbs_contact']}</td>
                <td><strong>Email:</strong> {$row['rqbs_email']}</td>
                <td><strong>DTI No:</strong> <button onclick=\"window.open('get_DTI.php?rqbs_id={$row['rqbs_ID']}')\">{$row['rqbsDTI_No']}</button></td>
                <td><strong>TIN No:</strong> <button onclick=\"window.open('get_TIN.php?rqbs_id={$row['rqbs_ID']}')\">{$row['rqbsTIN_No']}</button></td>
            </tr>";

    }

    echo "</tbody>";
} else {
    echo "<tbody><tr><td colspan='5'>There are no Business Requests</td></tr></tbody>";
}

$conn->close();
