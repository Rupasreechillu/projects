<?php
session_start();

if (!isset($_SESSION['OTP_VERIFIED'])) {
    echo "<script>alert('Unauthorized access. Please verify OTP first.');window.location.href = 'forgot_password.php';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset_password'])) {
    // Proceed with password reset logic
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if passwords match
    if ($newPassword === $confirmPassword) {
        // Update the password in the database
        include 'connection.php'; // Include your database connection
        $email = $_SESSION['email'];
        
        // Hash the new password (if necessary)
        // $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
        // Update the password directly without hashing
        $query = "UPDATE users SET password = '$newPassword' WHERE email = '$email'";
        
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Password reset successfully.');</script>";
            // Clear session data
            unset($_SESSION['email']);
            unset($_SESSION['otp']);
            unset($_SESSION['OTP_VERIFIED']);
            echo "<script>window.location.href = 'index1.php';</script>"; // Redirect to index1.php
            exit();
        } else {
            echo "<script>alert('Failed to reset password. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Passwords do not match. Please try again.');</script>";
    }
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
    <title>Reset Password</title>
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
            height: 350px;
            padding: 25px;
            border-radius: 25px;
            background-color: rgba(240, 240, 240, 0.262);
        }
        .password-content h1, .password-content h2 {
            font-size: 38px;
            font-family: cursive;
            color: #241756;
        }
        .password-content input[type="email"],
        .password-content input[type="text"],
        .password-content input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 30px;
            border: 1px solid #ccc;
            box-sizing: border-radius: 30px;
            margin-bottom:8px;
            margin-top:10px;
        }
        .submit-btn {
            width: 150px;
            height: 40px;
            font-size: 16px;
            color: #fff;
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
            <li><a href="#" class="link">Reset Password</a></li>
        </ul>
    </div>
    <div class="nav-menu-btn">
        <i class="bx bx-menu" onclick="myMenuFunction()"></i>
    </div>
</nav>
<div class="wrapper">
    <!-- Password content -->
    <div class="password-content">
        <h1>Reset Password</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="new_password">Enter new password:</label><br>
            <input type="password" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{8,}" id="new_password" name="new_password" placeholder="New Password" required><br>
            <label for="confirm_password">Confirm new password:</label><br>
            <input type="password" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{8,}" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required><br><br>
            <input type="submit" name="reset_password" value="Reset Password" class="submit-btn">
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
