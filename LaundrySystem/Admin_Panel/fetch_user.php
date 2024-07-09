<?php

include 'DBLaundryConnect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$query = "SELECT user_ID, user_name, CONCAT(user_brgy, ', ', user_city) AS address, user_contact, user_email 
FROM user_info
WHERE rquser_status = 'Approved'";
$result = $conn->query($query);

if ($result->num_rows > 0){
    echo "<tbody";

    while ($row = $result->fetch_assoc()){
        echo "<tr class='main-row' data-row-id='{$row['user_ID']}'>
                <td>{$row['user_name']}</td>
                <td>{$row['address']}</td>
                <td>{$row['user_contact']}</td>
                <td>{$row['user_email']}'</td>
            </tr>";

    }

    echo "</tbody>";
} else {
    echo "<tbody><tr><td colspan='5'>There are no Registered Users</td></tr></tbody>";
}

$conn->close();


