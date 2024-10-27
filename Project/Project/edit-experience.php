<?php
include("connection.php");

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Retrieve existing experience details
    $query = "SELECT * FROM experience WHERE ID = $id";
    $result = mysqli_query($conn, $query);
    if($result && mysqli_num_rows($result) > 0) {
        $experience = mysqli_fetch_assoc($result);

        // Update experience details if form is submitted
        if(isset($_POST['updateExperience'])) {
            $designation = $_POST['designation'];
            $department = $_POST['department'];
            $orgName = $_POST['org-name'];
            $startDate = $_POST['start-date'];
            $endDate = $_POST['end-date'];

            // Update data in the database
            $updateQuery = "UPDATE experience SET DESIGNATION='$designation', DEPARTMENT='$department', ORGANIZATION_NAME='$orgName', START_DATE='$startDate', END_DATE='$endDate' WHERE ID=$id";
            $updateResult = mysqli_query($conn, $updateQuery);

            if($updateResult) {
                // Redirect back to the experience page after update
                header("Location: experience.php");
                exit;
            } else {
                // Handle error if update fails
                echo "Error updating experience record: " . mysqli_error($conn);
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Experience</title>
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
        <li><a href="profile.php">Profile</a></li>
        <li><a href="career.php">Career</a></li>
        <li><a href="#" class="active">Experience</a></li>
        <li><a href="research.php">Research</a></li>
        <li><a href="upskilling.php">Upskilling</a></li>
        <li><a href="subjects.php">Subjects Taught</a></li>
        <li><a href="membership.php">Membership</a></li>
    </ul>
</div>

<main>
    <h2 style="margin-top:3px;">Edit Experience</h2>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $experience['ID']; ?>">
        <label for="designation">Designation:</label>
        <input type="text" id="designation" name="designation" value="<?php echo $experience['DESIGNATION']; ?>" required>

        <label for="department">Department:</label>
        <input type="text" id="department" name="department" value="<?php echo $experience['DEPARTMENT']; ?>" required>

        <label for="org-name">Organization Name:</label>
        <input type="text" id="org-name" name="org-name" value="<?php echo $experience['ORGANIZATION_NAME']; ?>" required>

        <label for="start-date">Start Date:</label>
        <input type="date" id="start-date" name="start-date" value="<?php echo $experience['START_DATE']; ?>" required>

        <label for="end-date">End Date:</label>
        <input type="date" id="end-date" name="end-date" value="<?php echo $experience['END_DATE']; ?>">

        <input type="submit" value="Update Experience" name="updateExperience">
    </form>
</main>

</body>
</html>
<?php
    }
}
?>
