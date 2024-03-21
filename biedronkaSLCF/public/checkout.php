<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Biedronka Grocery Store</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .checkout-container {
            background-color: #ffffff;
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        form h2 {
            text-align: center;
        }

        form label {
            margin: 10px 0 5px;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="number"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: calc(100% - 22px);
        }

        form button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="checkout-container">
        <h2>Checkout</h2>
        <form method="post" action="process_checkout.php">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="contact_number">Contact Number:</label>
            <input type="text" id="contact_number" name="contact_number" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="payment_method">Payment Method:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="Credit Card">Credit Card</option>
                <option value="Debit Card">Debit Card</option>
                <option value="PayPal">PayPal</option>
            </select>

            <button type="submit">Place Order</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
