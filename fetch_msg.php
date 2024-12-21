<?php
require("includes/db_connection.php");

// Assuming user_id is obtained from the session after login
$user_id = $_SESSION['user_id'];

// Fetch messages for the user
$sql = "SELECT m.*, c.coupon_name, u.username AS sender_username
        FROM messages m
        JOIN coupons c ON m.coupon_id = c.coupon_id
        JOIN users u ON m.sender_id = u.user_id
        WHERE m.receiver_id = $user_id
        ORDER BY m.timestamp DESC";

$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<p><strong>From:</strong> " . $row["sender_username"] . "</p>";
        echo "<p><strong>Coupon:</strong> " . $row["coupon_name"] . "</p>";
        echo "<p><strong>Message:</strong> " . $row["message_text"] . "</p>";
        echo "<p><strong>Timestamp:</strong> " . $row["timestamp"] . "</p>";
        echo "</div>";
    }
} else {
    echo "No messages found.";
}

$conn->close();
?>
