<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    ini_set("SMTP", "smtp.gmail.com");
    ini_set("smtp_port", "587");
    ini_set("sendmail_from", "mkthmarch@gmail.com");


    // Validate form fields
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "All fields are required.";
    } else {
        // Email details
        $to = "mkthmarch@gmail.com"; // Change this to your email address
        $headers = "From: $name <$email>";
        $messageBody = "Name: $name\nEmail: $email\nSubject: $subject\nMessage: $message";

        // Send email
        if (mail($to, $subject, $messageBody, $headers)) {
            echo "Message sent successfully.";
        } else {
            echo "Failed to send message. Please try again later.";
        }
    }
} else {
    // Redirect to the form page if accessed directly
    header("Location: contact.html");
    exit;
}
?>
