<?php
session_start();

include("connection.php");

// Function to retrieve subject details from the database
function getSubjectDetails() {
    global $conn;

    if (!isset($_SESSION['email'])) {
        return []; // Return an empty array if email is not set
    }

    $userEmail = $_SESSION['email'];

    $query = "SELECT * FROM subjects_taught WHERE user_email = ?";
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        echo "Error preparing statement: " . mysqli_error($conn);
        exit;
    }

    mysqli_stmt_bind_param($stmt, "s", $userEmail);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $subjectData = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $subjectData[] = $row;
    }

    mysqli_stmt_close($stmt);

    return $subjectData;
}

// Function to display subject details
function displaySubjectDetails($subjectData) {
    if (empty($subjectData)) {
        echo "<p>No subject details available.</p>";
        return;
    }
    $counter = 1;
    echo "
    <table id='subject-details'>
        <thead>
            <tr>
                <th>S.No</th>
                <th>Subject Name</th>
                <th>Year</th>
                <th>Semester</th>
                <th>Academic Year</th>
                <th>Organization</th>
                <th>Pass Percentage</th>
                <th>Feedback</th>
                <th>Link</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    ";
    foreach ($subjectData as $subject) {
        echo "<tr>";
        echo "<td>{$counter}</td>";
        echo "<td>{$subject['SUBJECT_NAME']}</td>";
        echo "<td>{$subject['YEAR']}</td>";
        echo "<td>{$subject['SEMESTER']}</td>";
        echo "<td>{$subject['ACADEMIC_YEAR']}</td>";
        echo "<td>{$subject['ORGANIZATION']}</td>";
        echo "<td>{$subject['PASS_PERCENTAGE']}</td>";
        echo "<td>{$subject['FEEDBACK']}</td>";
        echo "<td><a href='{$subject['LINK']}' target='_blank'>Link</a></td>";
        echo "
            <td>
                <form method='POST' action='edit-subjects.php' style='display: inline;'>
                    <input type='hidden' name='id' value='{$subject['ID']}'>
                    <button type='submit' id='edit_button'>Edit</button>
                </form>
                <form method='POST' action='delete-subjects.php' style='display: inline;'>
                    <input type='hidden' name='id' value='{$subject['ID']}'>
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
if (isset($_POST['addSubject'])) {
    echo "Form submitted"; // Debugging statement

    // Retrieve form data
    $subjectName = $_POST['subject-name'];
    $year = $_POST['year'];
    $semester = $_POST['semester'];
    $academicYear = $_POST['academic-year'];
    $organization = $_POST['organization'];
    $passPercentage = $_POST['pass-percentage'];
    $feedback = $_POST['feedback'];
    $link = $_POST['link'];

    if (!isset($_SESSION['email'])) {
        echo "Session email is not set!";
        exit;
    }

    $userEmail = $_SESSION['email'];

    // Insert data into database
    $query = "INSERT INTO subjects_taught (user_email, SUBJECT_NAME, YEAR, SEMESTER, ACADEMIC_YEAR, ORGANIZATION, PASS_PERCENTAGE, FEEDBACK, LINK) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        echo "Error preparing statement: " . mysqli_error($conn);
        exit;
    }

    mysqli_stmt_bind_param($stmt, "sssssssss", $userEmail, $subjectName, $year, $semester, $academicYear, $organization, $passPercentage, $feedback, $link);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Redirect to current page to display the newly added subject
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    } else {
        // Error occurred, display the error message
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Subjects Taught Page</title>
    <link rel="stylesheet" href="style2.css"> 
    <style>
        #add-subject-form {
            display: none;
        }
        #add-subject-button {
            display: block; /* Ensure the "Add New Subject" button is visible */
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
        <li><a href="#" class="active">Subjects Taught</a></li>
        <li><a href="membership.php">Membership</a></li>
    </ul>
</div>

<main>
    <h2 style="margin-top:3px;">Subjects Taught</h2>
    <?php 
    if (isset($_SESSION['email'])) {
        $subjectData = getSubjectDetails(); 
        displaySubjectDetails($subjectData);
    } else {
        echo "<p>Please log in to view your career details.</p>";
    }
    ?>

    <!-- Add new subject form -->
    <div id="add-subject-container">
        <h3>Add New Subject</h3>
        <div id="add-subject-form">
            <form id="new-subject-form" method="POST">
                
                <label for="subject-name">Subject Name:</label>
                <input type="text" id="subject-name" name="subject-name" placeholder="Subject name.." required>

                <label for="year">Year:</label>
                <input type="number" id="year" name="year" placeholder="Year.." required>

                <label for="semester">Semester:</label>
                <input type="text" id="semester" name="semester" placeholder="Semester.." required>

                <label for="academic-year">Academic Year:</label>
                <input type="text" id="academic-year" name="academic-year" placeholder="Academic year.." required>

                <label for="organization">Organization:</label>
                <input type="text" id="organization" name="organization" placeholder="Organization.." required>

                <label for="pass-percentage">Pass Percentage:</label>
                <input type="text" id="pass-percentage" name="pass-percentage" placeholder="Pass percentage.." required>

                <label for="feedback">Feedback:</label>
                <input type="text" id="feedback" name="feedback" placeholder="Feedback..">

                <label for="link">Link:</label>
                <input type="url" id="link" name="link" placeholder="Link..">

                <input type="submit" value="Add Subject" name="addSubject">
            </form>
        </div>
    </div>

    <button id="add-subject-button" onclick="showAddSubjectForm()">Add New Subject</button>
</main>

<script>
    function showAddSubjectForm() {
        var form = document.getElementById("add-subject-form");
        form.style.display = "block"; // Display the form
        var button = document.getElementById("add-subject-button");
        button.style.display = "none"; // Hide the button
    }
</script>

</body>
</html>
