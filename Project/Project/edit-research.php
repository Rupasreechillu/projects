<?php
include("connection.php");

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Retrieve existing research details
    $query = "SELECT * FROM research WHERE ID = $id";
    $result = mysqli_query($conn, $query);
    if($result && mysqli_num_rows($result) > 0) {
        $research = mysqli_fetch_assoc($result);

        // Update research details if form is submitted
        if(isset($_POST['updateResearch'])) {
            $type = $_POST['research-type'];
            $title = $_POST['research-title'];
            $publisherName = $_POST['publisher-name'];
            $nationalInternational = $_POST['national-international'];
            $issnIsbn = $_POST['issn-isbn'];
            $volume = $_POST['volume'];
            $month = $_POST['month'];
            $year = $_POST['year'];
            $link = $_POST['link'];

            // Update data in the database
            $updateQuery = "UPDATE research SET TYPE='$type', TITLE='$title', PUBLISHER_NAME='$publisherName', NATIONAL_INTERNATIONAL='$nationalInternational', ISSN_ISBN='$issnIsbn', VOLUME='$volume', MONTH='$month', YEAR='$year', LINK='$link' WHERE ID=$id";
            $updateResult = mysqli_query($conn, $updateQuery);

            if($updateResult) {
                // Redirect back to the research page after update
                header("Location: research.php");
                exit;
            } else {
                // Handle error if update fails
                echo "Error updating research record: " . mysqli_error($conn);
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Research</title>
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
        <li><a href="#" class="active">Research</a></li>
        <li><a href="upskilling.php">Upskilling</a></li>
        <li><a href="subjects.php">Subjects Taught</a></li>
        <li><a href="membership.php">Membership</a></li>
    </ul>
</div>

<main>
    <h2 style="margin-top:3px;">Edit Research</h2>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $research['ID']; ?>">
        <label for="research-type">Type:</label>
        <input type="text" id="research-type" name="research-type" value="<?php echo $research['TYPE']; ?>" required>

        <label for="research-title">Title:</label>
        <input type="text" id="research-title" name="research-title" value="<?php echo $research['TITLE']; ?>" required>

        <label for="publisher-name">Publisher Name:</label>
        <input type="text" id="publisher-name" name="publisher-name" value="<?php echo $research['PUBLISHER_NAME']; ?>" required>

        <label for="national-international">National/International:</label>
        <input type="text" id="national-international" name="national-international" value="<?php echo $research['NATIONAL_INTERNATIONAL']; ?>" required>

        <label for="issn-isbn">ISSN/ISBN:</label>
        <input type="text" id="issn-isbn" name="issn-isbn" value="<?php echo $research['ISSN_ISBN']; ?>" required>

        <label for="volume">Volume:</label>
        <input type="text" id="volume" name="volume" value="<?php echo $research['VOLUME']; ?>">

        <label for="month">Month:</label>
        <input type="text" id="month" name="month" value="<?php echo $research['MONTH']; ?>">

        <label for="year">Year:</label>
        <input type="number" id="year" name="year" value="<?php echo $research['YEAR']; ?>" required>

        <label for="link">Link:</label>
        <input type="text" id="link" name="link" value="<?php echo $research['LINK']; ?>">

        <input type="submit" value="Update Research" name="updateResearch">
    </form>
</main>

</body>
</html>
<?php
    }
}
?>
