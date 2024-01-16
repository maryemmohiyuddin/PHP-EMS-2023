<?php
session_start();

require_once "connection.php"; // Include the database connection

// Check if the user is logged in and has a valid user ID (Replace this with your user authentication code)
$username = $_SESSION["user_name"]; // Replace this with the actual user name of the logged-in user

$user_id_query = "SELECT id FROM users WHERE name = ?";
$stmt = mysqli_prepare($conn, $user_id_query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$resu = mysqli_stmt_get_result($stmt);

if (!$resu) {
    echo "Error fetching user ID: " . mysqli_error($conn);
} else {
    $row = mysqli_fetch_assoc($resu);
    $user_id = $row["id"];
}

$event_id = $_GET["event_id"];

// Check if the user has bookmarked this event
$bookmark_query = "SELECT * FROM interests WHERE user_id = ? AND event_id = ?";
$stmt = mysqli_prepare($conn, $bookmark_query);
mysqli_stmt_bind_param($stmt, "ii", $user_id, $event_id);
mysqli_stmt_execute($stmt);
$bookmark_result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($bookmark_result) === 1) {
    // The user has bookmarked this event, delete the bookmark
    $delete_query = "DELETE FROM interests WHERE user_id = ? AND event_id = ?";
    $stmt = mysqli_prepare($conn, $delete_query);
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $event_id);
    
    if (mysqli_stmt_execute($stmt)) {
        // Bookmark removed successfully, you can add more logic here if needed
        echo "<script>alert('Event unbookmarked successfully.');</script>";
        echo "<script>window.location.href = 'userdashboard.php';</script>";
    } else {
        echo "Error unbookmarking the event: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
