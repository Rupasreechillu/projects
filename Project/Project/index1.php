<?php
session_start(); // Start session

include 'connection.php'; // Include your connection file

// Registration
if(isset($_POST['register'])){
    // Get the user's input
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    
    // Validate and process the data
    
    // Check if the passwords match
    if($password !== $confirmpassword){
        echo "<script>alert('Passwords do not match. Please try again.');</script>";
    } else{
        // Check if the email is already registered
        $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
        $checkEmailResult = mysqli_query($conn, $checkEmailQuery);
        
        if(mysqli_num_rows($checkEmailResult) > 0){
            echo "<script>alert('Email is already registered. Please try again with a different email.');</script>";
        } else{
            // Insert the user's data into the database
            $insertQuery = "INSERT INTO users (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$password')";
            
            if(mysqli_query($conn, $insertQuery)){
                // Registration successful
                echo "<script>
                var successDialog = confirm('Registration successful! Click OK to continue.');
                if (successDialog) {
                    window.location.href = 'index1.php'; // Redirect if user clicks OK
                }
            </script>";
            } else{
                // Registration failed
                echo "<script>alert('Registration failed. Please try again.');</script>";
            }
        }
    }
}

// Login
if(isset($_POST['login'])){
    // Get the user's input
    $loginEmail = $_POST['loginEmail'];
    $loginPassword = $_POST['loginPassword'];
    
    // Validate and process the data
    
    // Retrieve the password from the database based on the email provided
    $loginQuery = "SELECT password FROM users WHERE email = '$loginEmail'";
    $loginResult = mysqli_query($conn, $loginQuery);
    
    if(mysqli_num_rows($loginResult) == 1){
        // Fetch the password from the database
        $row = mysqli_fetch_assoc($loginResult);
        $passwordFromDB = $row['password'];
        
        // Verify the provided password against the password from the database
        if($loginPassword === $passwordFromDB){
            // Passwords match, login successful
            $_SESSION['email'] = $loginEmail; // Store user's email in session
            header("Location: profile.php");
            exit();
        } else {
            // Passwords do not match, login failed
            echo "<script>alert('Invalid email or password. Please try again.');</script>";
        }
    } else{
        // No user found with the provided email
        echo "<script>alert('Invalid email or password. Please try again.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style1.css">
    <title>Login & Registration</title>
    <style>
        #logo {
            width: 110px;
            height: 120px;
        }
        .nav-menu ul {
            display: flex;
            margin-left: 200px;
        }
    </style>
</head>
<body>
 <div class="wrapper">
    <nav class="nav">
        <div class="nav-logo">
            <img src="Sritlogo.png" alt="srit logo" id="logo" align="left">
        </div>
        <div class="nav-menu" id="navMenu">
            <ul>
                <li><a href="#" class="link active">Home</a></li>
                <li><a href="about.php" class="link">About</a></li>
            </ul>
        </div>
        <div class="nav-button">
            <button class="btn white-btn" id="loginBtn" name="login" onclick="login()">Sign In</button>
            <button type="submit" class="btn" id="registerBtn" name="register" onclick="register()">Sign Up</button>
        </div>
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>
<!----------------------------- Form box ----------------------------------->       
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<div class="form-box">
        <!------------------- login form -------------------------->
        <div class="login-container" id="login">
            <div class="top">
                <span>Don't have an account? <a href="#" onclick="register()">Sign Up</a></span>
                <header>Login</header>
            </div>
            <div class="input-box">
                <input type="text" class="input-field" placeholder="Username or Email" name="loginEmail">
                <i class="bx bx-user"></i>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" placeholder="Password"  name="loginPassword">
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-box">
                <input type="submit" class="submit" value="Sign In" name="login">
            </div>
            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="login-check">
                    <label for="login-check"> Remember Me</label>
                </div>
                <div class="two">
                    <label><a href="forgot_password.php">Forgot password?</a></label>
                </div>
            </div>
        </div>
        <!------------------- registration form -------------------------->
        <div class="register-container" id="register">
            <div class="top">
                <span>Have an account? <a href="#" onclick="login()">Login</a></span>
                <header>Sign Up</header>
            </div>
            <div class="two-forms">
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="Firstname" name="firstname">
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="Lastname" name="lastname">
                    <i class="bx bx-user"></i>
                </div>
            </div>
            <div class="input-box">
                <input type="email" class="input-field"  placeholder="Email" name="email">
                <i class="bx bx-envelope"></i>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{8,}" placeholder="Password" name="password">
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{8,}" placeholder="Confirm Password"  name="confirmpassword">
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-box">
                <input type="submit" class="submit" onclick="showDialog()"  value="Register" name="register">
            </div>
            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="register-check">
                    <label for="register-check"> Remember Me</label>
                </div>
                <div class="two">
                    <label><a href="#">Terms & conditions</a></label>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
   
function myMenuFunction() {
    var i = document.getElementById("navMenu");
    if(i.className === "nav-menu") {
        i.className += " responsive";
    }
    else {
        i.className = "nav-menu";
    }
}

var a = document.getElementById("loginBtn");
var b = document.getElementById("registerBtn");
var x = document.getElementById("login");
var y = document.getElementById("register");

function login() {
    x.style.left = "4px";
    y.style.right = "-520px";
    a.className += " white-btn";
    b.className = "btn";
    x.style.opacity = 1;
    y.style.opacity = 0;
}

function register() {
    x.style.left = "-510px";
    y.style.right = "5px";
    a.className = "btn";
    b.className += " white-btn";
    x.style.opacity = 0;
    y.style.opacity = 1;
}
</script>
</body>
</html>

           
