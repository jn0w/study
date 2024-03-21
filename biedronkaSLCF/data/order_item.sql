USE grocery_shop;

CREATE TABLE IF NOT EXISTS order_items (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES guest_orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);
