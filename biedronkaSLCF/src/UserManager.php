<?php

require_once 'Database.php';
require_once 'Manager.php';
require_once 'User.php'; 

class UserManager extends Manager {
    
    // Attempts to register a user with the given details and returns a User object upon success, or false on failure.
    public function register($firstname, $lastname, $email, $password, $role, $address, $contact_number) {
        // Hashes the password for secure storage.
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        // SQL statement for inserting the new user into the database.
        $stmt = $this->db->prepare("INSERT INTO users (firstname, lastname, email, password, role, address, contact_number) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        // Executes the SQL statement with the provided user details.
        $success = $stmt->execute([$firstname, $lastname, $email, $passwordHash, $role, $address, $contact_number]);

        // If the insertion was successful, creates and returns a new User object with the provided details.
        if ($success) {
            return new User($this->db->lastInsertId(), $firstname, $lastname, $email, $passwordHash, $role, $address, $contact_number);
        } else {
            // Returns false if the user could not be added to the database.
            return false;
        }
    }

    // Attempts to authenticate a user based on the provided email and password.
    public function authenticate($email, $password) {
        // Prepares the SQL statement to search for the user by email.
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // If a user is found and the password matches, returns a new User object with the user's details.
        if ($userData && password_verify($password, $userData['password'])) {
            return new User(
                $userData['id'],
                $userData['firstname'],
                $userData['lastname'],
                $userData['email'],
                $userData['password'], 
                $userData['role'],
                $userData['address'],
                $userData['contact_number']
            );
        }
    
        // Returns null if the user cannot be authenticated.
        return null;
    }

    // Checks if a user with the given email already exists in the database.
    public function userExists($email) {
        // Prepares and executes the SQL statement to count users with the given email.
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $count = $stmt->fetchColumn();
        // Returns true if a user exists (count > 0), false otherwise.
        return $count > 0;
    }
}
