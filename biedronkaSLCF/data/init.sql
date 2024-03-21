CREATE DATABASE grocery_shop; 

USE grocery_shop;

-- Create the users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'customer') NOT NULL,
    address VARCHAR(255) NOT NULL,
    contact_number VARCHAR(255) NOT NULL
);

-- Create the products table
CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    category_id VARCHAR(255) NOT NULL,
    image VARCHAR(255) -- Assuming it can be NULL
);

-- Create the guest_orders table
CREATE TABLE guest_orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    contact_number VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    payment_method VARCHAR(255) NOT NULL,
    status ENUM('Pending', 'Completed', 'Cancelled') NOT NULL,
    user_id INT, -- This should be a FOREIGN KEY if users are linked
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Create the order_items table
CREATE TABLE order_items (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES guest_orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);