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
$sql = "SELECT c.coupon_id, c.coupon_name, cf.processed FROM coupons c LEFT JOIN confirmed cf ON c.coupon_id = cf.coupon_id WHERE c.user_id = $user_id";
$result = $con->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Coupons Added</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/css.css" type="text/css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
          <div class="container">
            <h1><br><br>COUPONS ADDED BY YOU</h1>
            <button class="btn btn-info mb-3" type="button" data-toggle="collapse" data-target="#couponsSection" aria-expanded="false" aria-controls="couponsSection">
                Show/Hide Coupons
            </button>
            <div class="collapse" id="couponsSection">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Coupon ID</th>
                            <th>Coupon Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $status = $row['processed'] == 1 ? 'Sold' : 'Not Sold';
                                echo "<tr>";
                                echo "<td>" . $row['coupon_id'] . "</td>";
                                echo "<td>" . $row['coupon_name'] . "</td>";
                                echo "<td>" . $status . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No items found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>  
   
</body>
</html>
