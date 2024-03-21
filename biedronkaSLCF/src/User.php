<?php

class User {
    protected $id;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $password;
    protected $role;
    protected $address;
    protected $contact_number;

    // Constructor
    public function __construct($id, $firstname, $lastname, $email, $password, $role, $address, $contact_number) {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->address = $address;
        $this->contact_number = $contact_number;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getContactNumber() {
        return $this->contact_number;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setContactNumber($contact_number) {
        $this->contact_number = $contact_number;
    }
}
