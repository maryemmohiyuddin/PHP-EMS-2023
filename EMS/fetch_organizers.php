<?php
// Include the database connection file
require_once "connection.php";

// Fetch the list of organizers from the database
$query = "SELECT id,name FROM users WHERE type = 'Event Organizer'";

$result = mysqli_query($conn, $query);

// Initialize an empty array to store the organizers
$organizers = array();

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $organizers[] = array(
            'id' => $row['id'],
            'name' => $row['name']
        );
    }
    mysqli_free_result($result);
}

// Return the list of organizers as JSON response
header('Content-Type: application/json');
echo json_encode($organizers);
