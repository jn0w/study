<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Biedronka Grocery Store</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        
        form {
            background-color: #ffffff;
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin-bottom: 10px;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        form input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        
        nav {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>
    <h2>Register an Account</h2>
    <form method="post" action="register_user.php">
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" id="firstname" required>

        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" id="lastname" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <label for="address">Address:</label>
        <input type="text" name="address" id="address">

        <label for="contact_number">Contact Number:</label>
        <input type="text" name="contact_number" id="contact_number">

        <!-- This hidden input field is used to define the user role -->
        <input type="hidden" name="role" value="customer">

        <input type="submit" value="Register">
    </form>
</body>
</html>
