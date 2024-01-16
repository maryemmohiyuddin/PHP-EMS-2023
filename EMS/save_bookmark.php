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

$sql = "SELECT * FROM events WHERE event_id = $event_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $eventId = $row['event_id'];

        // Check if the user already bookmarked this event
        $bookmark_query = "SELECT * FROM interests WHERE user_id = ? AND event_id = ?";
        $stmt = mysqli_prepare($conn, $bookmark_query);
        mysqli_stmt_bind_param($stmt, "ii", $user_id, $eventId);
        mysqli_stmt_execute($stmt);
        $bookmark_result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($bookmark_result) === 0) {
            // If the user hasn't bookmarked the event yet, insert a new record in the 'interests' table
            $query = "INSERT INTO interests (user_id, event_id) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "ii", $user_id, $eventId);
            if (mysqli_stmt_execute($stmt)) {
                // You can also add more logic here, like updating the event's bookmark count in the 'events' table if needed.
                echo "<script>window.location.href = 'userdashboard.php';</script>";
            } else {
                echo "Error bookmarking the event: " . mysqli_error($conn);
            }
        } else {
            // The user has already bookmarked this event, ask if they want to unbookmark it
            echo "<script>
                if (confirm('Event already bookmarked. Do you want to unbookmark it?')) {
                    // User confirmed, delete the bookmark from the database
                    window.location.href = 'unbookmark.php?event_id=$eventId';
                }
            </script>";
        }
    }
} else {
    echo "Invalid request.";
}
// Close the database connection
mysqli_close($conn);
?>
