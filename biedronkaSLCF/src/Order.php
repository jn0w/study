<?php

class Order {
    private $orderId;
    private $products;
    private $totalPrice;
    private $name;
    private $address;
    private $contactNumber;
    private $email;
    private $paymentMethod;

    public function __construct($orderId = null, $name = "", $address = "", $contactNumber = "", $email = "", $paymentMethod = "") {
        $this->orderId = $orderId;
        $this->name = $name;
        $this->address = $address;
        $this->contactNumber = $contactNumber;
        $this->email = $email;
        $this->paymentMethod = $paymentMethod;
        $this->products = [];
        $this->totalPrice = 0.0;
    }

    public function getName() {
        return $this->name;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getContactNumber() {
        return $this->contactNumber;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPaymentMethod() {
        return $this->paymentMethod;
    }

    public function addProduct($product, $quantity) {
        //add product to the order product array
        //every product is an associative array with the product object and the quantity
        $this->products[] = ['product' => $product, 'quantity' => $quantity];
        $this->calculateTotalPrice();
    }

    private function calculateTotalPrice() {
        //calculates the total price, using array_reduce to go over each product
        $this->totalPrice = array_reduce($this->products, function ($total, $item) {
            //for each product multiply the price by the quantity and add to the total
            return $total + ($item['product']->getPrice() * $item['quantity']);
        }, 0);
    }

    public function getProducts() {
        return $this->products;
    }

    public function getTotalPrice() {
        return $this->totalPrice;
    }

    public function getOrderId() {
        return $this->orderId;
    }
}