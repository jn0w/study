<?php
// Start session
session_start();

// Include necessary classes
require_once '../src/Database.php';
require_once '../src/ProductManager.php';
require_once '../src/Product.php';

// connection to the database
$db = Database::getInstance()->getConnection();

// Initialize ProductManager with the database connection
$productManager = new ProductManager($db);

// Check if the form was submitted via POST and if the shopping basket is not empty
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['basket'])) {
    // Retrieve user ID if the user is logged in, null if not logged in
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // Collect order information from the POST request
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contactNumber = $_POST['contact_number'];
    $email = $_POST['email'];
    $paymentMethod = $_POST['payment_method'];

    // Initialize total price to 0
    $totalPrice = 0;
    // Calculate the total price of the items in the basket
    foreach ($_SESSION['basket'] as $productId => $quantity) {
        // Retrieve each product by ID
        $product = $productManager->getProductById($productId);
        // Check if the returned $product is an instance of Product class
        if ($product instanceof Product) { 
            // Add the product's price * by its quantity to the total price
            $totalPrice += $product->getPrice() * $quantity;
        }
    }

    try {
        // Begin a transaction
        $db->beginTransaction();

        //SQL statement to insert order data into the guest_orders table
        $insertOrderSql = "INSERT INTO guest_orders (user_id, name, address, contact_number, email, payment_method, status, total_price) VALUES (?, ?, ?, ?, ?, ?, 'Pending', ?)";
        $orderStmt = $db->prepare($insertOrderSql);
        // Execute the prepared statement with the collected data
        $orderStmt->execute([$userId, $name, $address, $contactNumber, $email, $paymentMethod, $totalPrice]);
        // Retrieve the ID of the newly created order
        $orderId = $db->lastInsertId();

        //SQL statement to insert items into the order_items table
        $insertItemSql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $itemStmt = $db->prepare($insertItemSql);
        // Loop through each item in the basket and insert it into the order_items table
        foreach ($_SESSION['basket'] as $productId => $quantity) {
            $product = $productManager->getProductById($productId);
            if ($product instanceof Product) {
                $itemStmt->execute([$orderId, $productId, $quantity, $product->getPrice()]);
            }
        }

        // Commit the transaction to finish the order creation
        $db->commit();

        // Clear the session basket and move to the order confirmation page
        $_SESSION['basket'] = [];
        header('Location: order_confirmation.php?order_id=' . $orderId);
        exit();
    } catch (Exception $e) {
        // If an error occurs, rollback the transaction
        $db->rollBack();
        exit('Order placement failed: ' . $e->getMessage());
    }
} else {
    // If the request method is not POST or the basket is empty, redirect to the checkout page
    header('Location: checkout.php');
    exit();
}
?>
