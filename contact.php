<?php
// Initialize variables
$name = $email = $message = "";
$name_err = $email_err = $message_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate message
    if (empty(trim($_POST["message"]))) {
        $message_err = "Please enter a message.";
    } else {
        $message = trim($_POST["message"]);
    }

    // Check input errors before inserting in CSV
    if (empty($name_err) && empty($email_err) && empty($message_err)) {
        // Open or create CSV file
        $file = fopen('contact_data.csv', 'a');

        // Write data to CSV file
        fputcsv($file, [$name, $email, $message]);

        // Close the file
        fclose($file);

        // Redirect to thank you page or stay on the same page
        header('Location: thank_you.html'); // Ensure this page exists
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Blake Briol</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            color: #f0f0f0;
            background-color: #121212;
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Prevent horizontal scroll due to the gradient */
        }

        /* Gradient Background */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            right: 0;
            width: 100vw;
            height: 100vh;
            background: linear-gradient(to top right, #111, #333);
            z-index: -1; /* Place it behind all content */
            pointer-events: none; /* Ensure it doesn’t interfere with interactions */
        }

        header {
            background-color: #1e1e1e;
            color: #f0f0f0;
            padding: 1em;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            box-sizing: border-box; /* Ensure padding is included in width */
        }

        header h1 {
            margin: 0;
            font-size: 2em; /* Larger font size for header */
        }

        nav {
            margin: 0;
            padding: 0;
        }

        nav a {
            color: #f0f0f0;
            text-decoration: none;
            margin: 0 15px;
            font-weight: 700;
            transition: color 0.3s, border-bottom 0.3s;
            border-bottom: 2px solid transparent;
            padding-bottom: 5px;
        }

        nav a:hover {
            color: #e0e0e0;
            border-bottom: 2px solid #e0e0e0;
        }

        .container {
            width: 80%;
            margin: 2em auto;
            padding: 2em;
            background-color: #1c1c1c;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            box-sizing: border-box; /* Include padding in width */
        }

        footer {
            background-color: #1e1e1e;
            color: #f0f0f0;
            text-align: center;
            padding: 1em 0;
            position: relative;
            width: 100%;
            box-shadow: 0 -4px 6px rgba(0,0,0,0.1);
        }

        h1, h2, h3 {
            color: #e0e0e0;
            margin: 0 0 1em;
        }

        .contact-form {
            background: #2c2c2c;
            border-radius: 12px; /* Match the feature cards */
            padding: 2em; /* Increased padding for consistency */
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            transition: box-shadow 0.3s, transform 0.3s;
        }

        .contact-form:hover {
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
            transform: translateY(-5px);
        }

        input, textarea {
            width: 100%;
            padding: 0.8em;
            border: 1px solid #333;
            border-radius: 4px;
            margin-bottom: 1.5em; /* Increased margin for consistency */
            background: #2c2c2c;
            color: #f0f0f0;
        }

        input[type="submit"] {
            background: #007bff;
            border: none;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s;
            padding: 1em;
            border-radius: 4px;
        }

        input[type="submit"]:hover {
            background: #0056b3;
        }

        label {
            display: block;
            margin-bottom: 0.5em;
            color: #e0e0e0;
        }

        .error-message {
            color: #ff4d4d;
            margin-bottom: 1em;
        }
    </style>
</head>
<body>
    <header>
        <h1>Contact</h1>
        <nav>
            <a href="/">Home</a>
            <a href="/resume">Resume</a>
            <a href="/projects">Projects</a>
            <a href="/contact">Contact</a>   
            <a href="/test">Test</a>
        </nav>
    </header>
    
    <div class="container">
        <section id="contact">
            <h2>Contact Me</h2>
            <p>If you would like to get in touch, please use the form below.</p>
            <div class="contact-form">
                <?php if (!empty($name_err) || !empty($email_err) || !empty($message_err)): ?>
                    <div class="error-message">
                        <?php
                        echo $name_err ? "<p>$name_err</p>" : "";
                        echo $email_err ? "<p>$email_err</p>" : "";
                        echo $message_err ? "<p>$message_err</p>" : "";
                        ?>
                    </div>
                <?php endif; ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                    
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                    
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="4" required><?php echo htmlspecialchars($message); ?></textarea>
                    
                    <input type="submit" value="Send Message">
                </form>
            </div>
        </section>
    </div>
    
    <footer>
        <p>&copy; 2024 Blake Briol. All rights reserved.</p>
    </footer>
</body>
</html>
