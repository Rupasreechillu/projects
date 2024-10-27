<?php
include("connection.php");

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Retrieve existing upskilling details
    $query = "SELECT * FROM upskilling WHERE ID = $id";
    $result = mysqli_query($conn, $query);
    if($result && mysqli_num_rows($result) > 0) {
        $upskilling = mysqli_fetch_assoc($result);

        // Update upskilling details if form is submitted
        if(isset($_POST['updateUpskilling'])) {
            $type = $_POST['upskilling-type'];
            $fromDate = $_POST['from-date'];
            $toDate = $_POST['to-date'];
            $department = $_POST['department'];
            $organizedBy = $_POST['organized-by'];
            $link = $_POST['link'];

            // Update data in the database
            $updateQuery = "UPDATE upskilling SET TYPE='$type', FROM_DATE='$fromDate', TO_DATE='$toDate', DEPARTMENT='$department', ORGANIZED_BY='$organizedBy', LINK='$link' WHERE ID=$id";
            $updateResult = mysqli_query($conn, $updateQuery);

            if($updateResult) {
                // Redirect back to the upskilling page after update
                header("Location: upskilling.php");
                exit;
            } else {
                // Handle error if update fails
                echo "Error updating upskilling record: " . mysqli_error($conn);
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Upskilling</title>
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
        <li><a href="#" class="php">Upskilling</a></li>
        <li><a href="subjects.php">Subjects Taught</a></li>
        <li><a href="membership.php">Membership</a></li>
    </ul>
</div>

<main>
    <h2 style="margin-top:3px;">Edit Upskilling</h2>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $upskilling['ID']; ?>">
        <label for="upskilling-type">Type:</label>
        <select id="upskilling-type" name="upskilling-type" required>
            <option value="FDP" <?php if($upskilling['TYPE'] == 'FDP') echo 'selected'; ?>>FDP</option>
            <option value="STTP" <?php if($upskilling['TYPE'] == 'STTP') echo 'selected'; ?>>STTP</option>
            <option value="WORKSHOP" <?php if($upskilling['TYPE'] == 'WORKSHOP') echo 'selected'; ?>>Workshop</option>
            <option value="OTHER" <?php if($upskilling['TYPE'] == 'OTHER') echo 'selected'; ?>>Other</option>
        </select>

        <label for="from-date">From Date:</label>
        <input type="date" id="from-date" name="from-date" value="<?php echo $upskilling['FROM_DATE']; ?>" required>

        <label for="to-date">To Date:</label>
        <input type="date" id="to-date" name="to-date" value="<?php echo $upskilling['TO_DATE']; ?>" required>

        <label for="department">Department:</label>
        <input type="text" id="department" name="department" value="<?php echo $upskilling['DEPARTMENT']; ?>" required>

        <label for="organized-by">Organized By:</label>
        <input type="text" id="organized-by" name="organized-by" value="<?php echo $upskilling['ORGANIZED_BY']; ?>" required>

        <label for="link">Link:</label>
        <input type="url" id="link" name="link" value="<?php echo $upskilling['LINK']; ?>">

        <input type="submit" value="Update Upskilling" name="updateUpskilling">
    </form>
</main>

</body>
</html>
<?php
    }
}
?>
