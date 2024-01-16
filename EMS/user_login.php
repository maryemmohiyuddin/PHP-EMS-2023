<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form data
    $user_email = $_POST["email"];
    $user_password = $_POST["password"];

    // Query the database to check if the user's email and password combination exists and is correct
    require_once "connection.php"; // Include the database connection

    $query = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $user_email, $user_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Login successful, store relevant user data in session variables
        $user = $result->fetch_assoc();
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["name"];
        $_SESSION["user_email"] = $user["email"];
        $_SESSION["user_gender"] = $user["gender"];
        $_SESSION["user_city"] = $user["city"];
        $_SESSION["user_type"] = $user["type"];
        
        // Redirect to userdashboard.php
        header("Location: userdashboard.php");
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
