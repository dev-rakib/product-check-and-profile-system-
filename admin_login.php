<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Set character encoding -->
    <meta charset="UTF-8">
    <!-- Make the page responsive on all devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link external CSS for styling -->
    <link rel="stylesheet" href="login_signup_admin_style.css">
    <!-- Page title -->
    <title>Admin login</title>
</head>
<body>
    <!-- Main Heading -->
    <h1>login</h1>

    <!-- Admin Login Form -->
    <form method="post">
        <!-- Unique Code Field -->
        Unique Code: 
        <input type="number" name="un" placeholder="Unique Code" required>

        <!-- Email Field -->
        Email: 
        <input type="email" name="email" placeholder="Email" required>

        <!-- Password Field -->
        Password: 
        <input type="password" name="password" placeholder="Password" required>

        <!-- Message Display Label -->
        <label for="">
        <?php
        // Include the database connection file
        include "dashboard_connection.php";

        // Check if the form was submitted via POST method
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve input values from the form
            $unique_code = $_POST["un"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            // Check if the unique code is correct
            if ($unique_code == "1432") {
                // Check if the email is correct
                if ($email == "perfumezonechittagong@admin.login") {
                    // Check if the password is correct
                    if ($password == "admin.pzc") {
                        // Successful login message
                        echo "Logged In Successful";

                        // Redirect to admin checklist/dashboard page
                        header("location: check_list.php");
                        exit(); // Exit to prevent further code execution
                    } else {
                        // Incorrect password
                        echo "Wrong Password";
                    }
                } else {
                    // Incorrect email
                    echo "Email Does Not Match";
                }
            } else {
                // Incorrect unique code
                echo "Wrong Unique Code";
            }
        }

        // Close database connection
        mysqli_close($conn);
        ?>
        </label>

        <!-- Submit Login Button -->
        <button type="submit">login</button>
    </form>

    <!-- Link to Return to Main Page -->
    <p>Go Back To Main Page?</p>
    <a href="index.php">GO</a>
</body>
</html>
