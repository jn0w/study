<?php
// Include the UserManager class to handle user authentication
require_once '../src/UserManager.php'; 

session_start();

// Retrieve the user's email and password from the POST data
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Create an instance of the UserManager to use its authentication method
$userManager = new UserManager();

// Authenticate the user with the provided email and password
$user = $userManager->authenticate($email, $password);

// Check if authentication succeeded
if ($user) {
    
    $_SESSION['user_id'] = $user->getId(); 
    $_SESSION['email'] = $user->getEmail(); 
    $_SESSION['role'] = $user->getRole(); 

    // Redirect to the homepage after successful authentication
    header('Location: index.php');
    exit(); // Ensure no further code is executed
} else {
    // If authentication fails, set an error message
    $_SESSION['error_message'] = 'Invalid credentials';

    // Redirect back to the login page for another attempt
    header('Location: login.php');
    exit(); // Ensure no further code is executed
}
?>
