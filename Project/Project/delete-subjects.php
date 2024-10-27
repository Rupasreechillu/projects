<?php
include("connection.php");

// Check if ID is provided
if(isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Delete subject from the database
    $deleteQuery = "DELETE FROM subjects_taught WHERE ID = $id";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if($deleteResult) {
        // Redirect back to the subjects page after deletion
        header("Location: subjects.php");
        exit;
    } else {
        // Handle error if deletion fails
        echo "Error deleting subject record: " . mysqli_error($conn);
    }
} else {
    // If no ID provided, display an error message
    echo "Error: No subject ID provided.";
}
?>
