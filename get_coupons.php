<?php
// Include your database connection logic here (e.g., require("includes/db_connection.php"))

require("includes/common.php");

// Assuming you have a function to check if a coupon is added to the cart
// Include the function definition here (e.g., require("includes/cart_functions.php"))
require("cart-add.php");

// Assume a function to sanitize user input
function sanitize($input) {
    return htmlspecialchars(trim($input));
}

// Get search input and category filter from the request
$searchInput = isset($_GET['searchInput']) ? sanitize($_GET['searchInput']) : '';
$categoryFilter = isset($_GET['categoryFilter']) ? sanitize($_GET['categoryFilter']) : 'all';

// Construct the SQL query based on search criteria
$sql = "SELECT * FROM coupons WHERE 
        (name LIKE '%$searchInput%' OR description LIKE '%$searchInput%')
        AND (category = '$categoryFilter' OR '$categoryFilter' = 'all')";

// Execute the query
$result = $con->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Fetch and display the coupons in a Bootstrap grid
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><?php echo $row['category']; ?></h4>
                </div>
                <div class="thumbnail">
                    <img src="<?php echo $row['image_url']; ?>" alt="Coupon Image">
                    <div class="caption">
                        <p>
                            <b><?php echo $row['name']; ?></b><br>
                            <?php echo $row['description']; ?>
                        </p>
                        <?php 
                        if (check_if_added_to_cart($row['id'])) {
                            echo '<a href="#" class="btn btn-block btn-success" disabled>Added to cart</a>';
                        } else {
                        ?>
                            <a href="cart-add.php?id=<?php echo $row['id']; ?>" name="add" value="add" class="btn btn-block btn-primary">Add to cart</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    // No coupons found
    echo "No coupons found.";
}

// Close the database connection
$conn->close();
?>
