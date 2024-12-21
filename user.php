<?php
require("includes/common.php");
if (!isset($_SESSION['email'])) {
    header('location: index.php');
}

// Fetch user details
$user_email = $_SESSION['email'];
$query = "SELECT id, email FROM users WHERE email='$user_email'";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$user = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>E-Store | Settings</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/css.css" type="text/css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="container"><br><br><br><br>
        <div class="row row_style4">
            <div class="col-xs-4 col-xs-offset-4">
                <h1>Account Details</h1>
                <div class="account-info">
                    <label for="userId">User ID:</label>
                    <input type="text" id="userId" class="form-control" value="<?php echo $user['id']; ?>" readonly>
                </div>
                <div class="account-info">
                    <label for="emailId">Email ID:</label>
                    <input type="email" id="emailId" class="form-control" value="<?php echo $user['email']; ?>" readonly>
                </div>
                <h1>Change Password</h1>
                <div><b class="red">
                    <?php
                    if(isset($_GET["error"])){
                      echo $_GET['error'];
                    }
                    ?>
                </b></div>
                <form action="settings_script.php" method="POST">
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Old Password" name="oldpassword">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="New Password" name="newpassword">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Re-type New Password" name="renewpassword">
                    </div>
                    <button class="btn btn-primary">Change</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
