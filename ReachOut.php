<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    // Validate data (basic validation for demonstration purposes)
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Open or create CSV file
        $file = fopen('contact_data.csv', 'a');
        
        // Write data to CSV file
        fputcsv($file, [$name, $email, $message]);
        
        // Close the file
        fclose($file);
        
        // Redirect to a thank you page or display a success message
        header('Location: thank_you.html'); // or use echo "Thank you for your message!";
        exit();
    } else {
        // Handle the error (redirect or display an error message)
        echo "All fields are required.";
    }
} else {
    // Handle invalid request
    echo "Invalid request.";
}
?>

