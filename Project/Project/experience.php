<?php
session_start(); // Start session to track logged-in user

include("connection.php");

// Function to retrieve experience details for the logged-in user
function getExperienceDetails() {
    global $conn;

    // Retrieve user email from session
    $userEmail = $_SESSION['email'];

    // Query to retrieve experience details for the logged-in user
    $query = "SELECT * FROM experience WHERE user_email = '$userEmail'";
    $result = mysqli_query($conn, $query);

    $experienceData = array();
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $experienceData[] = $row;
        }
    }
    return $experienceData;
}

// Function to display experience details
function displayExperienceDetails($experienceData) {
    if (empty($experienceData)) {
        echo "<p>No experience details available.</p>";
        return;
    }
    $counter = 1;
    echo "
    <table id='experience-details'>
        <thead>
            <tr>
                <th>S.No</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Organization Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    ";
    foreach ($experienceData as $experience) {
        echo "<tr>";
        echo "<td>{$counter}</td>";
        echo "<td>{$experience['DESIGNATION']}</td>";
        echo "<td>{$experience['DEPARTMENT']}</td>";
        echo "<td>{$experience['ORGANIZATION_NAME']}</td>";
        echo "<td>{$experience['START_DATE']}</td>";
        echo "<td>{$experience['END_DATE']}</td>";
        echo "
            <td>
                <form method='POST' action='edit-experience.php' style='display: inline;'>
                    <input type='hidden' name='id' value='{$experience['ID']}'>
                    <button type='submit' id='edit_button'>Edit</button>
                </form>
                <form method='POST' action='delete-experience.php' style='display: inline;'>
                    <input type='hidden' name='id' value='{$experience['ID']}'>
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
if (isset($_POST['addExperience'])) {
    // Retrieve form data
    $designation = $_POST['designation'];
    $department = $_POST['department'];
    $orgName = $_POST['org-name'];
    $startDate = $_POST['start-date'];
    $endDate = $_POST['end-date'];

    // Retrieve user email from session
    $userEmail = $_SESSION['email'];

    // Insert data into database
    $query = "INSERT INTO experience (user_email, DESIGNATION, DEPARTMENT, ORGANIZATION_NAME, START_DATE, END_DATE) 
              VALUES ('$userEmail', '$designation', '$department', '$orgName', '$startDate', '$endDate')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Redirect to current page to display the newly added experience
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Experience Page</title>
    <link rel="stylesheet" href="style2.css">
    <style>
        #add-experience-form {
            display: none;
        }
        #add-experience-button {
            display: block;
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
        <h2 style="font-family: Times New Roman;">Dashboard</h2>
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
    <h2 style="margin-top: 3px;">Experience</h2>

    <?php 
    // Check if user is logged in
    if (isset($_SESSION['email'])) {
        $experienceData = getExperienceDetails(); 
        displayExperienceDetails($experienceData);
    } else {
        echo "<p>Please log in to view your experience details.</p>";
    }
    ?>

    <!-- Add new experience form -->
    <div id="add-experience-container">
        <h3>Add New Experience</h3>
        <div id="add-experience-form">
            <form id="new-experience-form" method="POST">
                <label for="designation">Designation:</label>
                <input type="text" id="designation" name="designation" placeholder="Designation.." required>
                <label for="department">Department:</label>
                <input type="text" id="department" name="department" placeholder="Department.." required>

                <label for="org-name">Organization Name:</label>
                <input type="text" id="org-name" name="org-name" placeholder="Organization name.." required>

                <label for="start-date">Start Date:</label>
                <input type="date" id="start-date" name="start-date" required>

                <label for="end-date">End Date:</label>
                <input type="date" id="end-date" name="end-date">

                <input type="submit" value="Add Experience" name="addExperience">
            </form>
        </div>
    </div>

    <button id="add-experience-button" onclick="showAddExpForm()">Add New Experience</button>
</main>

<script>
    function showAddExpForm() {
        var form = document.getElementById("add-experience-form");
        form.style.display = "block"; // Display the form
        var button = document.getElementById("add-experience-button");
        button.style.display = "none"; // Hide the button
    }
</script>

</body>
</html>
