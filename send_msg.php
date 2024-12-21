<?php
require("includes/db_connection.php");

// Assuming user_id is obtained from the session after login
$sender_id = $_SESSION['user_id'];

// Get data from the frontend
$coupon_id = $_POST['coupon_id'];
$receiver_id = $_POST['receiver_id'];
$message_text = $_POST['message_text'];

// Insert the message into the database
$sql = "INSERT INTO messages (coupon_id, sender_id, receiver_id, message_text)
        VALUES ($coupon_id, $sender_id, $receiver_id, '$message_text')";

if ($conn->query($sql) === TRUE) {
    echo "Message sent successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
