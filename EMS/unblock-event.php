<?php
require_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["unblock_id"])) {
        $event_id = $_GET["unblock_id"];

        // Update the event status to "active" in the "events" table
        $sql_unblock = "UPDATE events SET status = 'active' WHERE event_id = $event_id";
        if ($conn->query($sql_unblock) === TRUE) {
            // Event unblocked successfully
            header("Location: ecommerce-orders.php"); // Redirect back to the events management page
            exit();
        } else {
            // Error occurred while unblocking the event
            echo "Error: " . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>
