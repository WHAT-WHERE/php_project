<?php
// Path to the text file containing user credentials
$file_path = 'users.txt';

// Function to check user credentials
function authenticate($username, $password, $file_path) {
    if (file_exists($file_path) && is_readable($file_path)) {
        $file = fopen($file_path, 'r');

        while (($line = fgets($file)) !== false) {
            $line = trim($line);
            list($stored_username, $stored_password) = explode(' : ', $line);

            if ($username === $stored_username && $password === $stored_password) {
                fclose($file);
                return true;
            }
        }
        
        fclose($file);
    }
    
    return false;
}

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the credentials
    if (authenticate($username, $password, $file_path)) {
        // Redirect to the home page or wherever you want after successful login
        header("Location: index.html");
        exit;
    } else {
        // Redirect back to the login form with an error message
        $error_message = "Invalid username or password.";
        header("Location: login.html?error=" . urlencode($error_message));
        exit;
    }
} else {
    // Redirect back to the login form if accessed directly
    header("Location: login.html");
    exit;
}
?>
