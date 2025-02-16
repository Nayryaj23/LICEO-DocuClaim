<?php 
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';
// Fetch data from the database
$sql = "SELECT id, date, time, student_name, student_grade_section, document_type FROM request_details";
$result = $conn->query($sql);
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
        background-color: #fff;
      }
      .header {
        background-color: #800000;
        color: white;
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
      }
      .header img {
        height: 30px;
        margin-right: 10px;
      }
      .header h1 {
        font-size: 24px;
        margin: 0;
        display: flex;
        align-items: center;
      }
      .header .logout {
        background-color: white;
        color: #800000;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
      }
      .banner {
        width: 100%;
        height: 200px;
        overflow: hidden;
      }
      .banner img {
        width: 100%;
        height: auto;
      }
      .content {
        text-align: center;
        padding: 20px;
        background-color: #800000;
        color: white;
      }
      .content h2 {
        margin: 0;
        font-size: 24px;
        background-color: white;
        color: #800000;
        display: inline-block;
        padding: 10px 20px;
        border-radius: 5px;
      }
      .table-container {
        padding: 20px;
      }
      table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
      }
      table,
      th,
      td {
        border: 1px solid black;
      }
      th,
      td {
        padding: 10px;
        text-align: center;
      }
      th {
        background-color: #800000;
        color: white;
      }
      .next-button {
        background-color: #800000;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        display: block;
        margin: 0 auto;
      }
      .back-button a {
        color: white;
        text-decoration: none;
      }
      @media (max-width: 600px) {
        .header h1 {
          font-size: 18px;
        }
        .header .logout {
          padding: 5px 10px;
          font-size: 14px;
        }
        .content h2 {
          font-size: 18px;
        }
        th,
        td {
          padding: 5px;
          font-size: 12px;
        }
        .next-button {
          padding: 5px 10px;
          font-size: 14px;
        }
      }
    </style>
  </head>
  <body>
    <div class="header">
      <div class="back-button">
        <a href="#">
          <i class="fas fa-arrow-left" style="font-size: 24px; color: white">
          </i>
        </a>
      </div>
      <h1>
        <img
          alt="Random logo"
          height="30"
          src="https://scontent.xx.fbcdn.net/v/t1.15752-9/474063385_591134910218394_3073218857154146188_n.png?_nc_cat=104&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeFuWbNIjNF5DciNdnoOaI3_x7hAkRlgb5jHuECRGWBvmCKsvE16JJcRpivn3JwL_4HCNlNyYTbaKkMG-Yd28eFb&_nc_ohc=0Q0sra9zLhgQ7kNvgGSqzjS&_nc_oc=Adgc0zAfgFF1OL4tzQVDAnf3lJo5axUjg7T5Rfdu1e0x1CzahmtwXA9UvARet2CENo13pnVRH6qWWCJi9Eg_YXBe&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.xx&oh=03_Q7cD1gHxUPbZC2O1vE2DlXGfv79J3fiJxvywvuEDkzBpQkNIag&oe=67CAAA22"
          width="30"
        />
        Liceo DocuClaim; An Appointment System
      </h1>
      <form action="logout.php" method="post">
        <button class="logout" type="submit">Logout</button>
    </form>
    </div>
    <div class="banner">
      <img
        alt="Banner image of a building with architectural details"
        height="200"
        src="https://scontent.xx.fbcdn.net/v/t1.15752-9/475579872_9525256634159851_6313981871103436028_n.png?_nc_cat=104&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeF8G5G4ZTFm59IhjCz-chb7hrVmGnqLXAiGtWYaeotcCPf6pf30-D0g03OkcOKNQB26J4jsBFf_k90bfiVz-IBm&_nc_ohc=gbtJFbYkIjcQ7kNvgHN15n0&_nc_oc=Adhwzj4QOnh8iLFLKaoG1u8kkjwOx7-SBYzUE5vDtEmu7rXzUp_RLT2gq3q1QCkXWgj6NhdOtPAJlHmhHKDrZXV3&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.xx&oh=03_Q7cD1gHOOMGk65eJ5hQ8winuWaazCSIMRAL5HhMxZ0b1jNKRag&oe=67CAA15B"
        width="1200"
      />
    </div>
    <div class="content">
      <h2 style="">Appointment Requests</h2>
    </div>
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Appointment Number</th>
            <th>Requested Date</th>
            <th>Requested Time</th>
            <th>Name of Student</th>
            <th>Grade 12 Section</th>
            <th>Requested Document</th>
          </tr>
        </thead>
        <tbody>
        <?php
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                          <td>{$row['id']}</td>
                          <td>{$row['date']}</td>
                          <td>" . date("h:i A", strtotime($row['time'])) . "</td>
                          <td>{$row['student_name']}</td>
                          <td>{$row['student_grade_section']}</td>
                          <td>{$row['document_type']}</td>
                        </tr>";
              }
          } else {
              echo "<tr><td colspan='6'>No appointment requests found.</td></tr>";
          }
          ?>
        </tbody>
      </table>
      <button class="next-button" onclick="location.href='A_viewreceipt.php'">
        NEXT
      </button>
    </div>
  </body>
</html>
