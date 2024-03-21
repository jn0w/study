<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!-- Navbar HTML -->
<nav id="navbar">
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="products.php">Products</a>
        <a href="view_basket.php">Basket</a>
        <!-- Dynamically show links based on user login status -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="logout.php">Logout</a>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <!-- Show this link only to users who are admins -->
                <a href="add_product.php">Admin</a>
            <?php endif; ?>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register An Account</a>
        <?php endif; ?>
    </div>

</nav>

<!-- Navbar Styles -->
<style>
    .navbar {
        background-color: #333;
        overflow: hidden;
        padding: 0;
        margin: 0;
    }

    .navbar a {
        float: left;
        display: block;
        color: white;
        text-align: center;
        padding: 14px 20px;
        text-decoration: none;
    }

    .navbar a:hover {
        background-color: #ddd;
        color: black;
    }


</style>
