<?php
ob_start(); // Start output buffering
include 'db_connect.php';



// Include PHPMailer for sending emails
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/autoload.php';

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = intval($_POST['id']); // Ensure it's an integer
    $status = $_POST['status'];

    // Fetch student email & name from database
    $query = "SELECT student_email, student_name FROM request_details WHERE id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($email, $student_name);
        $stmt->fetch();
        $stmt->close();
    } else {
        echo "error: " . $conn->error;
        exit;
    }

    // Update request status in database
    $sql = "UPDATE request_details SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("si", $status, $id);
        if ($stmt->execute()) {
            echo "success";

            // Prepare email notification
            $subject = "Document Request Status Update";
            $message = "Dear $student_name,<br><br>";
            if ($status == 'valid') {
                $message .= "Your document request has been <strong>approved</strong>. You may proceed with the next steps.<br><br>";
            } else {
                $message .= "Unfortunately, your document request has been <strong>rejected</strong>. Please check with the administration for further details.<br><br>";
            }
            $message .= "Best regards,<br>Liceo DocuClaim Team";

            // Send email using PHPMailer
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'betatest775@gmail.com'; // Your SMTP username
                $mail->Password = 'qjwt ttem syfo euzu'; // Your SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('betatest775@gmail.com', 'Liceo DocuClaim');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $message;

                if ($mail->send()) {
                    echo " | Email sent successfully";
                } else {
                    echo " | Failed to send email";
                }
            } catch (Exception $e) {
                echo " | Email error: " . $mail->ErrorInfo;
            }
        } else {
            echo "error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "error: " . $conn->error;
    }
    $conn->close();
} else {
    echo "error: Missing parameters";
}

ob_end_clean(); // Clear any extra output
echo "success";
exit;

?>
