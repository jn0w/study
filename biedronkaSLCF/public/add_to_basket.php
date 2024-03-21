<?php

session_start();

// Initialize the basket in the session if it doesn't exist
if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = [];
}

// Check if the form has been submitted with a product ID and quantity
if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    // Retrieve product ID and quantity from the POST request and ensure quantity is an integer
    $productId = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    // Check that the quantity is greater than 0
    if ($quantity > 0) {
        // If the product already exists in the basket, ++ the quantity
        if (isset($_SESSION['basket'][$productId])) {
            $_SESSION['basket'][$productId] += $quantity;
        } else {
            // If the product is not in the basket, add it with the specified quantity
            $_SESSION['basket'][$productId] = $quantity;
        }
        
        // Success message
        $_SESSION['success_message'] = 'Product added to basket successfully.';
    } else {
        // Error message
        $_SESSION['error_message'] = 'Invalid quantity.';
    }
} else {
    // Set an error message if the product ID or quantity is missing from the POST request
    $_SESSION['error_message'] = 'Product ID or quantity missing.';
}

// Move the user back to the products page
header('Location: products.php');
exit(); // Terminate the execution of the script
?>
