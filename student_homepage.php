<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
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
        background-color: #800000;
        color: white;
      }
      .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 20px;
        background-color: #800000;
      }
      .header a {
        color: white;
        text-decoration: none;
      }
      .header i {
        font-size: 30px; /* Increased font size */
      }
      .header h1 {
        font-size: 32px; /* Increased font size */
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center; /* Center the content */
        flex: 1; /* Allow the h1 to take up available space */
      }
      .header h1 img {
        margin-right: 10px;
        width: 60px; /* Increased width */
        height: 60px; /* Increased height */
      }
      .header button {
        background-color: white; /* Changed background color to white */
        color: #800000; /* Changed text color to match the background */
        border: 2px solid white;
        padding: 5px 10px;
        cursor: pointer;
      }
      .main-content {
        text-align: center;
        padding: 20px;
      }
      .main-content img {
        width: calc(100% + 40px); /* Adjusting width to touch the sides */
        height: 200px;
        object-fit: cover;
        margin: 0 -20px; /* Adjusting margin to touch the sides */
      }
      .main-content h2 {
        background-color: white;
        color: #800000;
        display: inline-block;
        padding: 10px 20px;
        margin: 20px 0;
      }
      .document-buttons {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        margin: 0 -20px; /* Adjusting margin to touch the sides */
      }
      .document-buttons a {
        text-decoration: none;
      }
      .document-buttons button {
        background-color: #800000;
        color: white;
        border: 2px solid white;
        padding: 20px 30px; /* Increased padding */
        margin: 10px;
        cursor: pointer;
        flex: 1 1 200px;
        max-width: 200px;
        font-size: 18px; /* Increased font size */
      }
    </style>
  </head>
  <body>
    <div class="header">
      <a href="#"><i class="fas fa-arrow-left"></i></a>
      <h1>
        <img
          alt="Random logo"
          height="60"
          src="https://scontent.xx.fbcdn.net/v/t1.15752-9/474063385_591134910218394_3073218857154146188_n.png?_nc_cat=104&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeFuWbNIjNF5DciNdnoOaI3_x7hAkRlgb5jHuECRGWBvmCKsvE16JJcRpivn3JwL_4HCNlNyYTbaKkMG-Yd28eFb&_nc_ohc=GKFXsbmg5KYQ7kNvgHh56g-&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.xx&oh=03_Q7cD1gEw5GoFarwnVBa5A7GKYHP_jkjMeHSHRMRsiyeDrFPaVQ&oe=67C56422"
          width="60"
        />
        Liceo DocuClaim; An Appointment System
      </h1>
      <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>
    </div>
    <div class="main-content">
      <img
        alt="Image of a historical building with arches and columns"
        src="https://scontent.xx.fbcdn.net/v/t1.15752-9/475579872_9525256634159851_6313981871103436028_n.png?_nc_cat=104&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeF8G5G4ZTFm59IhjCz-chb7hrVmGnqLXAiGtWYaeotcCPf6pf30-D0g03OkcOKNQB26J4jsBFf_k90bfiVz-IBm&_nc_ohc=gbtJFbYkIjcQ7kNvgHN15n0&_nc_oc=Adhwzj4QOnh8iLFLKaoG1u8kkjwOx7-SBYzUE5vDtEmu7rXzUp_RLT2gq3q1QCkXWgj6NhdOtPAJlHmhHKDrZXV3&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.xx&oh=03_Q7cD1gELXqL96rtXtE67u8IPJ2g6AlLKNOhSFGZkyD0613czcw&oe=67CB4A1B"
      />
      <h2>Choose your document</h2>
      <div class="document-buttons">
      <a href="requestdetails.php?document_type=Graduation Picture"><button>Graduation Picture</button></a>
      <a href="requestdetails.php?document_type=Grade Report Card"><button>Grade Report Card</button></a>
      <a href="requestdetails.php?document_type=Good Moral Certificate"><button>Good Moral Certificate</button></a>
      <a href="requestdetails.php?document_type=Passage of Excellence"><button>Passage of Excellence</button></a>
      </div>
    </div>
  </body>
</html>
