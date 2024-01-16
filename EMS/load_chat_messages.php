<?php
// Include the database connection file
require_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["organizer_name"])) {
    $organizerName = $_GET["organizer_name"];

    // Assuming you have a users table where you can fetch the organizer's user_id based on their name
    $sql_get_organizer_id = "SELECT id FROM users WHERE name = '$organizerName' AND type = 'Event Organizer'";
    $result_organizer_id = $conn->query($sql_get_organizer_id);

    if ($result_organizer_id && $result_organizer_id->num_rows === 1) {
        $row = $result_organizer_id->fetch_assoc();
        $organizerId = $row["id"];

        // Fetch chat messages between the logged-in user and the selected organizer
        $user_id = $_SESSION['user_id']; // Assuming you have a users table and store the user_id in the session
        $sql_fetch_messages = "SELECT * FROM messages WHERE (sender_id = $user_id AND recipient_id = $organizerId) OR (sender_id = $organizerId AND recipient_id = $user_id) ORDER BY timestamp ASC";
        $result_messages = $conn->query($sql_fetch_messages);

        // Create an array to store the chat messages
        $chatMessages = array();

        if ($result_messages->num_rows > 0) {
            // Loop through each row and add the message content to the array
            while ($row = $result_messages->fetch_assoc()) {
                $chatMessages[] = $row["content"];
            }
        }

        // Return the chat messages as JSON data
        echo json_encode($chatMessages);
    } else {
        // Organizer not found or multiple organizers with the same name
        echo "Organizer not found or multiple organizers with the same name.";
    }
}

// Close the database connection
$conn->close();
?>
