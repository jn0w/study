USE grocery_shop;

CREATE TABLE IF NOT EXISTS guest_orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    contact_number VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL DEFAULT 'card',
    status VARCHAR(100) DEFAULT 'Pending'
);
