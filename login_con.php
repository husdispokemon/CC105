<?php
session_start();
require 'db_con.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email']; // User input email
    $password = $_POST['password']; // User input password

    // Prepare query to get user info including the hashed password
    $stmt = $pdo->prepare("SELECT id, first_name, last_name, password FROM customer_info WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    // Check if user exists and verify the password
    if ($user && password_verify($password, $user['password'])) {
        // Store user information in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];

        // Redirect to the home page
        header('Location: home.php');
        exit;
    } else {
        // Invalid credentials
        echo "<script>alert('Invalid email or password!');</script>";
    }
}
?>
