<?php
error_reporting(0);
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "profile1";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>