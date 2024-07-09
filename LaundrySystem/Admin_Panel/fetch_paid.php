<?php
include 'DBLaundryConnect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$query = "SELECT a.bs_ID, a.bs_name, a.bs_owner, CONCAT(a.bs_brgy, a.bs_city) AS address, b.pay_date, c.sub_cdname, a.bs_status 
FROM laundry_shops a JOIN payment b
ON a.bs_ID = b.bs_ID
JOIN subscription c 
ON b.sub_ID = c.sub_ID 
WHERE a.bs_status = 'Approved'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<tbody>";

    while ($row = $result->fetch_assoc()) {

        echo "<tr class='main-row' data-row-id='{$row['bs_ID']}'>
                <td>{$row['bs_name']}</td>
                <td>{$row['bs_owner']}</td>
                <td>{$row['address']}</td>
                <td>{$row['pay_date']}</td>
                <td>{$row['sub_cdname']}</td>
                <td><strong>Paid</strong></td>
            </tr>";

            
    }

    echo "</tbody>";
} else {
    echo "<p>No paid laundry shops found.</p>";
}

$conn->close();