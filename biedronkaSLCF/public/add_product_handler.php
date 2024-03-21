<?php

// Include the necessary classes for product management
require_once '../src/ProductManager.php';
require_once '../src/Product.php';

// Check if the form was submitted via POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Retrieve form data
    $name = $_POST['name'];
    $category = $_POST['category']; 
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Create a new Product object with the retrieved data
    $product = new Product(null, $name, $price, $description, $category);

    // Initialize the ProductManager
    $productManager = new ProductManager();
    // Use ProductManager to add the Product to the database and retrieve the new product ID
    $productId = $productManager->addProduct($product);

    // Check if a new product ID was returned, indicating a successful addition
    if ($productId) {
        // Output success message
        echo "Product added successfully. Product ID is: " . $productId;
    } else {
        // Output failure message
        echo "Failed to add the product.";
    }

    // Provide a link to add another product
    echo '<a href="add_product.php"><button type="button">Add Another Product</button></a>';
}
?>
