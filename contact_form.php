<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    // Validate data
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Open or create CSV file
        $file = fopen('contact_data.csv', 'a');
        
        // Write data to CSV file
        fputcsv($file, [$name, $email, $message]);
        
        // Close the file
        fclose($file);
        
        // Redirect to a thank you page
        header('Location: thank_you.html');
        exit();
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request.";
}
?>
