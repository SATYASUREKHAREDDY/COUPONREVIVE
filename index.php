<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CouponRevive</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/css.css" type="text/css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }

        header {
            height: 120px;
        }

        #content {
            min-height: calc(100% - 240px);
        }

        .banner {
            background-image: url('img/app2.jpg');
            height: 100vh;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            padding: 20px;
        }

        .banner .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            flex-direction: column;
            margin-left: 10%;
        }

        .banner h1 {
            font-size: 4vw; /* Responsive font size */
        }

        @media (max-width: 768px) {
            .banner h1 {
                font-size: 6vw; /* Adjust font size for smaller screens */
            }

            #banner_content {
                padding-top: 10%;
                padding-bottom: 10%;
                margin-top: 0;
                margin-bottom: 0;
            }
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?> 

    <div id="content">
        <div class="banner">
            <div class="container">
                <div id="banner_content">
                    <h1>CouponRevive</h1>
                    <br>
                    <br>
                    <button class="btn btn-default btn-lg active" data-toggle="modal" data-target="#loginmodal">Shop Now</button>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript -->
    <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
