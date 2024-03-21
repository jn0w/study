<?php

class Product {
    protected $id;
    protected $name;
    protected $price;
    protected $description;
    protected $category_id;

    public function __construct($id, $name, $price, $description, $category_id) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->category_id = $category_id;
    }

    
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getPrice() { return $this->price; }
    public function getDescription() { return $this->description; }
    public function getCategory() { return $this->category_id; }
}

