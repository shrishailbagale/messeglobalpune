<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
  
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $newpassword = md5($_POST['newpassword']);

    // Generate and store OTP in session
    $otp = mt_rand(100000, 999999);
    $_SESSION['otp'] = $otp;

    $mail = new PHPMailer(true);

    try {
        // Server settings
        
        $mail->SMTPDebug = SMTP::DEBUG_OFF; // Enable verbose debug output
        $mail->isSMTP();
        $mail->Host = 'webmail.copodigital.com'; // Replace with your SMTP server
        $mail->SMTPAuth = true;
       
        $mail->Username = 'info@copodigital.com'; // Replace with your email address
        $mail->Password = 'Password@copodigital.com'; // Replace with your email password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port = 25; // TCP port to connect to

        // Recipients
        $mail->setFrom('info@copodigital.com', 'Shrishail Bagale'); // Replace with your name and email
        $mail->addAddress($email); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Password Reset OTP';
        $mail->Body    = "Your OTP for password reset is: " . $otp;

        $mail->send();
        echo "<script>alert('OTP sent to your registered email.');</script>";
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
    }
}

if (isset($_POST['verifyOTP'])) {
    $userOTP = $_POST['otp'];
    if ($userOTP == $_SESSION['otp']) {
        // OTP is verified, now update the password
        $con = "update tbladmin set Password=:newpassword where Email=:email and MobileNumber=:mobile";
        $chngpwd1 = $dbh->prepare($con);
        $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
        $chngpwd1->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $chngpwd1->bindParam(':newpassword', md5($newpassword), PDO::PARAM_STR);
        $chngpwd1->execute();
        echo "<script>alert('Your Password successfully changed');</script>";
    } else {
        echo "<script>alert('Invalid OTP');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #logo {
            display: block;
            margin: 0 auto 20px; /* Center the logo and add some spacing */
        }

        h2{
          text-align: center;
          font-size: 25px;
          font-weight: 600;
          margin: 0 0 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        #loginButton {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px; /* Add some space between the buttons */
        }

        #loginButton:hover {
            background-color: #2980b9;
        }

        #haveAccount {
            text-align: center;
            margin-top: 10px; /* Add some space above the link */
        }

        #haveAccount a {
            color: #3498db;
            text-decoration: none;
            cursor: pointer;
        }

        #haveAccount a:hover {
            text-decoration: underline;
        }

        
      

    </style>
    <title>Forget Password</title>
</head>
<body>
    <div class="container">
        <img src="assets/images/logo.png" alt="Logo" id="logo" width="100">
        <h2>Forget Password</h2>
        <form id="forgetPasswordForm" method="post" name="chngpwd" onSubmit="return valid();">
            <label for="email">Register Email Id:</label>
            <input type="email" id="email" name="email" required>

            <label for="mobile">Register Mobile Number:</label>
            <input type="tel" id="mobile" name="mobile" required>

            <label for="password">New Password:</label>
            <input type="password" id="password" name="newpassword" required>

            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" name="confirmpassword" id="confirmPassword" required>

            <button name="submit" type="submit" onclick="return sendOTP()">Send OTP</button>
            <!-- New button for redirecting to the login page -->
            
        </form>
         
        
        <!-- OTP verification section -->
        <div id="otpSection">
            <form id="otpVerificationForm" method="post" action="">
                <label for="otp">Enter OTP:</label>
                <input type="text" id="otp" name="otp" required>
                <button name="verifyOTP" type="submit">Verify OTP</button>
            </form>
        </div>

        <!-- "I have an account" link -->
        <div id="haveAccount">
            <p>Already have an account? <a onclick="redirectToLoginPage()">Login here</a></p>
        </div>
    </div>

    <script>
    function sendOTP() {
        var email = document.getElementById("email").value;
        var mobile = document.getElementById("mobile").value;
        var newPassword = document.getElementById("password").value;

        // Validate email, mobile, and password if needed

        // Make an AJAX request to send OTP
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "send_otp.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert(xhr.responseText);
                if (xhr.responseText.includes("OTP sent")) {
                    // If OTP is sent successfully, show the OTP section
                    document.getElementById("forgetPasswordForm").style.display = "none";
                    document.getElementById("otpSection").style.display = "block";
                }
            }
        };
        xhr.send("email=" + email + "&mobile=" + mobile + "&newpassword=" + newPassword);
        
        return false; // Prevent form submission
    }

    function verifyOTP() {
        var userOTP = document.getElementById("otp").value;

        // Validate that OTP is a 6-digit number
        if (!/^\d{6}$/.test(userOTP)) {
            alert("Please enter a valid 6-digit OTP.");
            return;
        }

        // You can add additional client-side validation here if needed

        // Submit the form for OTP verification
        document.getElementById("otpVerificationForm").submit();
    }

    function redirectToLoginPage() {
        window.location.href = "index.php"; // Replace with the actual login page URL
    }
</script>




</body>
</html>
