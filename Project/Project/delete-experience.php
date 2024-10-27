<?php
include("connection.php");

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Delete the experience record from the database
    $query = "DELETE FROM experience WHERE ID = $id";
    $result = mysqli_query($conn, $query);
    
    if($result) {
        // Redirect back to the experience page after deletion
        header("Location: experience.php");
        exit;
    } else {
        // Handle error if deletion fails
        echo "Error deleting experience record: " . mysqli_error($conn);
    }
}
?>
