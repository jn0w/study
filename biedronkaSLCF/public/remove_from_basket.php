<?php
// Start session
session_start();

// Check if a product ID has been submitted through POST
if (isset($_POST['product_id'])) {
    // Retrieve the product ID from the POST data
    $productId = $_POST['product_id'];

    // Check if the product ID exists in the 'basket' session array
    if (isset($_SESSION['basket'][$productId])) {
        // If the product is in the basket, remove it
        unset($_SESSION['basket'][$productId]);
        
        // Set a session message indicating the item was successfully removed
        $_SESSION['message'] = "Item removed successfully.";
    }
}

// move the user back to the view_basket.php page
header('Location: view_basket.php');
// Terminate the script
exit();
?>
