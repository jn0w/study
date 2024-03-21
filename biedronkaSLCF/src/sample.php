<?php

require_once 'Database.php'; // Path to your Database class
require_once 'ProductManager.php'; // Path to your ProductManager class
require_once 'Product.php'; // Path to your Product class

// Assuming your Database class setup correctly connects to your database
$dbInstance = Database::getInstance();
$db = $dbInstance->getConnection();

// Create an instance of ProductManager with the database connection
$productManager = new ProductManager($db);

// Create a new Product object
$Orange = new Product(null, "Orange", 1.00, "Fresh orange from spain", "Fruit");

// Add the product to the database and get its ID
$productId = $productManager->addProduct($Orange);

echo "Added new product with ID: $productId";
