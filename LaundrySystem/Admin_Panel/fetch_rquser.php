<?php

include 'DBLaundryConnect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$query = "SELECT rquser_ID, rquser_name, CONCAT(rquser_brgy, ', ', rquser_city) AS address, rquser_status, 
rquser_contact, rquser_email 
FROM request_user";
$result = $conn->query($query);

if ($result->num_rows > 0){
    echo "<tbody>";

    while ($row = $result->fetch_assoc()) {
        // Fetch profile data if available
        $profile_query = "SELECT data, mime FROM request_userpic WHERE rquserpic_ID = {$row['rquser_ID']}";
        $profile_result = $conn->query($profile_query);

        // Check if profile exists
        if ($profile_result->num_rows > 0) {
            $profile_data = $profile_result->fetch_assoc();
            $profile_mime = $profile_data['mime'];
            $profile_image = base64_encode($profile_data['data']);
            $profile_src = "data:{$profile_mime};base64,{$profile_image}";
        } else {
            // Default profile source or placeholder if profile does not exist
            $profile_src = "path/to/default/profile.png";
        }

        // Construct HTML for main row, profile, and status select
        echo "<tr class='main-row' data-row-id='{$row['rquser_ID']}'>
                <td>{$row['rquser_name']}</td>
                <td>{$row['address']}</td>
                <td class='status-cell'>
                    <select class='status-useselect' data-original-value='{$row['rquser_status']}'>
                        <option value='Pending' " . ($row['rquser_status'] === 'Pending' ? 'selected' : '') . ">Pending</option>
                        <option value='Approved' " . ($row['rquser_status'] === 'Approved' ? 'selected' : '') . ">Approved</option>
                        <option value='Rejected' " . ($row['rquser_status'] === 'Rejected' ? 'selected' : '') . ">Rejected</option>
                    </select>
                </td>
            </tr>";

        // Display hidden rows for contact, email, DTI, and TIN with buttons
        echo "<tr class='hidden-row' style='display: none;'>
                <td><img src='{$profile_src}' alt='profile' style='width: 50px; height: 50px;'></td>
                <td><strong>Contact:</strong> {$row['rquser_contact']}</td>
                <td><strong>Email:</strong> {$row['rquser_email']}</td>
            </tr>";

    }
    echo "</tbody>";
















}



