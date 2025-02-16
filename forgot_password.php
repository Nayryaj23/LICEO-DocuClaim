<?php
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

<!DOCTYPE html>
<html>
  <head>
    <title>Liceo DocuClaim; An Appointment System</title>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        height: 100vh;
        background-color: #f8f9fa;
      }
      .header {
        width: 100%;
        background-color: #7d0d1e;
        color: white;
        display: flex;
        align-items: center;
        padding: 10px;
        justify-content: space-between;
      }
      .header a {
        color: white;
        text-decoration: none;
      }
      .header i {
        font-size: 30px;
        margin-right: 10px;
        cursor: pointer;
      }
      .header img {
        height: 50px;
      }
      .header .title {
        flex-grow: 1;
        text-align: center;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .container {
        border: 1px solid #ccc;
        padding: 30px;
        text-align: center;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        width: 90%;
        max-width: 400px;
        border-radius: 10px;
        background-color: rgba(255, 255, 255, 0.9);
        margin-top: 20px;
      }
      .container h2 {
        margin-top: 0;
        font-size: 18px;
        font-weight: bold;
      }
      .container hr {
        border: 0;
        border-top: 1px solid black;
        margin: 10px 0;
      }
      .container input {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
      }
      .container input::placeholder {
        color: #ccc;
      }
      .container a.button {
        display: inline-block;
        background: linear-gradient(90deg, #7d0d1e, #5a0a15);
        color: white;
        padding: 15px 30px;
        border-radius: 5px;
        font-size: 16px;
        text-decoration: none;
        cursor: pointer;
      }
      .container a.button:hover {
        background-color: #5a0a15;
      }
      .hidden {
        display: none;
      }
    </style>
    <script>

function validateEmail() {
    const email = document.getElementById("email").value;
    const emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

    if (!emailPattern.test(email)) {
        alert("Please enter a valid Gmail address.");
        return;
    }

    fetch('checked_email.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'email=' + encodeURIComponent(email)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById("otpSection").classList.remove("hidden");
            document.getElementById("emailSection").classList.add("hidden");
        } else {
            alert(data.error);
        }
    })
    .catch(error => console.error('Error:', error));
}

function verifyOtp() {
    const otp = document.getElementById("otp").value;

    fetch('verify_otp.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'otp=' + encodeURIComponent(otp)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById("passwordFields").classList.remove("hidden");
            document.getElementById("otpSection").classList.add("hidden");
        } else {
            alert(data.error);
        }
    })
    .catch(error => console.error('Error:', error));
}

function validatePasswords() {
    const password1 = document.getElementById("password1").value;
    const password2 = document.getElementById("password2").value;

    if (password1 !== password2) {
        alert("Passwords do not match!");
        return;
    }

    fetch('update_password.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'password=' + encodeURIComponent(password1)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Password successfully changed!");
            window.location.href = "login.php";
        } else {
            alert("Error updating password. Try again.");
        }
    })
    .catch(error => console.error('Error:', error));
}



    </script>
  </head>
  <body>
    <div class="header">
      <a><i class="fas fa-arrow-left" onclick="goBack()"></i></a>
      <span class="title">
        <img
          alt="Random logo"
          src="https://scontent.xx.fbcdn.net/v/t1.15752-9/474063385_591134910218394_3073218857154146188_n.png?_nc_cat=104&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeFI1VZIfTJtLH3oc3SKwjXSx7hAkRlgb5jHuECRGWBvmOko-iuYiIg6aS4emRoJC85fjNQjB16J7q4QgRc_DJeJ&_nc_ohc=S9-cDQXqEnUQ7kNvgFLF09B&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.xx&oh=03_Q7cD1gGAHnOwYWPPgImJFwSzonN9qFzxj8k7siOsb3IteEkMGw&oe=67C05662"
        />
        Liceo DocuClaim; An Appointment System
      </span>
      <img
        alt="Liceo logo"
        src="https://upload.wikimedia.org/wikipedia/en/1/18/Ldcu_seal.png"
      />
    </div>

    <!-- Email input section -->
    <div class="container" id="emailSection">
      <h2>Enter Your Gmail</h2>
      <hr />
      <input type="email" id="email" placeholder="Enter your Gmail" />
      <a class="button" onclick="validateEmail()">NEXT</a>
    </div>
    

    <!-- OTP input section (Initially hidden) -->
<div class="container hidden" id="otpSection">
  <h2>Enter OTP</h2>
  <hr />
  <input type="text" id="otp" placeholder="Enter OTP" />
  <a class="button" onclick="verifyOtp()">VERIFY</a>
</div>


    <!-- Password input section (Initially hidden) -->
    <div class="container hidden" id="passwordFields">
      <h2>Enter New Password</h2>
      <hr />
      <input type="password" id="password1" placeholder="Enter new password" />
      <input type="password" id="password2" placeholder="Re-enter new password" />
      <a class="button" onclick="validatePasswords()">SAVE</a>
    </div>

  </body>
</html>
