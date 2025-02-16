<?php
session_start();
include "db_connect.php"; // Ensure you have a valid database connection

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure session variables are set
    if (!isset($_SESSION['document_type'], $_SESSION['student_name'], $_SESSION['student_grade_section'] )) {
        echo "<h2>Error: Missing required session data.</h2>";
        exit();
    }

    if (!isset($_SESSION['receipt_path'])) {
        echo "Error: No receipt uploaded.";
        exit();
    }

    $document_type = $_SESSION['document_type'];
    $student_name = $_SESSION['student_name'];
    $student_grade_section = $_SESSION['student_grade_section'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $receipt_path = $_SESSION['receipt_path'];
    $student_email = $_SESSION['student_email'];

    // Handle file upload if needed
    // if (!empty($_FILES['file']['name'])) {
    //     $file_name = basename($_FILES["file"]["name"]);
    //     $file_tmp = $_FILES["file"]["tmp_name"];
    //     $file_dest = "uploads/" . $file_name;
    
    //     if (move_uploaded_file($file_tmp, $file_dest)) {
    //         $file = $file_dest; // Store file path
    //     } else {
    //         echo "<h2>Error uploading file.</h2>";
    //         exit();
    //     }
    // } else {
    //     $file = ""; // Set to empty string instead of NULL
    // }
    
    $query = "INSERT INTO request_details (document_type, student_name, student_grade_section, student_email, file, date, time) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssss", $document_type, $student_name, $student_grade_section, $student_email, $receipt_path, $date, $time);
    
    if ($stmt->execute()) {
        $file_path = 'S_lastpage.php';

// Include the file to execute its content
        include $file_path;
    } else {
        echo "<h2>Error submitting request: " . $stmt->error . "</h2>";
    }
    

    $stmt->close();
    $conn->close();
}

?>
