<?php
include("connection.php");

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Delete the career record from the database
    $query = "DELETE FROM career WHERE ID = $id";
    $result = mysqli_query($conn, $query);
    
    if($result) {
        // Redirect back to the career page after deletion
        header("Location: career.php");
        exit;
    } else {
        // Handle error if deletion fails
        echo "Error deleting career record: " . mysqli_error($conn);
    }
}
?>
