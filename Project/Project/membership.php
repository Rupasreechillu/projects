<?php

session_start();
// Include the file for database connection
include("connection.php");

// Function to retrieve membership details from the database
function getMembershipDetails() {
    global $conn;

    $userEmail = $_SESSION['email'];

    $query = "SELECT * FROM membership WHERE user_email = '$userEmail'";
    $result = mysqli_query($conn, $query);

    $membershipData = array();
    if($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $membershipData[] = $row;
        }
    }
    return $membershipData;
}

// Function to display membership details
function displayMembershipDetails($membershipData) {
    if(empty($membershipData)) {
        echo "<p>No membership details available.</p>";
        return;
    }
    $counter = 1;
    echo "
    <table id='membership-details'>
        <thead>
            <tr>
                <th>S.No</th>
                <th>Membership ID</th>
                <th>Membership Name</th>
                <th>Membership Type</th>
                <th>Link</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    ";
    foreach($membershipData as $membership) {
        echo "<tr>";
        echo "<td>{$counter}</td>";
        echo "<td>{$membership['MEMBERSHIP_ID']}</td>";
        echo "<td>{$membership['MEMBERSHIP_NAME']}</td>";
        echo "<td>{$membership['M_TYPE']}</td>";
        echo "<td><a href='{$membership['LINK']}' target='_blank'>Link</a></td>";
        echo "
            <td>
                <form method='POST' action='edit-membership.php' style='display: inline;'>
                    <input type='hidden' name='id' value='{$membership['ID']}'>
                    <button type='submit' id='edit_button'>Edit</button>
                </form>
                <form method='POST' action='delete-membership.php' style='display: inline;'>
                    <input type='hidden' name='id' value='{$membership['ID']}'>
                    <button type='submit' id='delete_button'>Delete</button>
                </form>
            </td>
        ";
        echo "</tr>";
        $counter++;
    }
    echo "
        </tbody>
    </table>
    ";
}

// Check if form is submitted
if(isset($_POST['addMembership'])) {
    // Retrieve form data
    $membershipId = $_POST['membership-id'];
    $membershipName = $_POST['membership-name'];
    $membershipType = $_POST['membership-type'];
    $link = $_POST['link'];

    $userEmail = $_SESSION['email'];

    // Insert data into database
    $query = "INSERT INTO membership (user_email, MEMBERSHIP_ID, MEMBERSHIP_NAME, M_TYPE, LINK) VALUES ('$userEmail','$membershipId', '$membershipName', '$membershipType', '$link')";
    $result = mysqli_query($conn, $query);

    if($result) {
        // Redirect to current page to display the newly added membership
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Page</title>
    <link rel="stylesheet" href="style2.css"> 
    <style>
        #add-membership-form {
            display: none;
        }
        #add-membership-button {
            display: block; /* Ensure the "Add New Membership" button is visible */
        }
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
    <h2 style="margin-top:3px;">Membership</h2>
    <?php 
    $membershipData = getMembershipDetails(); 
    displayMembershipDetails($membershipData);
    ?>

    <!-- Add new membership form -->
    <div id="add-membership-container">
        <h3>Add New Membership</h3>
        <div id="add-membership-form">
            <form method="POST" action="">
                
                <label for="membership-id">Membership ID:</label>
                <input type="text" id="membership-id" name="membership-id" placeholder="Membership ID.." required>

                <label for="membership-name">Membership Name:</label>
                <input type="text" id="membership-name" name="membership-name" placeholder="Membership name.." required>

                <label for="membership-type">Membership Type:</label>
                <input type="text" id="membership-type" name="membership-type" placeholder="Membership type.." required>

                <label for="link">Link:</label>
                <input type="url" id="link" name="link" placeholder="Link..">

                <input type="submit" value="Add Membership" name="addMembership">
            </form>
        </div>
    </div>

    <button id="add-membership-button" onclick="showAddMembershipForm()">Add New Membership</button>
</main>

<script>
    function showAddMembershipForm() {
        var form = document.getElementById("add-membership-form");
        form.style.display = "block"; // Display the form
        var button = document.getElementById("add-membership-button");
        button.style.display = "none"; // Hide the button
    }
</script>

</body>
</html>
