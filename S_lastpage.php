<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Liceo DocuClaim; An Appointment System</title>
    <style>
      body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #f8f8f8;
      }
      .header {
        background-color: #9b1b30;
        color: white;
        padding: 20px;
        text-align: center;
      }
      .content {
        text-align: center;
        margin: 50px 0;
      }
      .message {
        font-size: 24px;
        margin: 20px 0;
      }
      .notification {
        font-size: 16px;
        color: #a8a8a8;
      }
      .button {
        background-color: #9b1b30;
        color: white;
        border: none;
        padding: 10px 20px;
        margin: 10px;
        cursor: pointer;
        text-decoration: none;
        border-radius: 5px;
      }
      .button:hover {
        background-color: #7a1a2a;
      }
    </style>
  </head>
  <body>
    <div class="header">
      <h1>Liceo DocuClaim; An Appointment System</h1>
    </div>
    <div class="content">
      <div class="message">Your appointment has been sent to the system...</div>
      <div class="notification">
        A notification for confirmation will be sent to your gmail.
      </div>
      <div>
        <a href="student_homepage.php" class="button">RETURN TO HOME PAGE</a>
        <a href="S_logout-confirmation.html" class="button">LOG OUT</a>
      </div>
    </div>
  </body>
</html>
