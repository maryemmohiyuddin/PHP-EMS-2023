<?php
// Start the session (needed to access session variables)
session_start();

// Check if the user is logged in, otherwise redirect to the login page


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $id = $_POST["id"];
    $usrname = $_POST["name"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $city = $_POST["city"];
    $pswd = $_POST["password"];

    // Update the data in the database
    require_once "connection.php"; // Include the database connection

    $sql = "UPDATE users SET name = ?, email = ?, gender = ?, city = ?, password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $usrname, $email, $gender, $city, $pswd, $id);
    
if ($stmt->execute()) {
    echo "Data updated successfully.";
} else {
    echo "Error updating data: " . $conn->error;
}
    if ($stmt->execute()) {
        // Redirect to the success page or any other page you want after updating
        header("Location: table-datatable.php?");
        exit();
    } else {
        // Redirect to an error page or display an error message as you like
        echo('Error');
        exit();
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    header("Location: table-datatable.php");
    exit();
}
?>
