<?php
require_once "connection.php"; // Include the database connection
session_start();
// Get the search query from the URL parameter 'event_id'
$event_id = $_GET["event_id"];

// Fetch the event details from the "events" table
$sql = "SELECT * FROM events WHERE event_id = $event_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Fetch the organizer's details from the "organizers" table based on the organizer's name
        $organizer_name = $row["organizer_name"];
        $organizer_query = "SELECT * FROM users WHERE name = '$organizer_name'";
        $organizer_result = mysqli_query($conn, $organizer_query);
        $organizer = mysqli_fetch_assoc($organizer_result);

        // Start the event post template
        echo '<div class="post-bar">';
        echo '<div style="padding:0;" class="suggestion-usd"></div>';
        echo '<div class="post_topbar">';
        echo '<div class="usy-dt">';
        echo '<img src="' . $organizer['picture'] . '" width="35px" height="35px" alt="">';
        echo '<div class="usy-name">';
        echo '<h3>' . $row["organizer_name"] . '</h3>';
        echo '<span>' . $row["submission_time"] . '</span>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="epi-sec">';
        echo '<ul class="descp">';
        echo '<li>';
        echo '<i class="fa-solid fa-location-crosshairs"></i>';
        echo '<span>' . $row["location"] . '</span>';
        echo '</li>';

        // Check if the user already bookmarked this event
        $user_id_query = "SELECT id FROM users WHERE name = '" . $_SESSION['user_name'] . "'";
        $user_id_result = mysqli_query($conn, $user_id_query);
        $user_id = mysqli_fetch_assoc($user_id_result)['id'];

        $bookmark_query = "SELECT * FROM interests WHERE user_id = $user_id AND event_id = " . $row['event_id'];
        $bookmark_result = mysqli_query($conn, $bookmark_query);
        $isBookmarked = mysqli_num_rows($bookmark_result);

        echo '<li>';
        echo '<i class="fa-solid fa-city"></i>';
        echo '<span>' . $row["city"] . '</span>';
        echo '</li>';
        echo '</ul>';
        echo '<ul class="bk-links">';
        echo '<li>';
        echo '<a href="save_bookmark.php?event_id=' . $row["event_id"] . '" class="bookmark-btn">';
        echo '<i class="' . ($isBookmarked ? 'fa-solid' : 'fa-regular') . ' fa-heart"></i></a>';
        echo '</li>';
        echo '</ul>';
        echo '</div>';
        echo '<div class="job_descp">';
        echo '<h3>' . $row["event_name"] . '</h3>';
        echo '<p>' . $row["description"] . '</p>';

        $pictureFilePath = $row["picture"];
        if (!empty($pictureFilePath)) {
            echo '<img src="' . $pictureFilePath . '" width="3100" height="40%" alt="Event Picture" style="margin-bottom:20px">';
        }

        echo '</div>';
        echo '</div>'; // Close the event post template

    }
}
$conn->close();
?>
