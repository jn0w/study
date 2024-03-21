<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Basket - Biedronka Grocery Store</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .basket-container {
            background-color: #ffffff;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .basket-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .basket-item:last-child {
            border-bottom: none;
        }

        .item-name, .item-quantity, .item-price, .item-subtotal {
            margin: 0 10px;
        }

        .remove-button {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .remove-button:hover {
            background-color: #0056b3;
        }

        .total-price {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .action-buttons {
            text-align: center;
            margin-top: 20px;
        }

        .action-buttons a {
            text-decoration: none;
            color: white;
            background-color: #007bff;
            padding: 10px 15px;
            border-radius: 4px;
            margin: 0 10px;
        }

        .action-buttons a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php 
session_start(); 
include 'navbar.php'; 
require_once '../src/ProductManager.php'; 
//create a new product manager instance
$productManager = new ProductManager();
//variable to store the total price
$totalPrice = 0;
?>

<div class="basket-container">
    <?php
    // Check if the basket session variable exists and is not empty
    if (!isset($_SESSION['basket']) || empty($_SESSION['basket'])) {
        echo "<p>Your basket is empty.</p>";
    } else {
        echo "<h1>Your Basket</h1>";

        //loop through each item in the basket
        foreach ($_SESSION['basket'] as $productId => $quantity) {
            //get product details from database
            $product = $productManager->getProductById($productId);
            if ($product) {
                echo "<div class='basket-item'>";
                echo "<span class='item-name'>" . htmlspecialchars($product->getName()) . "</span>";
                echo "<span class='item-quantity'>Quantity: " . htmlspecialchars($quantity) . "</span>";
                echo "<span class='item-price'>Price: €" . htmlspecialchars(number_format($product->getPrice(), 2)) . "</span>";
                echo "<span class='item-subtotal'>Subtotal: €" . htmlspecialchars(number_format($product->getPrice() * $quantity, 2)) . "</span>";
                echo "<form method='post' action='remove_from_basket.php' style='display: inline;'>";
                echo "<input type='hidden' name='product_id' value='" . htmlspecialchars($product->getId()) . "'>";
                echo "<button type='submit' class='remove-button'>Remove</button>";
                echo "</form>";
                echo "</div>";

                $totalPrice += ($product->getPrice() * $quantity);
            }
        }

        echo "<div class='total-price'>Total Price: €" . number_format($totalPrice, 2) . "</div>";
    }
    ?>
    <div class="action-buttons">
        <a href="products.php">Continue Shopping</a>
        <a href="checkout.php">Checkout</a>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
