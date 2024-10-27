<?php
include("connection.php");

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Retrieve existing membership details
    $query = "SELECT * FROM membership WHERE ID = $id";
    $result = mysqli_query($conn, $query);
    if($result && mysqli_num_rows($result) > 0) {
        $membership = mysqli_fetch_assoc($result);

        // Update membership details if form is submitted
        if(isset($_POST['updateMembership'])) {
            $membershipId = $_POST['membership-id'];
            $membershipName = $_POST['membership-name'];
            $membershipType = $_POST['membership-type'];
            $link = $_POST['link'];

            // Update data in the database
            $updateQuery = "UPDATE membership SET MEMBERSHIP_ID='$membershipId', MEMBERSHIP_NAME='$membershipName', M_TYPE='$membershipType', LINK='$link' WHERE ID=$id";
            $updateResult = mysqli_query($conn, $updateQuery);

            if($updateResult) {
                // Redirect back to the membership page after update
                header("Location: membership.php");
                exit;
            } else {
                // Handle error if update fails
                echo "Error updating membership record: " . mysqli_error($conn);
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Membership</title>
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
        <li><a href="experience.php">Experience</a></li>
        <li><a href="research.php">Research</a></li>
        <li><a href="upskilling.php">Upskilling</a></li>
        <li><a href="subjects.php">Subjects Taught</a></li>
        <li><a href="#" class="active">Membership</a></li>
    </ul>
</div>

<main>
    <h2 style="margin-top:3px;">Edit Membership</h2>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $membership['ID']; ?>">
        <label for="membership-id">Membership ID:</label>
        <input type="text" id="membership-id" name="membership-id" value="<?php echo $membership['MEMBERSHIP_ID']; ?>" required>

        <label for="membership-name">Membership Name:</label>
        <input type="text" id="membership-name" name="membership-name" value="<?php echo $membership['MEMBERSHIP_NAME']; ?>" required>

        <label for="membership-type">Membership Type:</label>
        <input type="text" id="membership-type" name="membership-type" value="<?php echo $membership['M_TYPE']; ?>" required>

        <label for="link">Link:</label>
        <input type="url" id="link" name="link" value="<?php echo $membership['LINK']; ?>">

        <input type="submit" value="Update Membership" name="updateMembership">
    </form>
</main>

</body>
</html>
<?php
    }
}
?>
