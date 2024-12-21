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
        <title>CouponRevive | Upload Coupon</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/css.css" type="text/css">
    </head>
    <body>
     <?php include 'includes/header.php'; ?>
        
        <div class="container">
            <div class="row row_style1">
                <div class="col-xs-12 col-md-6">
                    <div class="row">
                        <div class="col-xs-8 col-xs-offset-2">
                            <img src="img/upload.jpg" width="500px" height="400px">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="row">
                        <div class="col-xs-10 col-xs-offset-1">
                            <h1>UPLOAD COUPON</h1>
                            <form action="uploadcoupon.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" autocomplete="off" required>
                                    <?php if (isset($_GET["m1"])) { echo $_GET['m1']; } ?>
                                </div>
                                 <div class="form-group">
                                    <select class="form-control" name="coupon_name" required>
                                        <option value="">Select Coupon Name</option>
                                        <option value="ajio">Ajio</option>
                                        <option value="amazon">Amazon</option>
                                        <option value="Amazon prime">Amazon prime</option>
                                        <option value="Araku Coffee INDIA">Araku Coffee INDIA</option>
                                        <option value="Aqualogica">Aqualogica</option>
                                        <option value="Audible">Audible</option>
                                        <option value="BBlunt">BBlunt</option>
                                        <option value="Boat">Boat</option>
                                        <option value="campus">Campus</option>
                                         <option value="Chokhi Dhani">Chokhi Dhani</option>
                                        <option value="Dominos">Dominos</option>
                                        <option value="flipcart">Flipkart</option>
                                        <option value="Fastrack">Fastrack</option>
                                        <option value="GRT">GRT</option>
                                        <option value="Himalayan Gatherer">Himalayan Gatherer</option>
                                        <option value="Icruze">Icruze</option>
                                        <option value="Jiosaavn">Jiosaavn</option>
                                        <option value="kfc">KFC</option>
                                        <option value="lensKart">Lenskart</option>
                                        <option value="make my trip">Make My Trip</option>
                                        <option value="mama earth">Mama Earth</option>
                                        <option value="myntra">Myntra</option>
                                        <option value="Noise">Noise</option>
                                        <option value="Nykaa">Nykaa</option>
                                        <option value="Ott play">Ott play</option>
                                        <option value="Pizza Hut">Pizza Hut</option>
                                         <option value="pluckk">pluckk</option>
                                        <option value="Ponds">Ponds</option>
                                        <option value="Puma">Puma</option>
                                        <option value="Red Rail">Red Rail</option>
                                        <option value="Renee">Renee</option>
                                        <option value="swiggy">Swiggy</option>
                                        <option value="Tiggle">Tiggle</option>
                                        <option value="W">W</option>
                                        <option value="zanducare">Zanducare</option>
                                        <option value="ZEE5">ZEE5</option>
                                        <option value="Zepto">Zepto</option>
                                        <option value="zomato">Zomato</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="coupon_category" required>
                                        <option value="">Select Coupon Category</option>
                                        <option value="Fashion&Clothing">Fashion & Clothing</option>
                                        <option value="Food">Food</option>
                                        <option value="Beauty">Beauty</option>
                                        <option value="Others">Others</option>
                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" placeholder="User ID" name="user_id">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Coupon Description" name="coupon_description" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Coupon Code" name="coupon_code" pattern=".{6,}" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <input type="coupon_price" class="form-control" placeholder="Coupon Price" name="coupon_price" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control" placeholder="Coupon Validity" name="coupon_validity" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <input type="file" class="form-control" name="coupon_image" accept="image/*" required><br>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
 
    </body>
</html>
