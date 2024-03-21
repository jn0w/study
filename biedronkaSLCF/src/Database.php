<?php

// src/Database.php

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        require_once __DIR__ . '/../config.php';

        try {
            //try to connect to the database using PDO
            $this->connection = new PDO($dsn, $username, $password, $options);
            //change mode to exception to handle errors more effectively
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit;
        }
    }

    // ensures a single instance of the database connection exists
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    // returns the PDO connection
    public function getConnection() {
        return $this->connection;
    }
}