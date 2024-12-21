<?php
session_start();

// Database connection code here
$servername = "localhost";
$username = "root";
$password = "mssreddy1706";
$dbname = "ecommerce";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
