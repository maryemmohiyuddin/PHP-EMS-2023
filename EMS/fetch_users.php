<?php
include_once("connection.php");

// Query to fetch the count of users with type 'user'
$query = "SELECT COUNT(*) AS userCount FROM users WHERE type = 'User'";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $userCount = $row['userCount'];
} else {
echo'error';
}

?>