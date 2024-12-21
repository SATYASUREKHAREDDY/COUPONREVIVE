<?php
include 'includes/common.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $newPassword = $_POST['newpassword'];

    if (empty($email) || empty($newPassword)) {
        echo "<script>alert('Email and password fields cannot be empty.'); window.location.href='index.php';</script>";
        exit();
    }
    // Check if the email exists in the users table
    $checkEmailQuery = "SELECT * FROM users WHERE email = ?";
    if ($stmt = $con->prepare($checkEmailQuery)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // Email found, update the password
            $updatePasswordQuery = "UPDATE users SET password = ? WHERE email = ?";
            if ($updateStmt = $con->prepare($updatePasswordQuery)) {
                $updateStmt->bind_param("ss", $newPassword, $email);
                if ($updateStmt->execute()) {
                    echo "<script>alert('Password updated successfully.'); window.location.href='index.php';</script>";
                } else {
                    echo "<script>alert('Error updating password.'); window.location.href='index.php';</script>";
                }
                $updateStmt->close();
            } else {
                echo "<script>alert('Error preparing update statement.'); window.location.href='index.php';</script>";
            }
        } else {
            // Email not found
            echo "<script>alert('Email not found Please register!!'); window.location.href='index.php';</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing email check statement.'); window.location.href='index.php';</script>";
    }
    $conn->close();
} else {
    echo "<script>alert('Invalid request method.'); window.location.href='index.php';</script>";
}
?>
