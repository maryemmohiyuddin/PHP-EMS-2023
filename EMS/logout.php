<!-- logout.php -->

<!-- Start the session to access session variables -->
<?php session_start(); ?>

<!-- Clear all session variables -->
<?php session_unset(); ?>

<!-- Destroy the session -->
<?php session_destroy(); ?>

<!-- Redirect to the login page (assuming login page is named "login.php") -->
<?php header("Location: getstarted.php"); ?>
