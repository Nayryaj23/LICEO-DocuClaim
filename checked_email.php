<?php
session_start();
require 'vendor/autoload.php';
require 'db_connect.php'; // Ensure database connection

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email = $_POST['email'];
$response = ['success' => false];

// Check if email exists in the database
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Generate OTP
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $email;
    
    // Send OTP via email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'betatest775@gmail.com';
        $mail->Password = 'qjwt ttem syfo euzu';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('betatest775@gmail.com', 'Liceo DocuClaim');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP for Password Reset';
        $mail->Body = "Your OTP is <strong>$otp</strong>. It expires in 10 minutes.";

        if ($mail->send()) {
            $response['success'] = true;
        }
    } catch (Exception $e) {
        $response['error'] = "Failed to send OTP. Try again.";
    }
} else {
    $response['error'] = "Email not found.";
}

echo json_encode($response);
?>
