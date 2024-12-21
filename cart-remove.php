<?php
include "includes/common.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemId = intval($_POST['id']);
    // Delete the item from the database or session
    // For example:
    $deleteQuery = "DELETE FROM cart WHERE id = $itemId AND user_id = " . $_SESSION['user_id'];
    if ($con->query($deleteQuery) === TRUE) {
        echo "Item removed successfully";
    } else {
        echo "Error removing item: " . $con->error;
    }
}
?>
