<?php
include "includes/common.php";

// Get the current date
$currentDate = date("Y-m-d");

// SQL query to delete expired coupons
$sql = "DELETE FROM coupons WHERE coupon_validity < '$currentDate'";

// Execute the query
if ($con->query($sql) === TRUE) {
    echo "Expired coupons deleted successfully";
} else {
    echo "Error deleting expired coupons: " . $con->error;
}

// Close the database connection
$con->close();
?>
