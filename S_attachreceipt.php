<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['student_name'] = $_POST['student_name'];
    $_SESSION['student_grade_section'] = $_POST['student_grade_section'];
    $_SESSION['student_email'] = $_POST['student_email'];
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
      }
      .header,
      .footer {
        background-color: #800000;
        color: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 20px;
      }
      .header i,
      .footer i {
        font-size: 24px;
      }
      .header h1,
      .footer h1 {
        font-size: 20px;
        margin: 0;
        display: flex;
        align-items: center;
      }
      .header h1 i {
        margin-right: 10px;
      }
      .header a,
      .footer a {
        background-color: white;
        color: #800000;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        text-decoration: none;
      }
      .main-content {
        text-align: center;
        padding: 0px;
      }
      .main-content img {
        width: 100%;
        height: auto;
        max-height: 200px;
        object-fit: cover;
        object-position: center;
      }
      .main-content .attach-button {
        background-color: white;
        color: #800000;
        border: 2px solid #800000;
        padding: 10px 20px;
        font-size: 18px;
        margin: 20px 0;
        cursor: pointer;
      }
      .main-content p {
        font-size: 18px;
        margin: 20px 0;
      }
      .upload-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 60px 0;
      }
      .upload-section button {
        background-color: transparent;
        color: black;
        border: none;
        padding: 50px 100px;
        font-size: 32px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .upload-section button img {
        margin-right: 10px;
        width: 100px;
        height: 100px;
        pointer-events: none;
      }
      .next-button {
        margin-top: 60px;
        background-color: #800000;
        color: white;
        border: none;
        padding: 15px 30px;
        font-size: 20px;
        cursor: pointer;
      }
      
    </style>
  </head>
  <body>
    <div class="header">
      <i class="fas fa-arrow-left"> </i>
      <h1>
        <i class="fas fa-file-alt"> </i>
        Liceo DocuClaim; An Appointment System
      </h1>
      <form action="logout.php" method="post">
        <button class="logout-button" type="submit">Logout</button>
    </form>
    </div>

    <div class="main-content">
      <img
        alt="Image of a building with arched windows and trees in the background"
        src="https://scontent.xx.fbcdn.net/v/t1.15752-9/475579872_9525256634159851_6313981871103436028_n.png?_nc_cat=104&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeF8G5G4ZTFm59IhjCz-chb7hrVmGnqLXAiGtWYaeotcCPf6pf30-D0g03OkcOKNQB26J4jsBFf_k90bfiVz-IBm&_nc_ohc=gbtJFbYkIjcQ7kNvgHN15n0&_nc_oc=Adhwzj4QOnh8iLFLKaoG1u8kkjwOx7-SBYzUE5vDtEmu7rXzUp_RLT2gq3q1QCkXWgj6NhdOtPAJlHmhHKDrZXV3&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.xx&oh=03_Q7cD1gELXqL96rtXtE67u8IPJ2g6AlLKNOhSFGZkyD0613czcw&oe=67CB4A1B"
        style="object-fit: cover; object-position: center; max-height: 200px; width: 100%;"
      />

      <button class="attach-button">Attach Payment Receipt</button>

      <p>
        To proceed with the appointment, all payment requirements must be settled first.
        Please attach the payment receipt below once completed.
      </p>

      <div class="upload-section">
        <form action="S_calendar.php" method="post" enctype="multipart/form-data">
          <label>
            <input type="file" name="receipt" required style="display: none" />
            <button type="button" onclick="document.querySelector('input[name=receipt]').click();">
              <img
                alt="Paper clip icon"
                height="100"
                src="https://static.vecteezy.com/system/resources/previews/009/463/329/non_2x/paper-clip-black-and-white-icon-design-element-on-isolated-white-background-free-vector.jpg"
                width="100"
              />
              + Upload file
            </button>
          </label>
          <br>
          <button type="submit" class="next-button">Next</button>
        </form>
      </div>
    </div>

    <div class="footer">
      <h1></h1>
    </div>
  </body>
</html>
