<?php
session_start();

if (isset($_SESSION["organizer_email"])) {
    require_once "connection.php"; // Include the database connection

    // Fetch the organizer's data from the database
    $organizer_email = $_SESSION["organizer_email"];
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Error in prepare: " . $conn->error;
        exit();
    }

    $stmt->bind_param("s", $organizer_email);
    $stmt->execute();
    if (!$stmt) {
        echo "Error in execute: " . $stmt->error;
        exit();
    }

    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        // Organizer data not found or error in query
        // Handle this case accordingly (e.g., redirect to an error page)
        exit();
    }

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Retrieve the form data
        $organizer_name = $_POST["name"];
        $gender = $_POST["gender"];
        $city = $_POST["city"];
// Validate organizer name
if ($organizer_name != $row["name"]) { // Check if the name has changed
    // Check if the new name exists in the database
    $sql_check_name = "SELECT * FROM users WHERE name = ? AND email != ?";
    $stmt_check_name = $conn->prepare($sql_check_name);
    if (!$stmt_check_name) {
        echo "Error in prepare: " . $conn->error;
        exit();
    }

    $stmt_check_name->bind_param("ss", $organizer_name, $organizer_email);
    $stmt_check_name->execute();
    if (!$stmt_check_name) {
        echo "Error in execute: " . $stmt_check_name->error;
        exit();
    }

    $result_check_name = $stmt_check_name->get_result();

    if ($result_check_name && $result_check_name->num_rows > 0) {
        echo "<script>alert('Error: The username already exists in the database. Please choose a different username.');</script>";
        echo "<script>setTimeout(function(){ window.location = 'orgedit.php'; });</script>"; // Redirect after 3 seconds
        exit();
    }

    $stmt_check_name->close();
}

        // Image file handling
        $new_profile_picture_path = $row["picture"]; // Set the initial value to the previous picture path

        if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] == 0) {
            // Ensure the "uploads" folder exists and is writable (create it if needed)
            $upload_dir = "uploads/";
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            // Get the file extension
            $extension = pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);
            $allowed_extensions = array("jpg", "jpeg", "png");

            // Check if the file extension is allowed
            if (!in_array($extension, $allowed_extensions)) {
                echo "<script>alert('Error: Only JPG, JPEG, and PNG files are allowed.');</script>";
                echo "<script>setTimeout(function(){ window.location = 'orgedit.php'; }, 3000);</script>"; // Redirect after 3 seconds
                exit();
            }

            // Move the uploaded file to the "uploads" folder with a unique name
            $picture_tmp = $_FILES["picture"]["tmp_name"];
            $picture_name = uniqid("organizer_") . "." . $extension;
            $new_profile_picture_path = $upload_dir . $picture_name;
            move_uploaded_file($picture_tmp, $new_profile_picture_path);
        }

        // Update the session variable with the new profile picture path
        $_SESSION["organizer_picture"] = $new_profile_picture_path;

        // Update other profile information in the database
        $sql_update_profile = "UPDATE users SET 
            name = ?,
            gender = ?,
            city = ?,
            picture = ?
            WHERE email = ?";
        $stmt_update = $conn->prepare($sql_update_profile);
        if (!$stmt_update) {
            echo "Error in prepare: " . $conn->error;
            exit();
        }

        $stmt_update->bind_param("sssss", $organizer_name, $gender, $city, $new_profile_picture_path, $organizer_email);
        $stmt_update->execute();
        if (!$stmt_update) {
            echo "Error in execute: " . $stmt_update->error;
            exit();
        }

        // Redirect to the profile page or show a success message
        header("Location: orgprofile.php");
        exit();
    }

    // Close the database connection
    $stmt->close();
    $stmt_update->close();
    $conn->close();
} else {
    // Session variables not set, redirect to login page
    header("Location: getstarted.php");
    exit();
}
?>
