<?php
session_start();
require 'db_con.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_picture'])) {
    $user_id = $_SESSION['user_id'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);

    // Move uploaded file
    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
        $stmt = $pdo->prepare("UPDATE customer_info SET profile_picture = :profile_picture WHERE id = :id");
        $stmt->execute(['profile_picture' => $_FILES["profile_picture"]["name"], 'id' => $user_id]);
        $_SESSION['profile_picture'] = $_FILES["profile_picture"]["name"];
        header("Location: home.php");
        exit;
    } else {
        echo "Error uploading file.";
    }
}
?>
