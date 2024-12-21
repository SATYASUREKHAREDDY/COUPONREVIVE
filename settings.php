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
<html>
<head>
  <title>E-Store | Settings</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/css.css" type="text/css">
<style>  /* MAIN SECTION */
main{
    width: 95%;
    margin: auto;
    display: flex;
    justify-content: space-between;
}
main > #content{
    width: 100%;
}
#content_head{
    margin-top: 2rem;
}
#content > #category{
    width: 100%;
    height:70%;
    padding-top:8rem;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-template-areas: 
    "one two three";

    column-gap: 2rem;
}
#category div:nth-child(1){
    grid-area: one;
}
#category div:nth-child(2){
    grid-area: two;
}
#category div:nth-child(3){
    grid-area: three;
}
}
#category img{
    width: 100%;
    transition: 300ms all ease-in-out;
    border-radius:5%;
}

#category > div{
    overflow: hidden;
    cursor: pointer;
    border-radius:5%;
}
#category > div:hover img{
    transform:  scale(1.08);
}</style>
</head>
<body>
<?php include 'includes/header.php'; ?>
 <!-- MAIN CONTAINER -->
   <main>
       <div id="content">
           <h1 class="brand_heading" id="content_head"><br></h1>
           <div id="category">
               <div><a href="user.php"><img src="img/user.jpg" alt="User Details"></a></div>
               
               <div><a href="cadded.php"><img src="img/uploads.jpg" alt="Coupons Added by you"></a></div>
               <div><a href="success.php"><img src="img/cart.jpg" alt="coupons used by you"></a></div>
           </div>
       </div>
       </main>
</body>
</html>
