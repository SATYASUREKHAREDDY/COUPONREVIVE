<?php
// Include common.php to establish database connection and perform any necessary initialization
include "includes/common.php";
if (!isset($_SESSION['email'])) {
    header('location: index.php');
    exit();
}

// Ensure that the user_id is correctly retrieved from the session
$user_id = $_SESSION['user_id'];

// Query to fetch confirmed items from users_items table for the logged-in user
$sql = "SELECT item_id, coupon_price, timestamp FROM confirmed WHERE user_id = $user_id";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Success</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- Add any additional CSS styles -->
</head>
<body>
<?php include 'includes/header.php'; ?>
<div class="container">
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>Item ID</th>
                <th>Price</th>
                <th>Order Time</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['item_id'] . "</td>";
                    echo "<td>" . $row['coupon_price'] . "</td>";
                    echo "<td>" . $row['timestamp'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No items found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
