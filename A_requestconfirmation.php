<?php
include 'db_connect.php';

$sql = "SELECT * FROM request_details";
$result = $conn->query($sql);
?>
<html>
  <head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> <!-- Add jQuery -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />
  </head>
 
  <body class="bg-white">
    <div class="bg-red-800 text-white p-4 flex items-center justify-between">
      <div class="flex items-center">
        <i class="fas fa-arrow-left text-2xl"> </i>
      </div>
      <div class="flex items-center">
        <img
          alt="Random logo"
          class="h-12 w-12 mr-2"
          height="48"
          src="https://scontent.xx.fbcdn.net/v/t1.15752-9/474063385_591134910218394_3073218857154146188_n.png?_nc_cat=104&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeFI1VZIfTJtLH3oc3SKwjXSx7hAkRlgb5jHuECRGWBvmOko-iuYiIg6aS4emRoJC85fjNQjB16J7q4QgRc_DJeJ&_nc_ohc=Iq2TQIhteukQ7kNvgFEuvO4&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.xx&oh=03_Q7cD1gHJPkgP9looLpkmcvEkESqzaWhTLgeyxhs159G9lfYgEw&oe=67C990E2"
          width="48"
        />
        <h1 class="text-2xl font-bold">
          Liceo DocuClaim; An Appointment System
        </h1>
      </div>
      <form action="logout.php" method="post">
        <button class="bg-white text-red-800 font-bold py-2 px-4 rounded" type="submit">Logout</button>
    </form>
    </div>
    <div class="relative">
      <img
        alt="Image of a school building"
        class="w-full h-48 object-cover"
        height="300"
        src="https://scontent.xx.fbcdn.net/v/t1.15752-9/475579872_9525256634159851_6313981871103436028_n.png?_nc_cat=104&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeGZG2Zga3dd34wM93q06BeFhrVmGnqLXAiGtWYaeotcCNPZh1vE7HqZXIgw4gNFf73z-5g5CFHJlCIfKA9lzzSc&_nc_ohc=gbtJFbYkIjcQ7kNvgFr_HXK&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.xx&oh=03_Q7cD1gGPFlhFcRLmDKnqW33wcov37Sn42ytWeShNqww6laPSfQ&oe=67C9C05B"
        width="1920"
      />
      <div class="absolute inset-0 bg-red-800 opacity-50"></div>
    </div>
    <div class="text-center my-4">
      <button
        class="bg-white text-black font-bold py-2 px-4 border-2 border-black rounded"
      >
        Request Confirmation
      </button>
    </div>
    <div class="mx-4">
      <table class="w-full border-collapse border border-black">
        <thead>
          <tr class="bg-red-800 text-white">
            <th class="border border-black p-2">Appointment Number</th>
            <th class="border border-black p-2">Name of Student</th>
            <th class="border border-black p-2">Grade 12 Section</th>
            <th class="border border-black p-2">
              An email of confirmation will be sent to the student for valid
              requests.
            </th>
            <th class="border border-black p-2">
              An email of refusal will be sent to the student for invalid
              requests.
            </th>
          </tr>
        </thead>
        <tbody>
  <?php
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $status = $row['status'];
          $valid_class = ($status == 'valid') ? "bg-green-700 border-2 border-green-900 text-white" : "bg-green-500";
          $invalid_class = ($status == 'invalid') ? "bg-red-700 border-2 border-red-900 text-white" : "bg-red-500";
          $disabled_class = ($status == 'valid' || $status == 'invalid') ? "disabled" : "";
          $gray_class = ($status == 'valid' || $status == 'invalid') ? "bg-gray-500 text-white" : ""; // Make other button gray

          echo "<tr>
                  <td class='border border-black p-2'>{$row['id']}</td>
                <td class='border border-black p-2'>{$row['student_name']}</td>
                <td class='border border-black p-2'>{$row['student_grade_section']}</td>
                  <td class='border border-black p-2 text-center'>
                      <button class='update-status py-1 px-2 rounded $valid_class' 
                          data-id='{$row['id']}' data-status='valid' $disabled_class>
                          " . ($status == 'valid' ? "VALID" : "REQUEST VALID") . "
                      </button>
                  </td>
                  <td class='border border-black p-2 text-center'>
                      <button class='update-status py-1 px-2 rounded $invalid_class $gray_class' 
                          data-id='{$row['id']}' data-status='invalid' $disabled_class>
                          " . ($status == 'invalid' ? "INVALID" : "REQUEST INVALID") . "
                      </button>
                  </td>
              </tr>";
      }
  } else {
      echo "<tr><td colspan='5' class='text-center'>No appointment requests found.</td></tr>";
  }
  ?>
</tbody>

      </table>

      <script>
$(document).ready(function () {
    $(".update-status").click(function () {
        var button = $(this); // Store button reference
        var id = button.data("id");
        var status = button.data("status");

        $.ajax({
            url: "update_status.php",
            type: "POST",
            data: { id: id, status: status },
            success: function (response) {
                console.log(response); // Debugging
                if (response.trim() === "success") {
                    alert("Request status updated successfully!");

                    // Get the row containing the clicked button
                    var row = button.closest("tr");

                    // Disable all buttons in the row
                    row.find(".update-status").prop("disabled", true);

                    // Highlight the clicked button
                    button.text(status.toUpperCase())
                          .removeClass("bg-green-500 bg-red-500")
                          .addClass(status === "valid" ? "bg-green-700 border-2 border-green-900" : "bg-red-700 border-2 border-red-900");

                    // Make the other button gray
                    row.find(".update-status").not(button)
                        .removeClass("bg-green-500 bg-red-500")
                        .addClass("bg-gray-500 text-white");
                } else {
                    alert("Failed to update request status.");
                }
            },
            error: function () {
                alert("AJAX request failed.");
            }
        });
    });
});



</script>

    </div>
    <div class="text-center my-4">
      <a
        href="admin_homepage.php"
        class="bg-red-800 text-white font-bold py-2 px-4 rounded"
      >
        RETURN TO HOME PAGE
      </a>
    </div>

  

  </body>
</html>
