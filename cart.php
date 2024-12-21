
<?php
// Include common.php to establish database connection and perform any necessary initialization
include "includes/common.php";
if (!isset($_SESSION['email'])) {
    header('location: index.php');
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
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- Add any additional CSS styles -->
</head>
<body>
<?php include 'includes/header.php'; ?>
<div class="container">
    <h2>Shopping Cart</h2>
    <form id="cartForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table class="table" id="itemTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Action</th>
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
                        echo "<td>";
                        echo "<button type='button' class='btn btn-danger remove-item' data-id='" . $row["id"] . "'>Remove</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No items found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </form>
    <div>
        <h3>Total Amount: <span id="totalAmount"><?php echo $totalAmount; ?></span>
        <button type="button" id="confirmButton" class="btn btn-success">Pay</button></h3>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Update the total amount on page load
        var totalAmount = <?php echo $totalAmount; ?>;
        $('#totalAmount').text(totalAmount.toFixed(2));

        $('.remove-item').click(function() {
            var itemId = $(this).data('id');
            var coupon_price = $('#item-' + itemId).find('.coupon_price').text();

            // Remove the corresponding row from the table
            $('#item-' + itemId).remove();

            // Update the total amount
            totalAmount -= parseFloat(coupon_price);
            $('#totalAmount').text(totalAmount.toFixed(2));

            // Optional: Implement logic to remove item from cart using AJAX
            $.ajax({
                url: 'cart-remove.php', // Create this PHP file to handle the removal
                type: 'POST',
                data: { id: itemId },
                success: function(response) {
                    // Handle success response
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(error);
                }
            });
        });

        $('#confirmButton').click(function() {
            // Submit the form to process all items in the cart
            window.location.href = 'payfinal.php';
        });
    });
</script>
</body>
</html>
