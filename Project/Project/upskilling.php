<?php
session_start();

include("connection.php");

// Function to retrieve upskilling details from the database
function getUpskillingDetails() {
    global $conn;

    $userEmail = $_SESSION['email'];

    $query = "SELECT * FROM upskilling  WHERE user_email = '$userEmail'";
    $result = mysqli_query($conn, $query);

    $upskillingData = array();
    if($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $upskillingData[] = $row;
        }
    }
    return $upskillingData;
}

// Function to display upskilling details
function displayUpskillingDetails($upskillingData) {
    if(empty($upskillingData)) {
        echo "<p>No upskilling details available.</p>";
        return;
    }
    $counter = 1;
    echo "
    <table id='upskilling-details'>
        <thead>
            <tr>
                <th>S.No</th>
                <th>Type</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Department</th>
                <th>Organized By</th>
                <th>Link</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    ";
    foreach($upskillingData as $upskilling) {
        echo "<tr>";
        echo "<td>{$counter}</td>";
        echo "<td>{$upskilling['TYPE']}</td>";
        echo "<td>{$upskilling['FROM_DATE']}</td>";
        echo "<td>{$upskilling['TO_DATE']}</td>";
        echo "<td>{$upskilling['DEPARTMENT']}</td>";
        echo "<td>{$upskilling['ORGANIZED_BY']}</td>";
        echo "<td><a href='{$upskilling['LINK']}' target='_blank'>Link</a></td>";
        echo "
            <td>
                <form method='POST' action='edit-upskilling.php' style='display: inline;'>
                    <input type='hidden' name='id' value='{$upskilling['ID']}'>
                    <button type='submit' id='edit_button'>Edit</button>
                </form>
                <form method='POST' action='delete-upskilling.php' style='display: inline;'>
                    <input type='hidden' name='id' value='{$upskilling['ID']}'>
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
if(isset($_POST['addUpskilling'])) {
    // Retrieve form data
    $type = $_POST['upskilling-type'];
    $fromDate = $_POST['from-date'];
    $toDate = $_POST['to-date'];
    $department = $_POST['department'];
    $organizedBy = $_POST['organized-by'];
    $link = $_POST['link'];

    $userEmail = $_SESSION['email'];

    // Insert data into database
    $query = "INSERT INTO upskilling (user_email, TYPE, FROM_DATE, TO_DATE, DEPARTMENT, ORGANIZED_BY, LINK) VALUES ('$userEmail', '$type', '$fromDate', '$toDate', '$department', '$organizedBy', '$link')";
    $result = mysqli_query($conn, $query);

    if($result) {
        // Redirect to current page to display the newly added upskilling
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upskilling Page</title>
    <link rel="stylesheet" href="style2.css">
    <style>
        #add-upskilling-form {
            display: none;
        }
        #add-upskilling-button {
            display: block; /* Ensure the "Add New Career" button is visible */
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
        <li><a href="#" class="active">Upskilling</a></li>
        <li><a href="subjects.php">Subjects Taught</a></li>
        <li><a href="membership.php">Membership</a></li>
    </ul>
</div>

<main>
    <h2 style="margin-top:3px;">Upskilling</h2>
    <?php 
    $upskillingData = getUpskillingDetails(); 
    displayUpskillingDetails($upskillingData);
    ?>

    <!-- Add new upskilling form -->
    <div id="add-upskilling-container">
        <h3>Add New Upskilling</h3>
        <div id="add-upskilling-form">
            <form id="new-upskilling-form" method="POST">
                <label for="upskilling-type">Type:</label>
                <select id="upskilling-type" name="upskilling-type" required>
                    <option value="FDP">FDP</option>
                    <option value="STTP">STTP</option>
                    <option value="WORKSHOP">Workshop</option>
                    <option value="OTHER">Other</option>
                </select>

                <label for="from-date">From Date:</label>
                <input type="date" id="from-date" name="from-date" required>

                <label for="to-date">To Date:</label>
                <input type="date" id="to-date" name="to-date" required>

                <label for="department">Department:</label>
                <input type="text" id="department" name="department" placeholder="Department.." required>

                <label for="organized-by">Organized By:</label>
                <input type="text" id="organized-by" name="organized-by" placeholder="Organized By.." required>

                <label for="link">Link:</label>
                <input type="url" id="link" name="link" placeholder="Link..">

                <input type="submit" value="Add Upskilling" name="addUpskilling">
            </form>
        </div>
    </div>
    <button id="add-upskilling-button" onclick="showAddUpskillingForm()">Add New Upskilling</button>
</main>

<script>
    function showAddUpskillingForm() {
        var form = document.getElementById("add-upskilling-form");
        form.style.display = "block";
        var button = document.getElementById("add-upskilling-button");
        button.style.display = "none";
    }
</script>

</body>
</html>
