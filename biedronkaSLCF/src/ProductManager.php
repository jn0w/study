<?php

require_once 'Database.php';
require_once 'Manager.php';
require_once 'Product.php';

class ProductManager extends Manager {

    public function addProduct(Product $product) {
        //insert statement with product details
        $stmt = $this->db->prepare("INSERT INTO products (name, category_id, price, description) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $product->getName(),
            $product->getCategory(),
            $product->getPrice(),
            $product->getDescription()
        ]);
        return $this->db->lastInsertId();
    }

    public function getAllProducts() {
        //get all products
        $stmt = $this->db->prepare("SELECT * FROM products");
        $stmt->execute();
        //fetch results as associative array
        $productsArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //empty array for product objects
        $products = [];

        //product array to product objects, create product objects with the data
        foreach ($productsArray as $productData) {
            $products[] = new Product(
                $productData['product_id'],
                $productData['name'],
                $productData['price'],
                $productData['description'],
                $productData['category_id']
            );
        }

        return $products;
    }

    public function deleteProduct($productId) {
        //delete statement for product object
        $stmt = $this->db->prepare("DELETE FROM products WHERE product_id = ?");
        return $stmt->execute([$productId]);
    }

    public function getProductsGroupedByCategory() {
        //get products grouped by category
        $stmt = $this->db->prepare("SELECT * FROM products ORDER BY category_id, name");
        $stmt->execute();
        //fetch results as associative array
        $productsArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //empty array for grouped products
        $groupedProducts = [];

        //loop through each product in the products array
        foreach ($productsArray as $productData) {
            //for each product create a project object with it's data
            $product = new Product(
                $productData['product_id'],
                $productData['name'],
                $productData['price'],
                $productData['description'],
                $productData['category_id']
            );
            //add product objects to groupedProducts array under the key category
            //product objects with the same category are added to their array creating sub arrays
            $groupedProducts[strtolower($product->getCategory())][] = $product;
        }

        return $groupedProducts;
    }

    public function getProductById($productId) {
        //SQL statement to select a product by its ID. The :productId is a placeholder for the actual product ID value.
        $stmt = $this->db->prepare("SELECT * FROM products WHERE product_id = :productId");
        // Bind the $productId variable to the :productId placeholder in the SQL statement.
        // PDO::PARAM_INT indicates that the value should be treated as an integer.
        $stmt->bindValue(':productId', $productId, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the result of the query as an associative array, 
        $productData = $stmt->fetch(PDO::FETCH_ASSOC);
        //if the product exists create a new product object with the data and return it
        if ($productData) {
            return new Product($productData['product_id'], $productData['name'], $productData['price'], $productData['description'], $productData['category_id']);
        } else {
            return null;
        }
    }

    public function updateProduct($product_id, $name, $category_id, $price, $description) {
        //update product details
        $sql = "UPDATE products SET name = ?, category_id = ?, price = ?, description = ? WHERE product_id = ?";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([$name, $category_id, $price, $description, $product_id]);
    }
}
