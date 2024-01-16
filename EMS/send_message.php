<?php
// Include the database connection file
require_once "connection.php";
session_start();
// Check if the 'organizer' and 'message' parameters are present
if (isset($_GET['organizer']) && isset($_GET['message'])) {
    // Get the organizer name and message from the GET parameters
    $organizerName = $_GET['organizer'];
    $message = $_GET['message'];
$user_name=$_SESSION["user_name"];
$sq = "SELECT id FROM users WHERE name = '$user_name' AND type = 'User'";
$resul = $conn->query($sq);
$ro = $resul->fetch_assoc();




    // TODO: Retrieve the sender ID and recipient ID based on the organizer name and user's ID from the session (you need to have user authentication in place)
    $senderId = $ro["id"]; // Replace 1 with the sender's ID (user ID from the session)
    
    // Get the recipient ID from the database based on the organizer name
    $sql = "SELECT id FROM users WHERE name = '$organizerName' AND type = 'Event Organizer'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $recipientId = $row['id'];

        // Save the message to the database
        $timestamp = date('Y-m-d H:i:s');
        $sql = "INSERT INTO chat_messages (sender_id, recipient_id, content, timestamp)
                VALUES ($senderId, $recipientId, '$message', '$timestamp')";

        if ($conn->query($sql) === TRUE) {
            // Message saved successfully
            echo "Message sent to $organizerName: $message";
        } else {
            // Error occurred while saving the message
            echo "Error: " . $conn->error;
        }
    } else {
        // Organizer not found in the database
        echo "Error: Organizer not found.";
    }
}
?>
