<?php
// Require necessary files for database access and order management
require_once '../src/Database.php';
require_once '../src/OrderManager.php';

// Check if the request method is POST and the order_id is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    // Get a connection instance from the Database class
    $db = Database::getInstance()->getConnection();
    
    // Initialize the OrderManager with the database connection
    $orderManager = new OrderManager($db);
    
    // get the order ID from the POST data
    $order_id = $_POST['order_id'];
    
    // Call the deleteOrder method and store the success status
    $success = $orderManager->deleteOrder($order_id);
    
    // Check if the deletion was successful
    if ($success) {
        // Redirect to the add product page with a success message
        header('Location: add_product.php?msg=OrderDeleted');
    } else {
        // Redirect to the add product page with an error message
        header('Location: add_product.php?msg=OrderDeleteFailed');
    }
} else {
    // Redirect to the add product page if the request method is not POST or the order ID is not set
    header('Location: add_product.php');
}
// stop the script
exit();
?>
