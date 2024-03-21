<?php

require_once 'Database.php';
require_once 'Manager.php';

require_once 'Order.php';
require_once 'Product.php';

class OrderManager extends Manager {

    public function createOrder(Order $order) {
        try {
            //start transaction
            $this->db->beginTransaction();

            //insert the new order into the database
            $stmt = $this->db->prepare("INSERT INTO guest_orders (total_price, status) VALUES (?, 'Pending')");
            $stmt->execute([$order->getTotalPrice()]);
            $orderId = $this->db->lastInsertId();
            //insert the products from the order into the database
            $stmt = $this->db->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
            foreach ($order->getProducts() as $item) {
                $stmt->execute([$orderId, $item['product']->getId(), $item['quantity'], $item['product']->getPrice()]);
            }
            //commit the transaction
            $this->db->commit();
            return $orderId;
        } catch (Exception $e) {
            //if error rollback
            $this->db->rollBack();
            throw $e;
        }
    }
    public function getOrderDetails($orderId) {
        //get the order details from the database
        $stmt = $this->db->prepare("SELECT * FROM guest_orders WHERE order_id = ?");
        $stmt->execute([$orderId]);
        //fetch the data as an associative array
        $orderData = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$orderData) {
            return null;
        }
    
        //create the Order object with the fetched data
        $order = new Order(
            $orderData['order_id'],
            $orderData['name'],
            $orderData['address'],
            $orderData['contact_number'],
            $orderData['email'],
            $orderData['payment_method']
        );
    
        //get all the products associated with the order from the order_items table 
        $stmt = $this->db->prepare("SELECT p.*, oi.quantity FROM order_items oi JOIN products p ON oi.product_id = p.product_id WHERE oi.order_id = ?");
        //execute with the order id
        $stmt->execute([$orderId]);

        //go through every product associated with the order
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //create a product object from the products data associated with the order
            $product = new Product($row['product_id'], $row['name'], $row['price'], $row['description'], $row['category_id']);
            //add each product object to the order object with its quantity
            $order->addProduct($product, $row['quantity']);
        }
    
        return $order;
    }

    public function getAllOrders() {
        $orders = [];
        //get all order id from the order table
        $stmt = $this->db->prepare("SELECT order_id FROM guest_orders ORDER BY order_id DESC");
        $stmt->execute();
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //add each order to the array
            $orders[] = $this->getOrderDetails($row['order_id']);
        }
    
        return $orders;
    }
    

    public function deleteOrder($orderId) {
        try {
            //start transaction
            $this->db->beginTransaction();
            //delete items from order items table
            $stmt = $this->db->prepare("DELETE FROM order_items WHERE order_id = ?");
            $stmt->execute([$orderId]);
            //delete the order from order table
            $stmt = $this->db->prepare("DELETE FROM guest_orders WHERE order_id = ?");
            $stmt->execute([$orderId]);
            //commit transaction
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            //if error rollback
            $this->db->rollBack();
            return false;
        }
    }
    
}