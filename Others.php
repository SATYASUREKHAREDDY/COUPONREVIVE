<?php
// Include common.php to establish database connection and perform any necessary initialization
include "includes/common.php";
if (!isset($_SESSION['email'])) {
    header('location: index.php');
}

// Check if a search term is set
$search_term = '';
if (isset($_GET['search'])) {
    $search_term = $_GET['search'];
}

// Query to fetch details from coupons table based on the search term and category
$sql = "SELECT t1.*, 
               CASE 
                   WHEN t2.coupon_id IS NOT NULL THEN 'Unavailable'
                   ELSE 'Available'
               END AS status
        FROM coupons t1
        LEFT JOIN confirmed t2 ON t1.coupon_id = t2.coupon_id
        AND t2.confirmed_at > NOW() - INTERVAL 24 HOUR
        WHERE t1.coupon_category = 'Others'";

if (!empty($search_term)) {
    $sql .= " AND t1.coupon_name LIKE ?";
    $search_term = "%$search_term%";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $search_term);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Coupons|Fashion&Clothing</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/css.css" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .coupon {
            border: 1px solid #ddd;
            margin: 10px;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 350px; /* Adjust the minimum height as needed */
        }
        .coupon img {
            max-width: 100%;
            height: 200px;
        }
        .coupon-details {
            margin-top: 10px;
            text-align: left;
            flex-grow: 1;
        }
        .coupon-details div {
            margin-bottom: 5px;
        }
        .unavailable {
            opacity: 0.6;
            pointer-events: none;
        }
    </style>
</head>
<body>
<?php 
// Include header.php for navigation/header
include 'includes/header.php'; 
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xs-12 text-center">
            <h2>Others</h2>
            
            <div class="row search-category">
                <!-- Categories Dropdown -->
                <div class="col-md-6 text-left">
                    <form method="GET" action="" class="form-inline">
                        <select id="pageSelect" onchange="redirectToPage()" name="coupon_category" class="form-control mb-2 mr-sm-2">
                            <option value="">Coupon Category</option>
                            <option value="products.php">All</option>
                            <option value="Fashion&Clothing.php">Fashion & Clothing</option>
                            <option value="Food.php">Food</option>
                            <option value="Beauty.php">Beauty</option>
                            <option value="Others.php">Others</option>
                        </select>
                    </form>
                </div>

                <!-- Search Form -->
                <div class="col-md-6 text-right">
                    <form method="GET" action="" class="form-inline">
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" name="search" class="form-control" placeholder="Search for coupons..." value="<?php echo htmlspecialchars($search_term); ?>">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Search</button>
                    </form>
                </div>
            </div>
            
            <div class="row">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        if ($row['status'] == 'Unavailable') {
                            $couponClass = 'unavailable';
                        } else {
                            $couponClass = '';
                        }
                        echo "<div class='col-md-3 col-sm-6 d-flex'>";
                        echo "<div class='coupon $couponClass'>";
                        echo "<div class='coupon-image'><img src='" . $row["coupon_image"] . "' alt='Coupon Image'></div>";
                        echo "<div class='coupon-details'>";
                        echo "<div><strong>Description:</strong> " . $row["coupon_description"] . "</div>";
                        echo "<div><strong>Price:</strong> " . $row["coupon_price"] . "</div>";
                        echo "<div><strong>Validity:</strong> " . $row["coupon_validity"] . "</div>";
                        echo "<div><strong>Status:</strong> " . $row["status"] . "</div>";
                        echo "</div>"; // Close coupon-details
                        if ($row['status'] == 'Available') {
                            echo "<button class='btn btn-primary add-to-cart mt-auto' data-id='" . $row["coupon_id"] . "' data-name='" . $row["coupon_name"] . "' data-coupon_price='" . $row["coupon_price"] . "'>Add to Cart</button>";
                        } else {
                            echo "<button class='btn btn-secondary mt-auto' disabled>Unavailable</button>";
                        }
                        echo "</div>"; // Close coupon
                        echo "</div>"; // Close column
                    }
                } else {
                    echo "<div>No coupons found</div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    function redirectToPage(){
        var select=document.getElementById("pageSelect");
        var selectedvalue=select.options[select.selectedIndex].value;
        if(selectedvalue){
          window.location.href=selectedvalue;
         }
         }
    $(document).ready(function() {
        $('.add-to-cart').click(function() {
            var button = $(this);
            var couponId = button.data('id');
            var couponName = button.data('name');
            var couponPrice=button.data('coupon_price');
            $.ajax({
                url: 'cart-add.php',
                type: 'POST',
                data: { id: couponId, name: couponName, coupon_price:couponPrice},
                dataType: 'json', // Specify JSON as the expected data type
                success: function(response) {
                    if (response.success) {
                        button.text('Added to Cart');
                        button.prop('disabled', true);
                    } else {
                        alert('Failed to add to cart: ' + response.message); // Display the error message from the response
                    }
                },
                error: function(xhr, status, error) { // Handle AJAX errors
                    alert('Error in adding to cart: ' + error); // Display the error message
                }
            });
        });
    });
</script>
</body>
</html>
