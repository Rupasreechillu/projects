<?php
include("connection.php");

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Retrieve existing subject details
    $query = "SELECT * FROM subjects_taught WHERE ID = $id";
    $result = mysqli_query($conn, $query);
    if($result && mysqli_num_rows($result) > 0) {
        $subject = mysqli_fetch_assoc($result);

        // Update subject details if form is submitted
        if(isset($_POST['updateSubject'])) {
            $subjectName = $_POST['subject-name'];
            $year = $_POST['year'];
            $semester = $_POST['semester'];
            $academicYear = $_POST['academic-year'];
            $organization = $_POST['organization'];
            $passPercentage = $_POST['pass-percentage'];
            $feedback = $_POST['feedback'];
            $link = $_POST['link'];

            // Update data in the database
            $updateQuery = "UPDATE subjects_taught SET SUBJECT_NAME='$subjectName', YEAR='$year', SEMESTER='$semester', ACADEMIC_YEAR='$academicYear', ORGANIZATION='$organization', PASS_PERCENTAGE='$passPercentage', FEEDBACK='$feedback', LINK='$link' WHERE ID=$id";
            $updateResult = mysqli_query($conn, $updateQuery);

            if($updateResult) {
                // Redirect back to the subjects page after update
                header("Location: subjects.php");
                exit;
            } else {
                // Handle error if update fails
                echo "Error updating subject record: " . mysqli_error($conn);
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Subject</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<header>
    <div class="logo-section">
        <img src="Sritlogo.png" alt="srit logo" id="logo" align="left">
        <style>
        #logo {
            width: 110px;
            height: 120px;
        }
    </style>
    </div>
    <div class="right-section">
        <h2 style="font-family:Times New Roman;">Dashboard</h2>
        <a href="index1.php" class="logout-btn">Logout</a>
    </div>
</header>

<div class="dashboard">
    <ul>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="career.php">Career</a></li>
        <li><a href="experience.php">Experience</a></li>
        <li><a href="research.php">Research</a></li>
        <li><a href="upskilling.php">Upskilling</a></li>
        <li><a href="#" class="active">Subjects Taught</a></li>
        <li><a href="membership.php">Membership</a></li>
    </ul>
</div>

<main>
    <h2 style="margin-top:3px;">Edit Subject</h2>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $subject['ID']; ?>">
        <label for="subject-name">Subject Name:</label>
        <input type="text" id="subject-name" name="subject-name" value="<?php echo $subject['SUBJECT_NAME']; ?>" required>

        <label for="year">Year:</label>
        <input type="number" id="year" name="year" value="<?php echo $subject['YEAR']; ?>" required>

        <label for="semester">Semester:</label>
        <input type="text" id="semester" name="semester" value="<?php echo $subject['SEMESTER']; ?>" required>

        <label for="academic-year">Academic Year:</label>
        <input type="text" id="academic-year" name="academic-year" value="<?php echo $subject['ACADEMIC_YEAR']; ?>" required>

        <label for="organization">Organization:</label>
        <input type="text" id="organization" name="organization" value="<?php echo $subject['ORGANIZATION']; ?>" required>

        <label for="pass-percentage">Pass Percentage:</label>
        <input type="text" id="pass-percentage" name="pass-percentage" value="<?php echo $subject['PASS_PERCENTAGE']; ?>" required>

        <label for="feedback">Feedback:</label>
        <input type="text" id="feedback" name="feedback" value="<?php echo $subject['FEEDBACK']; ?>">

        <label for="link">Link:</label>
        <input type="url" id="link" name="link" value="<?php echo $subject['LINK']; ?>">

        <input type="submit" value="Update Subject" name="updateSubject">
    </form>
</main>

</body>
</html>
<?php
    }
}
?>
