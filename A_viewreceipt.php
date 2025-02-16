<?php 
include 'db_connect.php';
// Fetch data from the database
$sql = "SELECT id, date, time, student_name, student_grade_section, document_type, file FROM request_details";
$result = $conn->query($sql);
?>
<html>
 <head>
  <title>
   Liceo DocuClaim; An Appointment System
  </title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
   body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }
        .header {
            background-color: #800000;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
        }
        .header .back-button {
            font-size: 32px; /* Increased size */
            cursor: pointer;
        }
        .header .title {
            display: flex;
            align-items: center;
            font-size: 24px;
        }
        .header .title img {
            margin-right: 10px;
            width: 30px; /* Adjust the size as needed */
            height: 30px; /* Adjust the size as needed */
        }
        .header .logout-button {
            background-color: white;
            color: #800000;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }
        .main-content {
            text-align: center;
            padding: 0;
        }
        .main-content img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            margin-bottom: 0;
        }
        .main-content .view-receipts-button {
            background-color: white;
            color: #800000;
            border: 2px solid #800000;
            padding: 10px 20px;
            cursor: pointer;
            margin: 20px 0;
        }
        .table-container {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
        table {
            width: 80%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th {
            background-color: #800000;
            color: white;
            padding: 10px;
        }
        td {
            padding: 10px;
            text-align: center;
        }
        .next-button {
            background-color: #800000; /* Red background */
            color: white; /* White text */
            border: 2px solid #800000;
            padding: 10px 20px;
            cursor: pointer;
            margin: 20px 0;
            width: calc(100% - 40px); /* Expanded sides to reach the end of the frame */
            box-sizing: border-box;
        }
        @media (max-width: 768px) {
            .header .title {
                font-size: 14px;
            }
            .header .logout-button {
                padding: 5px 10px;
            }
            .main-content .view-receipts-button, .next-button {
                padding: 5px 10px;
                width: calc(100% - 20px); /* Adjusted for smaller screens */
            }
            table {
                width: 100%;
            }
        }
  </style>
 </head>
 <body>
  <div class="header">
   <div class="back-button">
    <i class="fas fa-arrow-left">
    </i>
   </div>
   <div class="title">
    <img alt="Random logo" height="30" src="https://scontent.xx.fbcdn.net/v/t1.15752-9/474063385_591134910218394_3073218857154146188_n.png?_nc_cat=104&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeFuWbNIjNF5DciNdnoOaI3_x7hAkRlgb5jHuECRGWBvmCKsvE16JJcRpivn3JwL_4HCNlNyYTbaKkMG-Yd28eFb&_nc_ohc=0Q0sra9zLhgQ7kNvgGSqzjS&_nc_oc=Adgc0zAfgFF1OL4tzQVDAnf3lJo5axUjg7T5Rfdu1e0x1CzahmtwXA9UvARet2CENo13pnVRH6qWWCJi9Eg_YXBe&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.xx&oh=03_Q7cD1gHxUPbZC2O1vE2DlXGfv79J3fiJxvywvuEDkzBpQkNIag&oe=67CAAA22" width="30"/>
    Liceo DocuClaim; An Appointment System
   </div>
   <form action="logout.php" method="post">
        <button class="logout-button" type="submit">Logout</button>
    </form>
  </div>
  <div class="main-content">
   <img alt="Image of a building with architectural details" height="300" src="https://scontent.xx.fbcdn.net/v/t1.15752-9/475579872_9525256634159851_6313981871103436028_n.png?_nc_cat=104&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeF8G5G4ZTFm59IhjCz-chb7hrVmGnqLXAiGtWYaeotcCPf6pf30-D0g03OkcOKNQB26J4jsBFf_k90bfiVz-IBm&_nc_ohc=gbtJFbYkIjcQ7kNvgHN15n0&_nc_oc=Adhwzj4QOnh8iLFLKaoG1u8kkjwOx7-SBYzUE5vDtEmu7rXzUp_RLT2gq3q1QCkXWgj6NhdOtPAJlHmhHKDrZXV3&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.xx&oh=03_Q7cD1gHOOMGk65eJ5hQ8winuWaazCSIMRAL5HhMxZ0b1jNKRag&oe=67CAA15B" style="margin-bottom: 0;" width="1200">
    <div class="header" style="width: 100%; padding: 20px; box-sizing: border-box; justify-content: center;">
     <button class="view-receipts-button">
      View Attached Receipt
     </button>
    </div>
    <div class="table-container">
     <table>
      <thead>
       <tr>
        <th>
         Appointment Number
        </th>
        <th>
         Name of Student
        </th>
        <th>
         Grade 12 Section
        </th>
        <th>
         Receipt File
        </th>
       </tr>
      </thead>
      <tbody>
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $file_path = $row['file']; // Adjust the path if necessary
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['student_name']}</td>
                <td>{$row['student_grade_section']}</td>
                <td>
                    <a href='$file_path' target='_blank' title='View File'>
                        <i class='fas fa-file-alt' style='font-size: 20px; color: #800000;'></i>
                    </a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No appointment requests found.</td></tr>";
}
?>
</tbody>


     </table>
    </div>
    <a href="A_requestconfirmation.php" class="next-button">
     NEXT
    </a>
   </img>
  </div>
 </body>
</html>
