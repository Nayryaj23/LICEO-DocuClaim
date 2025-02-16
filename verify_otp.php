<?php
session_start();
$response = ['success' => false];

if (isset($_POST['otp'])) {
    if ($_POST['otp'] == $_SESSION['otp']) {
        $response['success'] = true;
    } else {
        $response['error'] = "Invalid OTP. Please try again.";
    }
}

echo json_encode($response);
?>
