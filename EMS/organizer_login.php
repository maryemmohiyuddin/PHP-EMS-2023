<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form data
    $organizer_email = $_POST["email"];
    $organizer_password = $_POST["password"];

    // Query the database to check if the event organizer's email and password combination exists and is correct
    require_once "connection.php"; // Include the database connection

    $query = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $organizer_email, $organizer_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Login successful, store relevant event organizer data in session variables
        $organizer = $result->fetch_assoc();
        echo $organizer['id'];
        $_SESSION["organizer_id"] = $organizer["id"];
        $_SESSION["organizer_name"] = $organizer["name"];
        $_SESSION["organizer_email"] = $organizer["email"];
        $_SESSION["user_gender"] = $organizer["gender"];
        $_SESSION["organizer_city"] = $organizer["city"];
        $_SESSION["organizer_type"] = $organizer["type"];
        $_SESSION["organizer_picture"] = $organizer["picture"];


        
        // Redirect to organizerdashboard.php
        header("Location: organizerdashboard.php");
        exit();
    } else {
        // Login failed, display an error message or redirect back to the login form with an error message
        $_SESSION["error_message"] = "Invalid username/email or password.";
        header("Location: getstarted.php");
        exit();
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>
