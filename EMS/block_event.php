<?php
require_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["event_id"])) {
        $event_id = $_POST["event_id"];

        // Check if the event is already blocked
        $sql_check_status = "SELECT status FROM events WHERE event_id = $event_id";
        $result_check_status = $conn->query($sql_check_status);

        if ($result_check_status->num_rows === 1) {
            $row = $result_check_status->fetch_assoc();
            $current_status = $row["status"];

            if ($current_status === 'blocked') {
                // Show the confirmation modal
               echo' <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">';

                echo '<div id="confirmModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">';
                echo '    <div class="modal-dialog">';
                echo '        <div class="modal-content">';
                echo '            <div class="modal-header">';
                echo '                <h5 class="modal-title">Confirmation</h5>';
                echo '                <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                echo '                    <span aria-hidden="true">&times;</span>';
                echo '                </button>';
                echo '            </div>';
                echo '            <div class="modal-body">';
                echo '                <p>The event is already blocked. Do you want to unblock it?</p>';
                echo '            </div>';
                echo '            <div class="modal-footer">';
                echo "                <a href='unblock-event.php?unblock_id=$event_id' class='btn btn-success'>Unblock</a>";
                echo '                <a href="ecommerce-orders.php" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</a>';
                echo '            </div>';
                echo '        </div>';
                echo '    </div>';
                echo '</div>';

                // Show the modal using JavaScript
                echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
                echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>';
                echo '<script>';
                echo '$(document).ready(function() {';
                echo '    $("#confirmModal").modal("show");';
                echo '});';
                echo '</script>';
            } else {
                // Update the event status to "blocked" in the "events" table
                $sql_block = "UPDATE events SET status = 'blocked' WHERE event_id = $event_id";
                if ($conn->query($sql_block) === TRUE) {
                    // Event blocked successfully
                    header("Location: ecommerce-orders.php"); // Redirect back to the events management page
                    exit();
                } else {
                    // Error occurred while blocking the event
                    echo "Error: " . $conn->error;
                }
            }
        }
    }
} 
// Close the database connection
$conn->close();
?>
