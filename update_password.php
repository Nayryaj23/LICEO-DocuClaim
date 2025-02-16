<?php
session_start();
require 'db_connect.php';

$response = ['success' => false];

if (isset($_SESSION['email']) && isset($_POST['password'])) {
    $email = $_SESSION['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $password, $email);

    if ($stmt->execute()) {
        $response['success'] = true;
        unset($_SESSION['otp'], $_SESSION['email']); // Clear session data
    } else {
        $response['error'] = "Failed to update password.";
    }
}

echo json_encode($response);
?>
