<?php
require "Mail/phpmailer/PHPMailerAutoload.php";

include 'connection.php'; // Include your database connection

session_start(); // Start the session

// Error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['send_otp'])) {
        // Generate OTP and token
        $email = $_POST["email"];

        // Check if the email exists in the users table
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) == 1) {
            // Email exists in the users table, proceed with OTP generation
            $otp = generateOTP();
            $token = generateToken();

            // Check if the email exists in the password_resets table
            $check_query = "SELECT * FROM password_resets WHERE email = '$email'";
            $check_result = mysqli_query($conn, $check_query);

            if ($check_result && mysqli_num_rows($check_result) == 1) {
                // Email exists in the password_resets table, update the OTP and token
                $update_query = "UPDATE password_resets SET otp = '$otp', token = '$token' WHERE email = '$email'";
            } else {
                // Email does not exist in the password_resets table, insert a new record
                $insert_query = "INSERT INTO password_resets (email, otp, token) VALUES ('$email', '$otp', '$token')";
                mysqli_query($conn, $insert_query);
            }

            // Check if the query was successful
            if (mysqli_affected_rows($conn) > 0) {
                // Store the email, OTP, and token in session
                $_SESSION['email'] = $email;
                $_SESSION['otp'] = $otp;
                $_SESSION['token'] = $token;

                // Compose the email message using PHPMailer
                $mail = new PHPMailer(true);
                try {
                    //Server settings
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'vdurga400@gmail.com'; // Replace with your Gmail email
                    $mail->Password = 'ketnkqifzbrrpsbv'; // Replace with your Gmail password
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    //Recipients
                    $mail->setFrom('vdurga400@gmail.com', 'CHINTHA VIJAYA DURGA'); // Replace with your email and name
                    $mail->addAddress($email); // Add recipient

                    //Content
                    $mail->isHTML(true);
                    $mail->Subject = 'OTP Verification';
                    $mail->Body = "Your OTP for password reset is: $otp.";

                    $mail->send();
                    echo "<script>alert('OTP sent successfully.');</script>";
                    // Redirect the user to verify_otp.php
                    echo "<script>window.location.href = 'verify_otp.php';</script>";
                    exit();
                } catch (Exception $e) {
                    echo "<script>alert('Failed to send OTP. Please try again.');</script>";
                    // Log the error
                    error_log("Failed to send OTP email: " . $mail->ErrorInfo);
                }
            } else {
                echo "<script>alert('Failed to generate OTP. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Email not found. Please enter a valid email.');</script>";
        }
    }
}

// Function to generate OTP
function generateOTP() {
    return mt_rand(100000, 999999);
}

// Function to generate random token
function generateToken() {
    return bin2hex(random_bytes(16)); // Generates a 32-character hexadecimal token
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style1.css">
    <title>Forgot Password</title>
    <style>
        #logo {
            width: 110px;
            height: 120px;
        }
        .password-content {
            margin: 50px auto;
            text-align: center;
            color: #fff;
            width: 350px;
            height:340px;
            padding: 25px;
            border-radius: 25px;
            background-color: rgba(240, 240, 240, 0.262);
        }
        .password-content h1,h2 {
            font-size: 38px;
            margin-bottom: 18px;
            font-family: cursive;
            color: #241756;
        }
        .password-content input[type="email"],
        .password-content input[type="text"],
        .password-content input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 30px;
            border: 1px solid #ccc;
            box-sizing:border-radius:30px;
        }
        .submit-btn {
            width: 130px;
            height: 40px;
            color:#fff;
            font-size: 16px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            background: rgba(255, 255, 255, 0.4);
        }
        .submit-btn:hover {
            background-color: #49c14f;
        }
        .nav-menu ul {
            display: flex;
            margin-left: -128px;
        }
    </style>
</head>
<body>
<nav class="nav">
    <div class="nav-logo">
        <img src="Sritlogo.png" alt="srit logo" id="logo" align="left">
    </div>
    <div class="nav-menu" id="navMenu">
        <ul>
            <li><a href="index1.php" class="link">Home</a></li>
            <li><a href="#" class="link">Forgot Password</a></li>
        </ul>
    </div>
    <div class="nav-menu-btn">
        <i class="menu" onclick="myMenuFunction()"></i>
    </div>
</nav>
<div class="wrapper">
    <!-- Password content -->
    <div class="password-content">
        <h1>Forgot Password</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="email">Enter your email:</label><br><br>
            <input type="email" id="email" name="email" placeholder="Your Email" required><br><br>
            <input type="submit" name="send_otp" value="Send OTP" class="submit-btn">
        </form>
    </div>
</div>
<script>
    function myMenuFunction() {
        var i = document.getElementById("navMenu");
        if (i.className === "nav-menu") {
            i.className += " responsive";
        } else {
            i.className = "nav-menu";
        }
    }
</script>
</body>
</html>
