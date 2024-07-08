<?php

include 'DBLaundryConnect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$query = "SELECT rqbs_ID, rqbs_name, rqbs_owner, CONCAT(rqbs_city, ', ', rqbs_brgy) AS address, rqbs_status, rqbs_contact, rqbs_email, rqbsDTI_No, rqbsTIN_No 
FROM request_business 
JOIN request_bsdti ON rqbs_ID = rqbsDTI_ID 
JOIN request_bstin ON rqbs_ID = rqbsTIN_ID";
$result = $conn->query($query);

if($result->num_rows > 0){
    echo "<tbody>";
     
    while ($row = $result->fetch_assoc()){
        echo "<tr class='main-row' data-row-id='{$row['rqbs_ID']}'>
                <td>{$row['rqbs_name']}</td>
                <td>{$row['rqbs_owner']}</td>
                <td>{$row['address']}</td>
                <td>
                    <select class='status-select'>
                        <option value='Pending' " . ($row['rqbs_status'] === 'Pending' ? 'selected' : '') . ">Pending</option>
                        <option value='Approved' " . ($row['rqbs_status'] === 'Approved' ? 'selected' : '') . ">Approved</option>
                        <option value='Rejected' " . ($row['rqbs_status'] === 'Rejected' ? 'selected' : '') . ">Rejected</option>
                    </select>
                </td>
            </tr>
            <tr class='hidden-row' style='display: none;'>
                <td><strong>Contact:</strong> {$row['rqbs_contact']}</td>
                <td><strong>Email:</strong> {$row['rqbs_email']}</td>
                <td><strong>DTI No:</strong> {$row['rqbsDTI_No']}</td>
                <td><strong>TIN No:</strong> {$row['rqbsTIN_No']}</td>
            </tr>";
    }

    echo "</tbody>";
}else{
    echo "<tbody><tr><td colspan='4'>There are no Business Requests</td></tr></tbody>";
}

$conn->close();
