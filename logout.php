<?php
// logout.php - Handles user logout

// Initialize the session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page
header("location: index.html");
exit;
?>