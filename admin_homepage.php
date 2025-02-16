<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>
<html>
<head>
    <title>Liceo DocuClaim; An Appointment System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: white;
        }
        .header {
            background-color: #800000;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header .title {
            display: flex;
            align-items: center;
            margin: 0 auto; /* Center the title */
            font-size: 24px; /* Increased font size */
        }
        .header .title i {
            margin-right: 10px;
            font-size: 30px; /* Increased icon size */
        }
        .header .logout {
            background-color: white;
            color: #800000;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
        .main-image {
            width: 100%;
            height: auto;
            max-height: 250px; /* Adjusted height */
            object-fit: cover;
        }
        .content {
            background-color: #800000;
            text-align: center;
            padding: 50px 0;
            display: flex;
            justify-content: center;
            align-items: center; /* Adjusted alignment */
            height: 300px; /* Adjusted height */
            position: relative;
        }
        .content .white-box {
            background-color: white;
            padding: 20px;
            border: 2px solid black;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 100%; /* Adjusted width */
            height: 200px; /* Adjusted height */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .content .button {
            background-color: white; /* Removed yellow background */
            color: black;
            padding: 10px 20px; /* Adjusted padding */
            border: 2px solid black;
            text-decoration: none;
            font-size: 18px; /* Adjusted font size */
            font-weight: bold; /* Highlighted font weight */
        }
        .red-line {
            background-color: #800000;
            height: 5px;
            width: 100%;
        }
    </style>
</head>
<body style="background-color: #800000;">
    <div class="header">
        <div class="title">
            <i class="fas fa-file-alt"></i>
            <span>Liceo DocuClaim; An Appointment System</span>
        </div>
        <form action="logout.php" method="post">
        <button class="logout" type="submit">Logout</button>
    </form>
    </div>
    <img alt="Image of a historical building with arched windows and detailed architecture" class="main-image" src="https://storage.googleapis.com/a1aa/image/xewnkKcIwwIVAjPpZ-t1WeztIBnGRiQlUXXydyARwR4.jpg"/>
    <div class="red-line"></div>
    <div class="content">
        <div class="white-box">
            <a class="button" href="A_requestors.php">View Appointments</a>
        </div>
    </div>
</body>
</html>
