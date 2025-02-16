<?php
session_start();
include 'db_connect.php'; // Database connection file

// Include PHPMailer for sending emails
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor\phpmailer\phpmailer\src\Exception.php';
require 'vendor\phpmailer\phpmailer\src\PHPMailer.php';
require 'vendor\phpmailer\phpmailer\src\SMTP.php';
require 'vendor/autoload.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $id_number = $_POST['id_number'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'student';

    // Generate a 6-digit OTP
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;
    $_SESSION['register_data'] = [
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'id_number' => $id_number,
        'password' => $password,
        'role' => $role
    ];

    // Send OTP via email
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'betatest775@gmail.com'; // SMTP username
        $mail->Password = 'qjwt ttem syfo euzu'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('betatest775@gmail.com', 'Liceo DocuClaim');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Your OTP for Registration';
        $mail->Body = "Your OTP code is <strong>$otp</strong>. It will expire in 10 minutes.";

        $mail->send();

        header("Location: S_securitycode-r.php");
        exit();
    } catch (Exception $e) {
        $error = "Failed to send OTP. Please try again.";
    }
}
?>

<html>
  <head>
    <title>Liceo DocuClaim; An Appointment System</title>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <style>
      body {
        font-family: "Roboto", sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: #f5f5f5;
      }
      .header {
        width: 100%;
        background-color: #800000;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
      }
      .header img {
        height: 50px;
      }
      .header .title {
        font-size: 24px;
        font-weight: bold;
      }
      .header .subtitle {
        font-size: 14px;
      }
      .back-icon {
        font-size: 24px;
        color: white;
        cursor: pointer;
      }
      .container {
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 20px;
        margin-top: 20px;
        width: 300px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
      .container h2 {
        margin: 0;
        font-size: 20px;
        text-align: center;
      }
      .container p {
        text-align: center;
        color: #666;
        font-size: 14px;
      }
      .form-group {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
      }
      .form-group input {
        width: 48%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
      }
      .form-group.full-width input {
        width: 100%;
      }
      .btn {
        width: 100%;
        padding: 10px;
        background-color: #800000;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        text-decoration: none; /* Remove underline */
        display: inline-block; /* Make it behave like a button */
        text-align: center; /* Center the text */
      }
      .btn:hover {
        background-color: #660000;
      }
    </style>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
  </head>
  <body>
    <div class="header">
      <a class="back-icon">
        <i class="fas fa-arrow-left" onclick="goBack()"></i>
      </a>
      <div>
        <div class="title">Liceo DocuClaim; An Appointment System</div>
        <div class="subtitle"></div>
      </div>
      <img
        alt="Logo on the right"
        height="50"
        src="https://upload.wikimedia.org/wikipedia/en/1/18/Ldcu_seal.png"
        width="50"
      />
    </div>
    <div class="container">
        <h2>Create New Account</h2>
        <p>It's quick and easy.</p>
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form action="" method="post">
            <div class="form-group">
                <input name="firstname" placeholder="First name" type="text" required />
                <input name="lastname" placeholder="Last name" type="text" required />
            </div>
            <div class="form-group">
                <input name="email" placeholder="Email" type="email" required />
                <input name="id_number" placeholder="ID number" type="text" required />
            </div>
            <div class="form-group full-width">
                <input name="password" placeholder="Set Your Password" type="password" required />
            </div>
            <button type="submit" class="btn">Next</button>
        </form>
    </div>  
  </body>
</html>
