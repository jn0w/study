<?php
// include necessary classes
require_once '../src/Database.php'; 
require_once '../src/User.php';
require_once '../src/Customer.php';

// Check if the form was submitted using POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // filter for illegal characters and prepare data received from the form
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Sanitize email
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security
    $address = htmlspecialchars($_POST['address']);
    $contact_number = htmlspecialchars($_POST['contact_number']);
    $role = htmlspecialchars($_POST['role']); 

    // Create a new Customer object with the filtered data
    $customer = new Customer(null, $firstname, $lastname, $email, $password, $address, $contact_number);

    // Get a database connection instance
    $database = Database::getInstance();
    $db = $database->getConnection();
    
    //SQL statement to insert the new customer into the database
    $stmt = $db->prepare("INSERT INTO users (firstname, lastname, email, password, role, address, contact_number) VALUES (?, ?, ?, ?, ?, ?, ?)");
    // Execute the SQL statement with the customer data
    if ($stmt->execute([$firstname, $lastname, $email, $password, $role, $address, $contact_number])) {
        // Redirect to the homepage if registration is successful
        header('Location: index.php');
        exit(); // Prevent further script execution after redirect
    } else {
        // Provide feedback and a button to return to the registration form if registration fails
        echo "Registration failed! <br>";
        echo "<a href='register.php'><button>Go Back</button></a>";
    }  
}
?>

