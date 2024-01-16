<?php
// fetch_messages.php

// Start the PHP session (should be placed at the beginning of the file)
session_start();
include('connection.php');
echo $_SESSION['organizerName'];
// Check if the 'organizerId' and 'organizerName' are present in the session
if (isset($_SESSION['organizerId']) && isset($_SESSION['organizerName'])) {
    // Get the organizer ID and name from the session
    $organizerId = $_SESSION['organizerId'];
    $organizerName = $_SESSION['organizerName'];

    // Fetch previous chat messages for the specified organizer ID from the database
    // Replace 'messages' and 'organizer_id' with the actual table and column names in your database
    $query = "SELECT * FROM messages WHERE organizer_id = '$organizerId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Display the sender name and content for each message
            echo '<div class="chat-message">';
            echo '<strong>' . $row['sender'] . ':</strong> ' . $row['content'];
            echo '</div>';
        }
        mysqli_free_result($result);
    } else {
        // If there are no messages, display a message indicating so
        echo '<div class="chat-message">';
        echo 'No messages available.';
        echo '</div>';
    }
} else {
    // Return an error response if the 'organizerId' or 'organizerName' is not set in the session
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(array('error' => 'Organizer ID or name not provided.'));
}
?>
