<?php
include("connection.php");

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Retrieve existing career details
    $query = "SELECT * FROM career WHERE ID = $id";
    $result = mysqli_query($conn, $query);
    if($result && mysqli_num_rows($result) > 0) {
        $career = mysqli_fetch_assoc($result);

        // Update career details if form is submitted
        if(isset($_POST['updateCareer'])) {
            $studied = $_POST['studied'];
            $university = $_POST['university'];
            $percentage = $_POST['percentage'];
            $passedOutYear = $_POST['passed-out-year'];
            $specialization = $_POST['specialization'];

            // Update data in the database
            $updateQuery = "UPDATE career SET STUDIED='$studied', UNIVERSITY='$university', PERCENTAGE='$percentage', PASSED_OUT_YEAR='$passedOutYear', SPECIALIZATION='$specialization' WHERE ID=$id";
            $updateResult = mysqli_query($conn, $updateQuery);

            if($updateResult) {
                // Redirect back to the career page after update
                header("Location: career.php");
                exit;
            } else {
                // Handle error if update fails
                echo "Error updating career record: " . mysqli_error($conn);
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Career</title>
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
        <li><a href="profile.html">Profile</a></li>
        <li><a href="#" class="active">Career</a></li>
        <li><a href="experience.html">Experience</a></li>
        <li><a href="research.html">Research</a></li>
        <li><a href="upskilling.html">Upskilling</a></li>
        <li><a href="subjects.html">Subjects Taught</a></li>
        <li><a href="membership.html">Membership</a></li>
    </ul>
</div>

<main>
    <h2 style="margin-top:3px;">Edit Career</h2>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $career['ID']; ?>">
        <label for="studied">Studied:</label>
        <input type="text" id="studied" name="studied" value="<?php echo $career['STUDIED']; ?>" required>

        <label for="university">University:</label>
        <input type="text" id="university" name="university" value="<?php echo $career['UNIVERSITY']; ?>" required>

        <label for="percentage">Percentage:</label>
        <input type="text" id="percentage" name="percentage" value="<?php echo $career['PERCENTAGE']; ?>" required>

        <label for="passed-out-year">Passed Out Year:</label>
        <input type="number" id="passed-out-year" name="passed-out-year" value="<?php echo $career['PASSED_OUT_YEAR']; ?>" required>

        <label for="specialization">Specialization:</label>
        <input type="text" id="specialization" name="specialization" value="<?php echo $career['SPECIALIZATION']; ?>" required>

        <input type="submit" value="Update Career" name="updateCareer">
    </form>
</main>

</body>
</html>
<?php
    }
}
?>
