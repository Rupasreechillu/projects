<?php
session_start(); // Start session

include("connection.php");

// Check if user is logged in
if(!isset($_SESSION['email'])){
    // Redirect user to login page if not logged in
    header("Location: index1.php");
    exit();
}

$current_email = $_SESSION['email'];

// Fetch profile data for the logged-in user
$query = "SELECT * FROM profile WHERE email = '$current_email'";
$result = mysqli_query($conn, $query);

// Check if profile data exists for the user
if(mysqli_num_rows($result) > 0) {
    $profile_data = mysqli_fetch_assoc($result);

    // Populate variables with profile data
    $id = $profile_data['id'];
    $name = $profile_data['name'];
    $email = $profile_data['email']; // Use the email from the database
    $mobile = $profile_data['mobile'];
    $address = $profile_data['address'];
    $designation = $profile_data['designation'];
} else {
    // If profile data doesn't exist, initialize variables
    $id = "";
    $name = "";
    $email = $current_email; // Use the session email
    $mobile = "";
    $address = "";
    $designation = "";

    // Handle new user registration form submission
    if(isset($_POST['save'])) {
        // Get form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        $designation = $_POST['designation'];

        // Insert new user profile data into the database
        $insertQuery = "INSERT INTO profile (name, email, mobile, address, designation) VALUES ('$name','$email','$mobile','$address','$designation')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if($insertResult) {
            // Update session email if it is changed
            $_SESSION['email'] = $email;
            // Redirect back to the profile page after registration
            header("Location: profile.php");
            exit();
        } else {
            // Handle error if registration fails
            $error_message = "Error registering new profile: " . mysqli_error($conn);
        }
    }
}

$error_message = ""; // Initialize error message variable

// Check if form is submitted for updating profile
if(isset($_POST['save'])) {
    // Get updated data from form
    $name = $_POST['name'];
    $new_email = $_POST['email']; // Use new email input
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $designation = $_POST['designation'];

    // Update data in the database
    $updateQuery = "UPDATE profile SET name='$name', email='$new_email', mobile='$mobile', address='$address', designation='$designation' WHERE email='$current_email'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if($updateResult) {
        // Update session email if it is changed
        $_SESSION['email'] = $new_email;
        // Redirect back to the profile page after update
        header("Location: profile.php");
        exit();
    } else {
        // Handle error if update fails
        $error_message = "Error updating profile: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="style2.css">
    <style>
        #logo {
            width: 110px;
            height: 120px;
        }
    </style>
</head>
<body>
<header>
    <div class="logo-section">
        <img src="Sritlogo.png" alt="srit logo" id="logo" align="left">
    </div>
    <div class="right-section">
        <h2 style="font-family:Times New Roman;">Dashboard</h2>
        <a href="index1.php" class="logout-btn">Logout</a>
    </div>
</header>

<div class="dashboard">
    <ul>
        <li><a href="#" class="active">Profile</a></li>
        <li><a href="career.php">Career</a></li>
        <li><a href="experience.php">Experience</a></li>
        <li><a href="research.php">Research</a></li>
        <li><a href="upskilling.php">Upskilling</a></li>
        <li><a href="subjects.php">Subjects Taught</a></li>
        <li><a href="membership.php">Membership</a></li>
    </ul>
</div>
<main>
    <h2 align="center" style="margin-top:3px;">User Profile</h2>

    <?php
    // Display error message if there's an error
    if(!empty($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>

    <div id="inserted-details">
        <p><strong>Name        :</strong> <?php echo $name; ?></p>
        <p><strong>Email       :</strong> <?php echo $email; ?></p>
        <p><strong>Mobile      :</strong> <?php echo $mobile; ?></p>
        <p><strong>Address     :</strong> <?php echo $address; ?></p>
        <p><strong>Designation :</strong> <?php echo $designation; ?></p>
    </div>

    <div id="edit-profile">
        <button onclick="toggleForm()" id="profile-edit">Edit Profile</button>
    </div>

    <form id="profile-form" style="display: none;" action="#" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="current_email" value="<?php echo $current_email; ?>"> <!-- Add hidden field for current email -->

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" placeholder="Your name..">

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?php echo $email; ?>" placeholder="Your email..">

        <label for="mobile">Mobile:</label>
        <input type="text" id="mobile" name="mobile" value="<?php echo $mobile; ?>" placeholder="Your mobile number..">

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo $address; ?>" placeholder="Your address..">

        <label for="designation">Designation:</label>
        <input type="text" id="designation" name="designation" value="<?php echo $designation; ?>" placeholder="Your designation..">

        <input type="submit" value="Save" name="save">
    </form>
</main>

<script>
    function toggleForm() {
        var form = document.getElementById('profile-form');
        form.style.display = (form.style.display === 'none') ? 'block' : 'none';
    }
</script>

</body>
</html>
