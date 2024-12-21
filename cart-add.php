<?php
// Include common.php to establish database connection
include "includes/common.php";
if (!isset($_SESSION['email'])) {
    header('location: index.php');
}
// Check if the request is AJAX and POST 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json'); 
    // Retrieve coupon ID from POST data
    $coupon_id = $_POST['id'];
    $coupon_name=$_POST['name'];
    $user_id = $_SESSION['user_id']; 
    $coupon_price=$_POST['coupon_price'];
    // Assuming user_id is stored in session
    // Insert coupon into the cart (items table)
    $sql = "INSERT INTO cart (user_id, coupon_id,coupon_name,coupon_price) VALUES ('$user_id','$coupon_id','$coupon_name','$coupon_price')";
    if ($con->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $con->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>