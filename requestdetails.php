<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['document_type'])) {
    $_SESSION['document_type'] = $_GET['document_type']; // Store document type
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
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #fff;
      }
      .header {
        background-color: #800000;
        color: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 20px;
      }
      .header i {
        font-size: 24px;
        cursor: pointer;
        color: white; /* Ensure the icon remains white */
      }
      .header h1 {
        font-size: 24px; /* Increased font size */
        margin: 0;
        display: flex;
        align-items: center;
      }
      .header h1 i {
        margin-right: 10px;
      }
      .header a {
        background-color: #fff;
        color: #800000;
        border: 1px solid #fff;
        padding: 5px 10px;
        cursor: pointer;
        text-decoration: none; /* Remove underline */
      }
      .main-content {
        text-align: center;
        padding: 0;
      }
      .main-content img {
        width: 100%;
        height: 250px;
      }
      .input-section {
        background-color: #800000;
        color: white;
        padding: 20px;
        text-align: center;
      }
      .input-section h2 {
        margin: 0;
        padding: 10px;
        background-color: white;
        color: #800000;
        display: inline-block;
        border-radius: 5px;
      }
      .form-container {
        background-color: white;
        padding: 20px;
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex-wrap: wrap;
        margin-top: 20px;
        border-radius: 5px;
      }
      .form-container div {
        margin: 10px;
      }
      .form-container input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 200px;
        box-shadow: 3px 3px 5px #000;
      }
      .form-container label {
        display: block;
        margin-bottom: 5px;
        color: #aaa;
      }
      .next-button {
        background-color: #fff;
        color: #800000;
        border: 1px solid #800000;
        padding: 10px 20px;
        cursor: pointer;
        margin-top: 20px;
        border-radius: 5px;
        text-decoration: none; /* Remove underline */
      }
    </style>
  </head>
  <body>
    <div class="header">
      <i class="fas fa-arrow-left" onclick="window.history.back();"></i>
      <h1>
        <i class="fas fa-file-alt"></i> Liceo DocuClaim; An Appointment System
      </h1>
      <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>
    </div>
    <div class="main-content">
      <img
        src="https://scontent.xx.fbcdn.net/v/t1.15752-9/475579872_9525256634159851_6313981871103436028_n.png?_nc_cat=104&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeF8G5G4ZTFm59IhjCz-chb7hrVmGnqLXAiGtWYaeotcCPf6pf30-D0g03OkcOKNQB26J4jsBFf_k90bfiVz-IBm&_nc_ohc=gbtJFbYkIjcQ7kNvgHN15n0&_nc_oc=Adhwzj4QOnh8iLFLKaoG1u8kkjwOx7-SBYzUE5vDtEmu7rXzUp_RLT2gq3q1QCkXWgj6NhdOtPAJlHmhHKDrZXV3&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.xx&oh=03_Q7cD1gELXqL96rtXtE67u8IPJ2g6AlLKNOhSFGZkyD0613czcw&oe=67CB4A1B"
        alt="Image of a building with classical architecture, featuring arched windows and decorative elements."
        height="260"
        width="200%"
      />
    </div>
    <div class="input-section">
      
      <h2>Input Details</h2>
      <form action="S_attachreceipt.php" method="post">
      <div class="form-container">
        <div>
        <label for="student_name">Student Name:</label>
        <input type="text" name="student_name" required>
        </div>
        <div>
        <label for="student_grade_section">Grade & Section:</label>
        <input type="text" name="student_grade_section" required>
        </div>
        <div>
            <label for="student_email">Email:</label>
            <input type="email" name="student_email" required>
          </div>
      </div>
      <button class="next-button" type="submit">Next</button>
    </div>
    </form>
  </body>
</html>
