<?php

require_once 'Database.php';

class Manager {
    protected $db; //databse connection

    public function __construct() {
        //access the singleton instance of the database class
        $this->db = Database::getInstance()->getConnection();
    }
}