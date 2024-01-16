<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and sanitize user inputs (you may add more validation as needed)
    $event_name = htmlspecialchars($_POST["event_name"]);
    $location = htmlspecialchars($_POST["location"]);
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $organizer_name = htmlspecialchars($_POST["organizer_name"]);
    $description = htmlspecialchars($_POST["description"]);
    $city = htmlspecialchars($_POST["city"]);

    // Image file handling (same as before)
    $picture = null;
    if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] === 0) {
        // Ensure the "uploads" folder exists and is writable (create it if needed)
        $upload_dir = "uploads/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Move the uploaded file to the "uploads" folder with a unique name
        $picture_tmp = $_FILES["picture"]["tmp_name"];
        $picture_name = uniqid("event_") . "_" . $_FILES["picture"]["name"];
        $picture_path = $upload_dir . $picture_name;
        move_uploaded_file($picture_tmp, $picture_path);

        // Store the picture path in the database
        $picture = $picture_path;
    }

    require_once "connection.php"; // Include the database connection

    // Get the current date and time using PHP's date() function
    $submission_time = date("Y-m-d H:i:s");

    // Insert the event data into the "pending_events" table for approval
    $sql = "INSERT INTO pending_events (event_name, location, start_date, end_date, picture, organizer_name, description, city, submission_time)
            VALUES ('$event_name', '$location', '$start_date', '$end_date', '$picture', '$organizer_name', '$description', '$city', '$submission_time')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Event data submitted for approval!"); window.location.href = "organizerdashboard.php";</script>';


    } else {
        echo '<script>alert("Error: ' . $conn->error . '"); window.location.href = "organizerdashboard.php";</script>';
    }

    // Close the database connection
    $conn->close();
}
?>
