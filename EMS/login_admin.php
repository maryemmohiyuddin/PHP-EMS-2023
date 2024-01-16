
<?php
// Start the session to maintain login status
session_start();

// Check if the user is already logged in, redirect to admin dashboard
if (isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"] === true) {
    header("Location: admin.php");
    exit();
}


// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and sanitize user inputs
    $email = $_POST["admin_email"]; // Corrected variable name to match the form field
    $pswd = $_POST["admin_password"];

    // Include the database connection
    require_once "connection.php";

    // Fetch the admin user from the database
    $query = "SELECT * FROM users WHERE email = ? AND password = ? AND type = 'Admin' LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $pswd);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        // Verify the password
        if (isset($row["name"]) && isset($row["email"]) && isset($row["gender"]) && isset($row["city"]) && isset($row["type"])) {
            $_SESSION["admin_name"] = $row["name"];
            $_SESSION["admin_email"] = $row["email"];
            $_SESSION["admin_gender"] = $row["gender"];
            $_SESSION["admin_city"] = $row["city"];
            $_SESSION["admin_type"] = $row["type"];

            header('Location: admin.php'); // Add the 'Location:' prefix before the URL
            exit(); // Don't forget to exit after the header redirection
        }
            
            else {
            $login_error = "Invalid email or password.";
        }
    } else {
        $login_error = "Invalid email or password.";
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    <?php
    if (isset($login_error)) {
        echo "<p style='color: red;'>$login_error</p>";
    }
    ?>
    <form action="login_admin.php" method="post">
        <label>Email:</label>
        <input type="email" name="admin_email" required>
        <br>
        <label>Password:</label>
        <input type="password" name="admin_password" required>
        <br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
