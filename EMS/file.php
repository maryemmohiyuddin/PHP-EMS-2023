
<?php
        // Start the PHP session (should be placed at the beginning of the file)

        // Include the database connection file
        require_once "connection.php";

        // Fetch the organizers from the database
        $query = "SELECT * FROM users Where type = 'Event Organizer'";
        $result = mysqli_query($conn, $query);

        // Check if there are any organizers in the database
        if ($result && mysqli_num_rows($result) > 0) {
            // Loop through the organizers and create chat boxes for each
            while ($row = mysqli_fetch_assoc($result)) {
               echo '<div id="messageBox' . $row['id'] . '" class="card" style="display: block;">';
                echo '<div class="card-header">Chat with ' . $row['name'] . '</div>';
                echo '<div class="card-body" id="chat-box' . $row['id'] . '">';

                // Fetch previous chat messages for the specified organizer ID from the database
                $organizerId = $row['id'];
                $queryMessages = "SELECT * FROM chat_messages WHERE recipient_id = '$organizerId'";
                $resultMessages = mysqli_query($conn, $queryMessages);

                if ($resultMessages && mysqli_num_rows($resultMessages) > 0) {
                    // Display the chat messages for this organizer
                    while ($messageRow = mysqli_fetch_assoc($resultMessages)) {
                        echo '<div class="chat-message">';
                        echo '<strong>' . $messageRow['sender_id'] . ':</strong> ' . $messageRow['content'];
                        echo '</div>';
                    }
                } else {
                    // If there are no messages, display a message indicating so
                    echo '<div class="chat-message">';
                    echo 'No messages available.';
                    echo '</div>';
                }

                echo '</div>';
                echo '<div class="card-footer">';
                echo '<!-- Message input -->';
                echo '<div class="input-group">';
                echo '<input type="text" class="form-control message-input" data-organizer="' . $row['id'] . '" placeholder="Type your message...">';
                echo '<button class="btn btn-primary send-btn" data-organizer="' . $row['id'] . '">Send</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            // If no organizers found in the database, display a message indicating so
            echo 'No organizers found.';
        }

        // Close the database connection
        ?>