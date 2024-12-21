<?php
// Include common.php to establish database connection and perform any necessary initialization
include "includes/common.php";
if (!isset($_SESSION['email'])) {
    header('location: index.php');
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process all items in the cart
    $sql = "SELECT * FROM cart WHERE processed = 0";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        // Start a transaction
        $con->begin_transaction();

        try {
            while ($row = $result->fetch_assoc()) {
                $userId = $_SESSION['user_id'];
                $itemId = $row['id'];
                $coupon_price = $row['coupon_price'];
                $coupon_id = $row['coupon_id'];
                $insertQuery = "INSERT INTO confirmed (user_id, item_id, coupon_id, coupon_price, processed) VALUES ($userId, '$itemId', '$coupon_id', '$coupon_price', 1)";
                $con->query($insertQuery);

                // Mark item as processed
                $updateQuery = "UPDATE cart SET processed = 1 WHERE id = $itemId";
                $con->query($updateQuery);
            }

            // Commit the transaction
            $con->commit();

            // Redirect to success.php
            header('location: success.php');
            exit;
        } catch (Exception $e) {
            // Rollback the transaction if any error occurs
            $con->rollback();
            throw $e;
        }
    }
}
// Query to fetch details from items table
$sql = "SELECT * FROM cart WHERE processed = 0";
$result = $con->query($sql);
// Initialize total amount
$totalAmount = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>BILL</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- Add any additional CSS styles -->
</head>
<body>
<?php include 'includes/header.php'; ?>
<div class="container">
    <h2>BILL</h2>
    <form id="cartForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table class="table" id="itemTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $totalAmount += $row["coupon_price"];
                        echo "<tr id='item-" . $row["id"] . "'>";
                        echo "<td>" . $row["coupon_name"] . "</td>";
                        echo "<td class='coupon_price'>" . $row["coupon_price"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No items found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </form>
    <div>
        <h3>Total Amount: <span id="totalAmount"><?php echo $totalAmount; ?></span>
        <button type="button" id="confirmButton" class="btn btn-success">Confirm</button>
        <button type="button" id="cancelButton" class="btn btn-danger">Cancel</button></h3>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Update the total amount on page load
        var totalAmount = <?php echo $totalAmount; ?>;
        $('#totalAmount').text(totalAmount.toFixed(2));

        $('#confirmButton').click(function() {
            // Submit the form to process all items in the cart
            $('#cartForm').submit();
        });

        $('#cancelButton').click(function() {
            // Redirect to new1.php
            window.location.href = 'cart.php';
        });
    });
</script>
</body>
</html>
