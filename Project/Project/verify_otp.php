<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['otp'])) {
    echo "<script>alert('Session expired. Please try again.');window.location.href = 'forgot_password.php';</script>";
    exit();
}

include 'connection.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verify_otp'])) {
    $enteredOTP = $_POST['otp'];
    $storedOTP = $_SESSION['otp'];

    if ($enteredOTP == $storedOTP) {
        echo "<script>alert('OTP verified successfully.');</script>";
        $_SESSION['OTP_VERIFIED'] = true; // Set OTP verification flag
        echo "<script>window.location.href = 'reset_password.php';</script>"; // Redirect to reset_password.php
        exit();
    } else {
        echo "<script>alert('Invalid OTP. Please try again.');</script>";
    }
}

// Function to send OTP via email
function sendOTP($email, $otp) {
    $subject = "OTP Verification";
    $message = "Your OTP for password reset is: $otp";
    $headers = "From: your_email@example.com"; // Replace with your email address
    mail($email, $subject, $message, $headers);
}

// Send OTP via email
$email = $_SESSION['email'];
$otp = $_SESSION['otp'];
sendOTP($email, $otp);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style1.css">
    <title>Verify OTP</title>
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
            height: 340px;
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
        .password-content p {
            font-size: 16px;
            line-height: 1.6;
            font-family: comic sans MS;
        }
        .password-content form {
            margin-top: 20px;
        }
        .password-content input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 19px;
            border-radius: 30px;
            border: 1px solid #ccc;
            box-sizing: border-radius:30px;
        }
        .submit-btn {
            width: 130px;
            height: 40px;
            font-size: 16px;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            cursor: pointer;
            border-radius: 30px;
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
            <li><a href="#" class="link">Verify OTP</a></li>
        </ul>
    </div>
    <div class="nav-menu-btn">
        <i class="bx bx-menu" onclick="myMenuFunction()"></i>
    </div>
</nav>
<div class="wrapper">
    <!-- Password content -->
    <div class="password-content">
        <h1>Verify OTP</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="otp">Enter OTP:</label><br><br>
            <input type="text" id="otp" name="otp" placeholder="Enter OTP" required><br><br>
            <input type="submit" name="verify_otp" value="Verify OTP" class="submit-btn">
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
