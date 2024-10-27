<?php
session_start(); 

include("connection.php");

// Function to retrieve research details from the database
function getResearchDetails() {
    global $conn;

    $userEmail = $_SESSION['email'];

    $query = "SELECT * FROM research WHERE user_email = '$userEmail'";
    $result = mysqli_query($conn, $query);

    $researchData = array();
    if($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $researchData[] = $row;
        }
    }
    return $researchData;
}

// Function to display research details
function displayResearchDetails($researchData) {
    if(empty($researchData)) {
        echo "<p>No research details available.</p>";
        return;
    }
    $counter = 1;
    echo "
    <table id='research-details'>
        <thead>
            <tr>
                <th>S.No</th>
                <th>Type</th>
                <th>Title</th>
                <th>Publisher Name</th>
                <th>National/International</th>
                <th>ISSN/ISBN</th>
                <th>Volume</th>
                <th>Month</th>
                <th>Year</th>
                <th>Link</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    ";
    foreach($researchData as $research) {
        echo "<tr>";
        echo "<td>{$counter}</td>";
        echo "<td>{$research['TYPE']}</td>";
        echo "<td>{$research['TITLE']}</td>";
        echo "<td>{$research['PUBLISHER_NAME']}</td>";
        echo "<td>{$research['NATIONAL_INTERNATIONAL']}</td>";
        echo "<td>{$research['ISSN_ISBN']}</td>";
        echo "<td>{$research['VOLUME']}</td>";
        echo "<td>{$research['MONTH']}</td>";
        echo "<td>{$research['YEAR']}</td>";
        echo "<td><a href='{$research['LINK']}' target='_blank'>Link</a></td>";
        echo "
            <td>
                <form method='POST' action='edit-research.php' style='display: inline;'>
                    <input type='hidden' name='id' value='{$research['ID']}'>
                    <button type='submit' id='edit_button'>Edit</button>
                </form>
                <form method='POST' action='delete-research.php' style='display: inline;'>
                    <input type='hidden' name='id' value='{$research['ID']}'>
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
if(isset($_POST['addResearch'])) {
    // Retrieve form data
    $type = $_POST['research-type'];
    $title = $_POST['research-title'];
    $publisherName = $_POST['publisher-name'];
    $nationalInternational = $_POST['national-international'];
    $issnIsbn = $_POST['issn-isbn'];
    $volume = $_POST['volume'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $link = $_POST['link'];

    $userEmail = $_SESSION['email'];

    // Insert data into database
    $query = "INSERT INTO research (user_email, TYPE, TITLE, PUBLISHER_NAME, NATIONAL_INTERNATIONAL, ISSN_ISBN, VOLUME, MONTH, YEAR, LINK) VALUES ('$userEmail', '$type', '$title', '$publisherName', '$nationalInternational', '$issnIsbn', '$volume', '$month', '$year', '$link')";
    $result = mysqli_query($conn, $query);

    if($result) {
        // Redirect to current page to display the newly added research
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Research Page</title>
    <link rel="stylesheet" href="style2.css">
    <style>
         #add-research-form {
            display: none;
        }
        #add-research-button {
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
        <li><a href="career.php">Career</a></li>
        <li><a href="experience.php">Experience</a></li>
        <li><a href="#" class="active">Research</a></li>
        <li><a href="upskilling.php">Upskilling</a></li>
        <li><a href="subjects.php">Subjects Taught</a></li>
        <li><a href="membership.php">Membership</a></li>
    </ul>
</div>

<main>
    <h2 style="margin-top:3px;">Research</h2>
    <?php 
    // Check if user is logged in
    if (isset($_SESSION['email'])) {
        $researchData = getResearchDetails();  
        displayResearchDetails($researchData);
    } else {
        echo "<p>Please log in to view your career details.</p>";
    }
    ?>

    <!-- Add new research form -->
    <div id="add-research-container">
        <h3>Add New Research</h3>
        <div id="add-research-form">
        <form id="new-research-form" method="POST" action="">
            <label for="research-type">Type:</label>
            <select id="research-type" name="research-type" required>
                <option value="CONFERENCE">Conference</option>
                <option value="BOOKS">Books</option>
                <option value="BOOK CHAPTER">Book Chapter</option>
                <option value="OTHER">Other</option>
            </select>

            <label for="research-title">Title:</label>
            <input type="text" id="research-title" name="research-title" placeholder="Research title.." required>

            <label for="publisher-name">Publisher Name:</label>
            <input type="text" id="publisher-name" name="publisher-name" placeholder="Publisher name.." required>

            <label for="national-international">National/International:</label>
            <input type="text" id="national-international" name="national-international" placeholder="National/International.." required>

            <label for="issn-isbn">ISSN/ISBN:</label>
            <input type="text" id="issn-isbn" name="issn-isbn" placeholder="ISSN/ISBN.." required>

            <label for="volume">Volume:</label>
            <input type="text" id="volume" name="volume" placeholder="Volume..">

            <label for="month">Month:</label>
            <input type="text" id="month" name="month" placeholder="Month..">

            <label for="year">Year:</label>
            <input type="number" id="year" name="year" placeholder="Year.." required>

            <label for="link">Link:</label>
            <input type="url" id="link" name="link" placeholder="Link..">

            <input type="submit" value="Add Research" name="addResearch">
        </form>
    </div>
</div>
    <button id="add-research-button" onclick="showAddResearchForm()">Add New Research</button>
</main>

<script>
     function showAddResearchForm() {
        var form = document.getElementById("add-research-form");
        form.style.display = "block"; // Display the form
        var button = document.getElementById("add-research-button");
        button.style.display = "none"; // Hide the button
    }
</script>

</body>
</html>
