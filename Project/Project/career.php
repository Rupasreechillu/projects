<?php
session_start(); // Start session to track logged-in user

include("connection.php");

// Function to retrieve career details for the logged-in user
function getCareerDetails() {
    global $conn;

    // Retrieve user email from session
    if(isset($_SESSION['email'])) {
        $userEmail = $_SESSION['email'];

        // Query to retrieve career details for the logged-in user
        $query = "SELECT * FROM career WHERE user_email = '$userEmail'";
        $result = mysqli_query($conn, $query);

        $careerData = array();
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $careerData[] = $row;
            }
        }
        return $careerData;
    } else {
        return array(); // Return empty array if user is not logged in
    }
}

// Function to display career details
function displayCareerDetails($careerData) {
    if (empty($careerData)) {
        echo "<p>No career details available.</p>";
        return;
    }
    $counter = 1;
    echo "
    <table id='career-details'>
        <thead>
            <tr>
                <th>S.No</th>
                <th>Studied</th>
                <th>University</th>
                <th>Percentage</th>
                <th>Passed Out Year</th>
                <th>Specialization</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    ";
    foreach ($careerData as $career) {
        echo "<tr>";
        echo "<td>{$counter}</td>";
        echo "<td>{$career['STUDIED']}</td>";
        echo "<td>{$career['UNIVERSITY']}</td>";
        echo "<td>{$career['PERCENTAGE']}</td>";
        echo "<td>{$career['PASSED_OUT_YEAR']}</td>";
        echo "<td>{$career['SPECIALIZATION']}</td>";
        echo "
        <td>
            <form method='POST' action='edit-career.php' style='display: inline;'>
                <input type='hidden' name='id' value='{$career['ID']}'>
                <button type='submit' id='edit_button'>Edit</button>
            </form>
            <form method='POST' action='delete-career.php' style='display: inline;'>
                <input type='hidden' name='id' value='{$career['ID']}'>
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
if (isset($_POST['addCareer'])) {
    // Retrieve form data
    $studied = $_POST['studied'];
    $university = $_POST['university'];
    $percentage = $_POST['percentage'];
    $passedOutYear = $_POST['passed-out-year'];
    $specialization = $_POST['specialization'];

    // Retrieve user email from session
    if(isset($_SESSION['email'])) {
        $userEmail = $_SESSION['email'];

        // Insert data into database
        $query = "INSERT INTO career (user_email, STUDIED, UNIVERSITY, PERCENTAGE, PASSED_OUT_YEAR, SPECIALIZATION) 
                  VALUES ('$userEmail', '$studied', '$university', '$percentage', '$passedOutYear', '$specialization')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Redirect to current page to display the newly added career
            header("Location: {$_SERVER['PHP_SELF']}");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "User is not logged in.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Career Page</title>
    <link rel="stylesheet" href="style2.css">
    <style>
        #add-career-form {
            display: none;
        }
        #add-career-button {
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
        <h2 style="font-family:Times New Roman;">Dashboard</h2>
        <a href="index1.php" class="logout-btn">Logout</a>
    </div>
</header>

<div class="dashboard">
    <ul>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="#" class="active">Career</a></li>
        <li><a href="experience.php">Experience</a></li>
        <li><a href="research.php">Research</a></li>
        <li><a href="upskilling.php">Upskilling</a></li>
        <li><a href="subjects.php">Subjects Taught</a></li>
        <li><a href="membership.php">Membership</a></li>
    </ul>
</div>

<main>
    <h2 style="margin-top:3px;">Career</h2>
    <?php 
    // Check if user is logged in
    if (isset($_SESSION['email'])) {
        $careerData = getCareerDetails(); 
        displayCareerDetails($careerData);
    } else {
        echo "<p>Please log in to view your career details.</p>";
    }
    ?>

    <!-- Add new career form -->
    <div id="add-career-container">
        <h3>Add New Career</h3>
        <div id="add-career-form">
            <form id="new-career-form" method="POST">
                <label for="studied">Studied:</label>
                <input type="text" id="studied" name="studied" placeholder="Field of study.." required>

                <label for="university">University:</label>
                <input type="text" id="university" name="university" placeholder="University name.." required>

                <label for="percentage">Percentage:</label>
                <input type="text" id="percentage" name="percentage" placeholder="Percentage.." required>

                <label for="passed-out-year">Passed Out Year:</label>
                <input type="number" id="passed-out-year" name="passed-out-year" placeholder="Year of passing.." required>

                <label for="specialization">Specialization:</label>
                <input type="text" id="specialization" name="specialization" placeholder="Your specialization.." required>

                <input type="submit" value="Add Career" name="addCareer">
            </form>
        </div>
    </div>

    <button id="add-career-button" onclick="showAddCareerForm()">Add New Career</button>
</main>

<script>
    function showAddCareerForm() {
        var form = document.getElementById("add-career-form");
        form.style.display = "block"; // Display the form
        var button = document.getElementById("add-career-button");
        button.style.display = "none"; // Hide the button
    }
</script>

</body>
</html>
