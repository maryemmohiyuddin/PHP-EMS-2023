<!-- registration_success.php -->

<!-- Start the session to access session variables -->
<?php session_start(); ?>

<!-- Check if session variables are set -->
<?php
if (isset($_SESSION["name"]) && isset($_SESSION["email"])) {
    // Include the header file
?>

<!-- Display the user's registration success message -->
<h3>Registration Successful!</h3>
<p>Welcome, <?php echo $_SESSION["name"]; ?>!</p>
<p>Email: <?php echo $_SESSION["email"]; ?></p>

<!-- Add a Logout button -->
<form action="logout.php" method="post">
    <button type="submit">Logout</button>
</form>

<!-- Include the footer file -->
<?php 

} else {
    // Session variables not set, redirect to login page
    header("Location: getstarted.php");
    exit();
}
?>
