delete-user.php<?php
// Include the database connection
require_once "connection.php";

// Check if the user ID is provided in the URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Perform the delete operation in the database
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect back to the data table page after successful deletion
        header("Location: table-datatable.php");
        exit();
    } else {
        // Handle the error if the delete operation fails
        echo "Error deleting user.";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    // If the user ID is not provided in the URL, redirect back to the data table page
    header("Location: table-datatable.php");
    exit();
}
?>
