<?php
include("connection.php");

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Delete membership entry from the database
    $query = "DELETE FROM membership WHERE ID = $id";
    $result = mysqli_query($conn, $query);

    if($result) {
        // Redirect to membership page
        header("Location: membership.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
        exit;
    }
} else {
    echo "Error: No membership ID provided.";
    exit;
}
?>
