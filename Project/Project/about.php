<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style1.css">
    <title>About Us</title>
    <style>
        #logo {
            width: 110px;
            height: 120px;
        }
        .about-content {
            margin: 50px auto;
            text-align: center;
            color: #fff;
            max-width: 800px;
            padding: 25px;
            border-radius: 25px;
            background-color: rgba(240, 240, 240, 0.262);
        }
        .about-content h1,h2 {
            font-size: 38px;
            margin-bottom: 18px;
            font-family: cursive;
            color: #241756;
        }
        .about-content p {
            font-size: 16px;
            line-height: 1.6;
            font-family: comic sans MS;
        }
        .about-content ul {
            text-align: left;
            margin-left: 20px;
        }
        .about-content ul li {
            margin-bottom: 10px;
            font-family: comic sans MS;
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
                <li><a href="#" class="link active">About</a></li>
            </ul>
        </div>
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>

    <!-- About content -->
    <div class="wrapper">
        <div class="about-content">
            <h1>About</h1>
            <p>Our Profile Management System is a comprehensive platform designed to streamline the organization and management of profile-related information. Whether you're an academic institution, research center, or any organization with a team of profiles, our system provides the tools you need to efficiently manage and access profile data.</p>
            <h2>Key Features</h2>
            <ul>
                <li>Efficiently organize profile-related information.</li>
                <li>Streamline management of profiles, experiences, publications, and workshops.</li>
                <li>Facilitate collaboration and access to profile data.</li>
            </ul>
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
