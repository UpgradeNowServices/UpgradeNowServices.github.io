<?php
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get POST data
    $name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? strip_tags(trim($_POST['phone'])) : '';
    $date = isset($_POST['date']) ? strip_tags(trim($_POST['date'])) : '';
    $text = isset($_POST['text']) ? strip_tags(trim($_POST['text'])) : '';

    // Validate form fields
    if (empty($name)) {
        $errors[] = 'Name is empty';
    }

    if (empty($email)) {
        $errors[] = 'Email is empty';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email is invalid';
    }

    if (empty($phone)) {
        $errors[] = 'phone is empty';
    }

    if (empty($date)) {
        $errors[] = 'Date is empty';
    }

    if (empty($text)) {
        $errors[] = 'Text is empty';
    }

    // If no errors, send email
    if (empty($errors)) {
        // Recipient email address (replace with your own)
        $recipient = "christiantrodriguez3@gmail.com";

        // Additional headers
        $headers = "From: $name <$email>";

        // Send email
        if (mail($recipient, $phone, $headers)) {
            echo "Email sent successfully!";
        } else {
            echo "Failed to send email. Please try again later.";
        }
    } else {
        // Display errors
        echo "The form contains the following errors:<br>";
        foreach ($errors as $error) {
            echo "- $error<br>";
        }
    }
} else {
    // Not a POST request, display a 403 forbidden error
    header("HTTP/1.1 403 Forbidden");
    echo "You are not allowed to access this page.";
}
?>