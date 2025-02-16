<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Liceo DocuClaim; An Appointment System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            text-align: center;
        }
        .header {
            background-color: #7b0d1e;
            color: white;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .header img {
            height: 50px;
        }
        .header .back-button {
            font-size: 24px;
            color: white;
            margin-left: 10px;
        }
        .header .title {
            display: flex;
            align-items: center;
            font-size: 18px;
        }
        .header .title img {
            margin-right: 10px;
            height: 50px;
            width: 50px;
        }
        .logout-container {
            margin-top: 100px;
        }
        .logout-box {
            background-color: #7b0d1e;
            color: white;
            padding: 20px;
            border-radius: 20px;
            display: inline-block;
            width: 300px;
        }
        .logout-box p {
            font-size: 18px;
            margin: 0 0 20px 0;
        }
        .logout-box button {
            background-color: white;
            color: black;
            border: none;
            padding: 10px 20px;
            margin: 10px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 16px;
        }
        .logout-box button:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="header">
        <i class="fas fa-arrow-left back-button"> </i>
        <div class="title">
            <img alt="Random logo" src="https://scontent.xx.fbcdn.net/v/t1.15752-9/474063385_591134910218394_3073218857154146188_n.png?_nc_cat=104&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeFI1VZIfTJtLH3oc3SKwjXSx7hAkRlgb5jHuECRGWBvmOko-iuYiIg6aS4emRoJC85fjNQjB16J7q4QgRc_DJeJ&_nc_ohc=S9-cDQXqEnUQ7kNvgFLF09B&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.xx&oh=03_Q7cD1gGAHnOwYWPPgImJFwSzonN9qFzxj8k7siOsb3IteEkMGw&oe=67C05662" />
            Liceo DocuClaim; An Appointment System
        </div>
        <img alt="Liceo University logo" src="https://upload.wikimedia.org/wikipedia/en/1/18/Ldcu_seal.png" />
    </div>
    <div class="logout-container">
        <div class="logout-box">
            <p>You have been logged out.</p>
            <button onclick="location.href='login.php'">Go to Login</button>
        </div>
    </div>
</body>
</html>
