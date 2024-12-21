<?php
    include 'includes/modal.php';
    include "includes/common.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>FORGOT PASSWORD</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/css.css" type="text/css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .forgot-password-container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            margin-bottom: 1rem;
        }
        .btn-primary {
            width: 100%;
        }
        .form-header {
            margin-bottom: 1.5rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="forgot-password-container">
        <h2 class="form-header">Forgot Password</h2>
        <form action="forgot_pass_submit.php" method="POST">
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Enter email" name="email" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="New Password" name="newpassword" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Password</button>
        </form>
    </div>
</body>
</html>
