<?php
// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "mssreddy1706";
$dbname = "ecommerce";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Error reporting and debugging
error_reporting(E_ALL);
ini_set('display_errors', '1');

echo "Reached point A"; // Debug statement

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Form submitted"; // Debug statement

    // Collect form data
    $coupon_id = $_POST['coupon_id'];
    $user_id = $_POST['user_id'];
    $coupon_category=$_POST['coupon_category'];
    $coupon_name = $_POST['coupon_name'];
    $coupon_description = $_POST['coupon_description'];
    $coupon_code=$_POST['coupon_code'];
    $coupon_price=$_POST['coupon_price'];
    $coupon_validity=$_POST['coupon_validity'];
    // File handling
    $target_dir = "uploads1/"; // Directory to store coupon images

    if (isset($_FILES["coupon_image"]) && $_FILES["coupon_image"]["error"] == 0) {
        $target_file = $target_dir . basename($_FILES["coupon_image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($_FILES["coupon_image"]["tmp_name"]);
        if ($check !== false) {
            // Allow only certain file formats
            $allowed_types = array("jpg", "jpeg", "png", "gif");
            if (in_array($imageFileType, $allowed_types)) {
                // Move the uploaded file to the specified directory
                if (move_uploaded_file($_FILES["coupon_image"]["tmp_name"], $target_file)) {
                    // Insert data into database using prepared statement
                    $sql = "INSERT INTO coupons (coupon_id,user_id,coupon_category,coupon_name,coupon_description,coupon_code,coupon_price,coupon_validity,coupon_image) 
                            VALUES (?,?,?,?,?,?,?,?,?)";
                    $stmt = $con->prepare($sql);
                    $stmt->bind_param("sssssssss", $coupon_id,$user_id,$coupon_category,$coupon_name, $coupon_description,$coupon_code,$coupon_price,$coupon_validity, $target_file);
                    if ($stmt->execute()) {
                        header("Location:products.php");
                        exit();
                    } else {
                        echo "Error executing statement: " . $stmt->error;
                    }
                } else {
                    echo "Failed to move the uploaded file.";
                }
            } else {
                echo "Invalid file format. Only JPG, JPEG, PNG, and GIF files are allowed.";
            }
        } else {
            echo "The uploaded file is not an image.";
        }
    } else {
        echo "Error uploading file: " . $_FILES["coupon_image"]["error"];
    }
}

// Close database connection
$conn->close();
?>
