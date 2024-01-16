<?php
session_start(); // Start the session
if (isset($_SESSION["user_name"]) || isset($_SESSION["organizer_name"])) {
    echo "<script>alert('Another session is already logged in');</script>";
    echo $_SESSION["organizer_name"];
    // echo "<script>setTimeout(function(){ window.location = 'getstarted.php'; });</script>"; 
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process the form data
        $email = $_POST["email"]; // Corrected variable name to match the form field
        $pswd = $_POST["password"];

        // Query the database to check if the username/email and password combination exists and is correct
        require_once "connection.php"; // Include the database connection

        $query = "SELECT * FROM users WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $email, $pswd);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Login successful, store relevant user data in session variables
            $user = $result->fetch_assoc();
            $_SESSION["id"] = $user["id"];

            // Check the user type and set session variables accordingly
            if ($user["type"] === 'User') {
                $_SESSION["user_name"] = $user["name"];
                $_SESSION["user_email"] = $user["email"];
                $_SESSION["user_gender"] = $user["gender"];
                $_SESSION["user_city"] = $user["city"];
                $_SESSION["user_type"] = $user["type"];
                $_SESSION["picture"] = $user["picture"];

                $_SESSION["unique_id"] = $user["unique_id"];

                header("Location: userdashboard.php");
                exit();
            } else if ($user["type"] === 'Event Organizer') {
                $_SESSION["organizer_name"] = $user["name"];
                $_SESSION["organizer_email"] = $user["email"];
                $_SESSION["organizer_gender"] = $user["gender"];
                $_SESSION["organizer_city"] = $user["city"];
                $_SESSION["organizer_type"] = $user["type"];
                $_SESSION["picture"] = $user["picture"];

                $_SESSION["unique_id"] = $user["unique_id"];

                header("Location: organizerdashboard.php");
                exit();
            } else if ($user["type"] === 'Admin') {
                $_SESSION["admin_name"] = $user["name"];
                $_SESSION["admin_email"] = $user["email"];
                $_SESSION["admin_gender"] = $user["gender"];
                $_SESSION["admin_city"] = $user["city"];
                $_SESSION["admin_type"] = $user["type"];
                $_SESSION["admin_picture"] = $user["picture"];
                echo '<img src="' . $_SESSION["admin_picture"] . '"></img>';
                header("Location: admin.php");

                exit();
            } else {
                // Invalid user type, redirect back to the login form with an error message
                echo "<script>alert('Invalid user.');</script>";
                echo "<script>setTimeout(function(){ window.location = 'getstarted.php'; });</script>"; // Redirect after 3 seconds            header("Location: getstarted.php");

                exit();
            }
        } else {
            // Login failed, display an error message or redirect back to the login form with an error message
            echo "<script>alert('Invalid email or password.');</script>";
            echo "<script>setTimeout(function(){ window.location = 'getstarted.php'; });</script>";
            exit();
        }

        // Close the database connection

    }
}
?>