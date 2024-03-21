<?php
// Include needed classes
require_once '../src/Database.php';
require_once '../src/ProductManager.php';

// Check if the form was submitted using POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve product details from the POST data
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Get a database connection instance
    $db = Database::getInstance()->getConnection();

    // Initialize ProductManager with the database connection
    $productManager = new ProductManager($db);
    
    //update the product with the given details
    if ($productManager->updateProduct($product_id, $name, $category_id, $price, $description)) {
        // If the update is successful, redirect to the add product page with a success message
        header('Location: add_product.php?update=success');
    } else {
        // If the update fails, display an error message
        echo "Failed to update product.";
    }
}
?>
