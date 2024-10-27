<?php
// Assuming you've included the connection.php file
include("connection.php");

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Delete the research record from the database
    $query = "DELETE FROM research WHERE ID = $id";
    $result = mysqli_query($conn, $query);
    
    if($result) {
        // Redirect back to the research page after deletion
        header("Location: research.php");
        exit;
    } else {
        // Handle error if deletion fails
        echo "Error deleting research record: " . mysqli_error($conn);
    }
}
?>
