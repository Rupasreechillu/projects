<?php
include("connection.php");

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Delete the upskilling record from the database
    $query = "DELETE FROM upskilling WHERE ID = $id";
    $result = mysqli_query($conn, $query);
    
    if($result) {
        // Redirect back to the upskilling page after deletion
        header("Location: upskilling.php");
        exit;
    } else {
        // Handle error if deletion fails
        echo "Error deleting upskilling record: " . mysqli_error($conn);
    }
}
?>
