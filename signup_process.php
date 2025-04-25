<?php
// Include database connection
require_once 'login.php';

// Signup processing - save as signup_process.php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['password'])) {
    // Get form data
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    
    // Check if email already exists
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($check_email);
    
    if ($result->num_rows > 0) {
        // Email already exists
        echo "<script>alert('Email already exists. Please use a different email or login.');</script>";
        echo "<script>window.location = 'signup.html';</script>";
    } else {
        // Hash password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert new user into database
        $sql = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$hashed_password')";
        
        if ($conn->query($sql) === TRUE) {
            // Registration successful
            echo "<script>alert('Registration successful! You can now login.');</script>";
            echo "<script>window.location = 'index.html';</script>";
        } else {
            // Registration failed
            echo "<script>alert('Error: " . $conn->error . "');</script>";
            echo "<script>window.location = 'signup.html';</script>";
        }
    }
}
?>