<?php
require_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["event_id"])) {
        $event_id = $_POST["event_id"];

        // Delete the event from the "events" table
        $sql_delete = "DELETE FROM events WHERE event_id = $event_id";
        if ($conn->query($sql_delete) === TRUE) {
            // Event deleted successfully
            header("Location: ecommerce-orders.php"); // Redirect back to the events management page
            exit();
        } else {
            // Error occurred while deleting the event
            echo "Error: " . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>
