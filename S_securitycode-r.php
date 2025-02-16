<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entered_otp = $_POST['otp'];
    
    if ($entered_otp == $_SESSION['otp']) {
        // OTP is correct, insert user data into database
        $data = $_SESSION['register_data'];

        $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, id_number, password, role) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $data['firstname'], $data['lastname'], $data['email'], $data['id_number'], $data['password'], $data['role']);

        if ($stmt->execute()) {
            unset($_SESSION['otp']);
            unset($_SESSION['register_data']);
            $_SESSION['success'] = "Your account has been successfully created. Please log in.";
            header("Location: login.php"); // Redirect to login
            exit();
        } else {
            $error = "Registration failed. Please try again.";
        }
    } else {
        $error = "Invalid OTP. Please try again.";
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
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #fff;
        flex-direction: column;
      }
      .header {
        background-color: #800000;
        color: white;
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
      .header i {
        margin-right: 10px;
        font-size: 20px;
      }
      .header span {
        flex-grow: 1;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .header img {
        height: 40px;
      }
      .verification-text {
        color: #d3a7a7;
        margin-top: 40px; /* Adjusted to move it upper */
        text-align: center;
        font-size: 18px; /* Adjusted to make it a little bigger */
        font-style: italic; /* Slant the text */
      }
      .container {
        text-align: center;
        width: 100%;
        max-width: 300px;
        height: 300px;
        border: 1px solid #ccc;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px; /* Adjust this value if needed */
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
      }
      .title {
        font-size: 20px;
        font-weight: bold;
        margin: 5px 0; /* Adjusted to move it a little upper */
        position: relative;
      }
      .title::after {
        content: "";
        display: block;
        width: 100%;
        height: 1px;
        background-color: black;
        position: absolute;
        bottom: -10px; /* Adjusted to move the line a little lower */
        left: 0;
      }
      .input-container {
        margin: 20px 0;
        display: flex;
        flex-direction: column;
        align-items: center;
      }
      .input-container p {
        color: gray;
        margin-bottom: 10px;
        font-size: 16px; /* Adjusted to make it a little bigger */
        font-style: italic; /* Slant the text */
      }
      .input-container input {
        width: 100%;
        max-width: 200px; /* Adjust this value if needed */
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        text-align: center; /* Center the text inside the input */
        margin-top: 20px; /* Adjusted to move it lower */
      }
      .continue-button {
        background-color: #800000;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px; /* Rounded corners */
        font-size: 16px; /* Original font size */
        cursor: pointer;
        margin-top: 20px; /* Adjusted to move it upper */
        text-decoration: none; /* Remove underline */
      }
      .continue-button:hover {
        background-color: #a00000;
      }
      @media (max-width: 600px) {
        .container {
          width: 90%;
          height: auto;
        }
        .header {
          width: 100%;
        }
      }
    </style>
  </head>
  <body>
    <div class="header">
      <i class="fas fa-arrow-left"> </i>
      <span>
        <img
          alt="Liceo logo"
          src="https://scontent.xx.fbcdn.net/v/t1.15752-9/474063385_591134910218394_3073218857154146188_n.png?_nc_cat=104&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeFuWbNIjNF5DciNdnoOaI3_x7hAkRlgb5jHuECRGWBvmCKsvE16JJcRpivn3JwL_4HCNlNyYTbaKkMG-Yd28eFb&_nc_ohc=GKFXsbmg5KYQ7kNvgHh56g-&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.xx&oh=03_Q7cD1gEw5GoFarwnVBa5A7GKYHP_jkjMeHSHRMRsiyeDrFPaVQ&oe=67C56422"
          style="margin-right: 10px"
        />
        Liceo DocuClaim; An Appointment System
      </span>
      <img
        alt="Liceo logo"
        src="https://www.liceo.edu.ph/images/ico-liceo-big.png"
      />
    </div>
    <div class="verification-text">Verification code sent to gmail.</div>
    <div class="container">
      <div class="title">Enter security code</div>
      <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
      <div class="input-container">
        <p>Please enter your verification code</p>
        <form action="" method="post">
            <input name="otp" placeholder="Enter OTP" type="text" required />
            <button class="continue-button" type="submit">Verify</button>
        </form>
      </div>
    </div>
  </body>
</html>
