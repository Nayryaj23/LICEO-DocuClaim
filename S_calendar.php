<?php
session_start();

// Redirect if not a student
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

// Handle file upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['receipt'])) {
    $file = $_FILES['receipt'];
    $uploadDir = "uploads/";
    $filePath = $uploadDir . basename($file["name"]);

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (move_uploaded_file($file["tmp_name"], $filePath)) {
        $_SESSION['receipt_path'] = $filePath;
    } else {
        echo "Error uploading file.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Date & Time</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .header {
            background-color: #9b1b30;
            color: white;
            padding: 20px;
            text-align: center;
            position: relative;
        }

        .logout-button {
            background-color: white;
            color: #9b1b30;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            position: absolute;
            right: 20px;
            top: 20px;
        }

        .logout-button:hover {
            background-color: #f2f2f2;
        }

        .main {
            text-align: center;
            margin-top: 50px;
        }

        .calendar-button {
            background: none;
            border: none;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .calendar-button img {
            width: 60px;
            height: auto;
        }

        .calendar-button:hover {
            transform: scale(1.1);
        }

        .form-container {
            margin-top: 20px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
        }

        .form-container label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        .form-container input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .done-button {
            background-color: #9b1b30;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .done-button:hover {
            background-color: #7a1423;
        }
        .calendar-img {
            width: 60px;
            height: auto;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Liceo DocuClaim - Appointment System</h1>
        <form action="logout.php" method="post">
        <button class="logout-button" type="submit">Logout</button>
    </form>
    </div>

    <div class="main">
        <h2>Select Date & Time</h2>
        
        <img src="calendar.png" alt="Calendar Icon" class="calendar-img">

        <div class="form-container">
            <form action="process_request.php" method="post">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>

                <label for="time">Time:</label>
                <input type="time" id="time" name="time" required>

                <button type="submit" class="done-button">Submit</button>
            </form>
        </div>
    </div>

</body>
</html>
