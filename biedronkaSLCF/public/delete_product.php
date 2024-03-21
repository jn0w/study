<?php
//include the ProductManager class to use its deleteProduct method
require_once '../src/ProductManager.php';

// Check if the server request method is POST and the product_id is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    // get the product ID from the POST data
    $productId = $_POST['product_id'];
    
    // Instantiate the ProductManager
    $productManager = new ProductManager();
    // Use the ProductManager to attempt to delete the product by its ID
    $deleted = $productManager->deleteProduct($productId);
    
    if ($deleted) {
        
        header('Location: add_product.php?message=Product+Deleted+Successfully');
    } else {
        
        header('Location: add_product.php?error=Unable+to+Delete+Product');
    }
} else {
    
    header('Location: add_product.php');
}
