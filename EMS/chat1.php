<?php session_start(); ?>

<!-- Check if session variables are set -->
<?php
// Include the database connection file
// Include the database connection file
require_once "connection.php";

// Fetch all organizer names from the "users" table with type "Event Organizer"
$sql = "SELECT name,id FROM users WHERE type = 'Event Organizer'";
$result = $conn->query($sql);


// Check if there are any organizers
if ($result->num_rows > 0) {
    // Loop through each row and add the name to the array
    while ($row = $result->fetch_assoc()) {
        $organizers[] = $row["name"];
        $id[]=$row["id"];
    }
}

// Close the database connection

// Close the database connection


// Check if the user is logged in, otherwise redirect to the login page
if (isset($_SESSION["user_name"]) && isset($_SESSION["user_email"])) {
    // Include the header file
?>
    <?php
    require_once "connection.php"; // Include the database connection

    // Fetch all events from the "events" table
    $sql = "SELECT * FROM events WHERE status = 'active'";

    $result = $conn->query($sql);

    // Close the database connection
    include('userheader.php');

    ?>
<style>
.scroll{
    max-height: 300px;
    overflow-y: scroll;
}

    /* CSS style for chat message elements */
    .chat-message {
        background-color: #f1f0f0;
        padding: 8px;
        margin-bottom: 10px;
        border-radius: 5px;
    }


</style>
    <main>
        <div class="main-section">
            <div class="container">
                <div class="main-section-data">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 pd-left-none no-pd">
                            <div class=" main-left-sidebar no-margin">
                                <div class="user-data full-width">
                                    <div class="user-profile">
                                        <div class="username-dt">
                                            <!-- PHP code to fetch and store user's profile picture path in session -->
                                            <!-- Display the user's profile picture if available, otherwise show a default image -->
                                            <div class="usr-pic">
                                                <?php
                                                // Check if the user has a profile picture
                                                if (isset($_SESSION["user_picture"]) && !empty($_SESSION["user_picture"])) {
                                                    // Display the user's profile picture
                                                ?>
                                                    <img src="<?php echo $_SESSION["user_picture"]; ?>" alt="User Profile Picture">
                                                <?php
                                                } else {
                                                    // If the user does not have a profile picture or the path is not set, show a default image
                                                ?>
                                                    <img src="path/to/default_image.jpg" alt="Default Profile Picture">
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div><!--username-dt end-->
                                        <div class="user-specs">
                                            <!-- Display the user's registration success message -->

                                            <h3><?php echo $_SESSION["user_name"]; ?></h3>

                                            <span>User</span>
                                        </div>
                                    </div><!--user-profile end-->
                                    <ul class="user-fw-status">

                                        <li>
                                            <a href="my-profile.html" title="">View Profile</a>
                                        </li>
                                    </ul>
                                </div><!--user-data end-->

                            </div><!--username-dt end-->
                        </div>



                        <div class="col-lg-8 col-md-8 no-pd">
                            <div class="container mt-5">
                                <div class="row">
                                    <div class="col-5">
                                        <!-- List of organizers -->
                                        <div class="card">
                                            <div class="card-header">
                                                Organizer List
                                            </div>
                                            <div class="scroll card-body">
                                            <ul class="list-group">
                                                    <?php foreach ($organizers as $organizer) : ?>
                                                        <li class="list-group-item">
                                                            <?php echo $organizer; ?><br>
                                                            <button class="btn btn-primary btn-sm float-end" onclick="openMessageBox('<?php echo $organizer; ?>')">Send Message</button>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <!-- Chat window -->
                                      <!-- Chat Box -->
<div id="messageBox" style="display: none;" class="card">
<div class="card">
    <div class="card-header">
        Chat with <span id="chatOrganizerName"></span>
    </div>
    <div class="card-body" id="chat-box">
    <?php
        // Start the PHP session (should be placed at the beginning of the file)

        // Include the database connection file
        require_once "connection.php";

        // Fetch the organizers from the database
        $query = "SELECT * FROM users WHERE type='Event Organizer'";
        $result = mysqli_query($conn, $query);

        // Check if there are any organizers in the database
        if ($result && mysqli_num_rows($result) > 0) {
            // Loop through the organizers and create chat boxes for each
            while ($row = mysqli_fetch_assoc($result)) {
              

            // Each chat box will have a unique ID based on the organizer's ID
                echo '<div id="messageBox-' . $row['id'] . '" class="chat-box" style="display:block;">';
                echo '<div class="card-header">Chat with ' . $row['name'] . '</div>';
                echo '<div class="chat-messages">'; // Container for chat messages

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

                echo '</div>'; // Close the chat-messages container
                echo '</div>'; // Close the chat box
            }
        } else {
            // If no organizers found in the database, display a message indicating so
            echo 'No organizers found.';
        }
        function getChatMessages($organizerId) {
            include('connection.php')
;            // Fetch chat messages for the specified organizer from the database
            $queryMessages = "SELECT * FROM chat_messages WHERE recipient_id = '$organizerId'";
            $resultMessages = mysqli_query($conn, $queryMessages);
        
            // Prepare the HTML for the chat messages
            $chatMessagesHTML = '';
            if ($resultMessages && mysqli_num_rows($resultMessages) > 0) {
                while ($messageRow = mysqli_fetch_assoc($resultMessages)) {
                    $chatMessagesHTML .= '<div class="chat-message">';
                    $chatMessagesHTML .= '<strong>' . $messageRow['sender_id'] . ':</strong> ' . $messageRow['content'];
                    $chatMessagesHTML .= '</div>';
                }
            } else {
                $chatMessagesHTML .= '<div class="chat-message">';
                $chatMessagesHTML .= 'No messages available.';
                $chatMessagesHTML .= '</div>';
            }
        
            return json_encode($chatMessagesHTML);
        }
        ?>
        
    </div>
</div>


        <div class="input-group">
            <input type="text" class="form-control" id="message-input" placeholder="Type your message...">
           <button class="btn btn-primary" id="send-btn">Send</button>
        </div>
    </div>
</div>


</script>

<!-- JavaScript code to handle sending messages -->
<!-- JavaScript code to handle sending messages -->
<script>
    // Function to display the chat box for a specific organizer
function openMessageBox(organizer) {
    document.getElementById('chatOrganizerName').innerText = organizer;
    document.getElementById('messageBox').style.display = 'block';

    // Make an AJAX request to fetch chat messages for the selected organizer
    // Replace 'fetch_chat_messages.php' with the appropriate server-side script that fetches the chat messages
    // The script should take the organizer's name as input and return the chat messages as a response
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'fetch_chat_messages.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle the response and display the chat messages in the chat-box element
            const chatBox = document.getElementById('chat-box');
            chatBox.innerHTML = xhr.responseText;
        }
    };

    // Send the organizer's name as data in the AJAX request
    xhr.send('organizer=' + encodeURIComponent(organizer));
}
 // Function to send a message to the organizer
    document.getElementById('send-btn').addEventListener('click', function() {
        var message = document.getElementById('message-input').value;
        var organizerName = document.getElementById('chatOrganizerName').innerText;
        
        // Send the message to the server using AJAX (You can use jQuery AJAX or fetch API here)
        // For simplicity, I'll use a basic XMLHttpRequest here
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'send_message.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Message sent successfully, redirect to send_message.php
                window.location.href = 'send_message.php?organizer=' + encodeURIComponent(organizerName) + '&message=' + encodeURIComponent(message);
            }
        };
        xhr.send('organizer=' + encodeURIComponent(organizerName) + '&message=' + encodeURIComponent(message));
        
        // Clear the message input field
        document.getElementById('message-input').value = '';
    });
    </script>



                            <!-- Add Bootstrap JS scripts -->
                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                        </div>
                    </div><!-- main-section-data end-->
                </div>
            </div>
    </main>










    </div><!--theme-layout end-->



    <script type="text/javascript" src="assets/admin/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/admin/js/popper.js"></script>
    <script type="text/javascript" src="assets/admin/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/admin/js/jquery.mCustomScrollbar.js"></script>
    <script type="text/javascript" src="assets/admin/js/slick.min.js"></script>
    <script type="text/javascript" src="assets/admin/js/scrollbar.js"></script>
    <script type="text/javascript" src="assets/admin/js/script.js"></script>

    </body>

    </html>
<?php

} else {
    // Session variables not set, redirect to login page
    // header("Location: getstarted.php");
    exit();
}
$conn->close();

?>