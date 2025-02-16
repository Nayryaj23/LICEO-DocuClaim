<?php
session_start();
include 'db_connect.php'; // Ensure this file contains the database connection

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $stmt = $conn->prepare("SELECT id, id_number, firstname, lastname, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['id_number'] = $user['id_number'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['role'] = $user['role'];
            
            if ($user['role'] === 'admin') {
                header("Location: admin_homepage.php");
                exit();
            } else {
                header("Location: student_homepage.php");
                exit();
            }
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password.";
    }
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
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f5f5f5;
      }
      .header {
        background-color: #800000;
        color: white;
        padding: 10px;
        text-align: center;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
      }
      .header img {
        vertical-align: middle;
        margin-right: 10px;
      }
      .header h1 {
        display: inline;
        font-size: 24px;
      }
      .header p {
        margin: 0;
        font-size: 14px;
      }
      .header .logo {
        position: absolute;
        right: 10px;
        top: 10px;
      }
      .login-container {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
        text-align: center;
        margin-top: 100px;
      }
      .login-container h2 {
        margin: 0 0 20px;
        font-size: 24px;
        font-weight: bold;
      }
      .login-container label {
        display: block;
        text-align: left;
        margin-bottom: 5px;
        font-size: 14px;
      }
      .login-container input[type="email"],
      .login-container input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
      }
      .login-container button {
        width: 100%;
        padding: 10px;
        background-color: #800000;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
      }
      .login-container button:hover {
        background-color: #660000;
      }
      .login-container a {
        color: #800000;
        text-decoration: none;
        font-size: 14px;
      }
      .login-container a:hover {
        text-decoration: underline;
      }
      .login-container .register {
        color: #ff0000;
      }
    </style>
  </head>
  <body>
    <div class="header">
      <img
        alt="Logo"
        height="50"
        src="https://scontent.xx.fbcdn.net/v/t1.15752-9/474063385_591134910218394_3073218857154146188_n.png?_nc_cat=104&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeFuWbNIjNF5DciNdnoOaI3_x7hAkRlgb5jHuECRGWBvmCKsvE16JJcRpivn3JwL_4HCNlNyYTbaKkMG-Yd28eFb&_nc_ohc=GKFXsbmg5KYQ7kNvgHh56g-&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.xx&oh=03_Q7cD1gEw5GoFarwnVBa5A7GKYHP_jkjMeHSHRMRsiyeDrFPaVQ&oe=67C56422"
        width="50"
      />
      <h1>Liceo DocuClaim; An Appointment System</h1>
      <p>Serving you a quality service.</p>
      <img
        alt="School Logo"
        class="logo"
        height="50"
        src="https://www.liceo.edu.ph/images/ico-liceo-big.png"
        width="50"
      />
    </div>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form action="" method="post">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Log in</button>
        </form>
        <a href="forgot_password.php">Forgot password?</a>
        <p>Don't have an account? <a class="register" href="register.php">Register</a></p>
    </div>
  </body>
</html>
