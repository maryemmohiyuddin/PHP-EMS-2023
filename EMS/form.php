<?php
session_start();

if (isset($_SESSION["user_name"])||isset($_SESSION["organizer_name"])) {
    echo "<script>alert('Another session is already logged in');</script>";
    echo "<script>setTimeout(function(){ window.location = 'getstarted.php'; });</script>"; }
else{

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Process the form data
    $usrname = $_POST["name"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $city = $_POST["city"];
    $pswd = $_POST["password"];
    $type = $_POST["type"];

    // Save the data to the database
    require_once "connection.php"; // Include the database connection

    // Check if the username already exists in the database
    $checkUsernameQuery = "SELECT * FROM users WHERE name = ?";
    $stmtCheckUsername = $conn->prepare($checkUsernameQuery);
    $stmtCheckUsername->bind_param("s", $usrname);
    $stmtCheckUsername->execute();
    $result = $stmtCheckUsername->get_result();

    if ($result->num_rows > 0) {
        // Username already exists, display an error message
        echo "<script>alert('Username already exists. Please choose a different username.');</script>";
        echo "<script>setTimeout(function(){ window.location = 'getstarted.php'; });</script>"; // Redirect after 3 seconds

        exit();
    }

    // Check if the email already exists in the database
    $checkEmailQuery = "SELECT * FROM users WHERE email = ?";
    $stmtCheckEmail = $conn->prepare($checkEmailQuery);
    $stmtCheckEmail->bind_param("s", $email);
    $stmtCheckEmail->execute();
    $result = $stmtCheckEmail->get_result();

    if ($result->num_rows > 0) {
        // Email already exists, display an error message
        echo "<script>alert('Email already exists. Please use a different email address.');</script>";
        echo "<script>setTimeout(function(){ window.location = 'getstarted.php'; });</script>"; // Redirect after 3 seconds

        exit();
    }

    // Image file handling
    $picture = null;
    if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] === 0) {
        $upload_dir = "uploads/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $extension = pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);
        $allowed_extensions = array("jpg", "jpeg", "png");

        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Error: Only JPG, JPEG, and PNG files are allowed.');</script>";
            echo "<script>setTimeout(function(){ window.location = 'getstarted.php'; });</script>"; // Redirect after 3 seconds
            exit();
        }

        $picture_tmp = $_FILES["picture"]["tmp_name"];
        $picture_name = uniqid("user_") . "." . $extension;
        $picture_path = $upload_dir . $picture_name;
        move_uploaded_file($picture_tmp, $picture_path);

        $picture = $picture_path;
    }
    
    $ran_id = rand(time(), 100000000);

    // Prepare the insert query (with the picture field)
    $insertQuery = "INSERT INTO users (unique_id, name, email, gender, city, password, type, picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtInsert = $conn->prepare($insertQuery);
    $stmtInsert->bind_param("ssssssss", $ran_id, $usrname, $email, $gender, $city, $pswd, $type, $picture);

    // Execute the insert query
    if ($stmtInsert->execute()) {
        $_SESSION["user_name"] = $usrname;
        $_SESSION["user_email"] = $email;
        $_SESSION["user_gender"] = $gender;
        $_SESSION["user_city"] = $city;
        $_SESSION["user_type"] = $type;
        $_SESSION["picture"] = $picture;
        $_SESSION["unique_id"]= $ran_id;

        // Registration successful, redirect to success page
        header("Location: userdashboard.php");
        exit();
    } else {
        // Registration failed, redirect to error page or display error message
        header("Location: registration_error.php");
        exit();
    }

    // Close the database connection
    $stmtCheckUsername->close();
    $stmtCheckEmail->close();
    $stmtInsert->close();
    $conn->close();
}
}
?>
