<?php

include 'DBLaundryConnect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$query = "SELECT rqemp_ID, rqemp_name, rq_shop, CONCAT(rqemp_brgy, ', ', rqemp_city) AS address, rqemp_status, rqemp_contact, rqemp_email, rq_date, 
rqempSSS_no, rqempPhil_no, rqempPB_no 
FROM request_employee 
LEFT JOIN request_empsss ON rqemp_ID = rqempSSS_ID 
LEFT JOIN request_empphil ON rqemp_ID = rqempPhil_ID 
LEFT JOIN request_emppb ON rqemp_ID = rqempPB_ID";

$result = $conn->query($query);

if ($result->num_rows > 0){
    echo "<tbody>";

    while($row = $result->fetch_assoc()){
        $profile_query = "SELECT data, mime FROM request_employeepic WHERE rqemppic_ID = {$row['rqemp_ID']}";
        $profile_result = $conn->query($profile_query);

        // Check if profile picture exists
        if ($profile_result->num_rows > 0) {
            $profile_data = $profile_result->fetch_assoc();
            $profile_mime = $profile_data['mime'];
            $profile_image = base64_encode($profile_data['data']);
            $profile_src = "data:{$profile_mime};base64,{$profile_image}";
        } else {
            // Default profile picture source or placeholder if not available
            $profile_src = "path/to/default/profile.png";
        }

        echo "<tr class='main-row' data-row-id='{$row['rqemp_ID']}'>
                <td>{$row['rqemp_name']}</td>
                <td>{$row['rq_shop']}</td>
                <td>{$row['address']}</td>
                <td class='status-cell'>
                    <select class='status-empselect' data-original-value='{$row['rqemp_status']}'>
                        <option value='Pending' " . ($row['rqemp_status'] === 'Pending' ? 'selected' : '') . ">Pending</option>
                        <option value='Approved' " . ($row['rqemp_status'] === 'Approved' ? 'selected' : '') . ">Approved</option>
                        <option value='Rejected' " . ($row['rqemp_status'] === 'Rejected' ? 'selected' : '') . ">Rejected</option>
                    </select>
                </td>
            </tr>";

        // Hidden rows containing additional details and buttons
        echo "<tr class='hidden-row' style='display: none;'>
                <td colspan='5'>
                    <img src='{$profile_src}' alt='Profile' style='width: 50px; height: 50px;'><br>
                    <strong>Contact:</strong> {$row['rqemp_contact']}<br>
                    <strong>Email:</strong> {$row['rqemp_email']}<br>
                    <strong>Request Date:</strong> {$row['rq_date']}<br>
                    <strong>Employee Files:</strong><br>";

        // SSS Number button with condition
        if (!empty($row['rqempSSS_no'])) {
            echo "<strong>SSS No:</strong> <button style='margin-right: 80px;' onclick=\"window.open('get_SSS.php?rqemp_ID={$row['rqemp_ID']}')\">{$row['rqempSSS_no']}</button>";
        } else {
            echo "<strong>No SSS File</strong>";
        }

        // PhilHealth Number button with condition
        if (!empty($row['rqempPhil_no'])) {
            echo "<strong>PhilHealth No:</strong> <button style='margin-right: 80px;' onclick=\"window.open('get_Phil.php?rqemp_ID={$row['rqemp_ID']}')\">{$row['rqempPhil_no']}</button>";
        } else {
            echo "<strong>No PhilHealth File</strong>";
        }

        // Pag-IBIG Number button with condition
        if (!empty($row['rqempPB_no'])) {
            echo "<strong>Pag_IBIG No:</strong> <button style='margin-right: 80px;' onclick=\"window.open('get_PB.php?rqemp_ID={$row['rqemp_ID']}')\">{$row['rqempPB_no']}</button>";
        } else {
            echo "<strong>No Pag-IBIG File</strong>";
        }

        echo "</td></tr>";
    }

    echo "</tbody>";
} else {
    echo "<tbody><tr><td colspan='5'>There are no Employee Requests</td></tr></tbody>";
}

$conn->close();
