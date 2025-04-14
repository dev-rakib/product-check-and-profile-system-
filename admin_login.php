<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Set character encoding -->
    <meta charset="UTF-8">
    <!-- Make the page responsive on all devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link external CSS for styling -->
    <link rel="stylesheet" href="login_signup_admin_style.css">
    <title>Admin login</title>
</head>
<body>
    <!-- Page Heading -->
    <h1>login</h1>

    <!-- Login Form -->
    <form method="post">
        <!-- Unique code input -->
        Unique Code: <input type="number" name="un" placeholder="Unique Code" required>
        <!-- Email input -->
        Email: <input type="email" name="email" placeholder="Email" required>
        <!-- Password input -->
        Password: <input type="password" name="password" placeholder="Password" required>

        <!-- Label to show login messages -->
        <label for="">
        <?php
        // Connect to the database or include any shared connection settings
        include "dashboard_connection.php";

        // Check if the request method is POST (form submitted)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve the submitted form data
            $unique_code = $_POST["un"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            // Validate unique code
            if ($unique_code == "1432") {
                // Validate email
                if ($email == "perfumezonechittagong@admin.login") {
                    // Validate password
                    if ($password == "admin.pzc") {
                        echo "Logged In Successful";
                        // Redirect to checklist page if login is successful
                        header("location: check_list.php");
                        exit(); // Terminate the script
                    } else {
                        // Wrong password message
                        echo "Wrong Password";
                    }
                } else {
                    // Wrong email message
                    echo "Email Does Not Match";
                }
            } else {
                // Wrong unique code message
                echo "Wrong Unique Code";
            }
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
        </label>

        <!-- Submit button -->
        <button type="submit">login</button>
    </form>

    <!-- Link to go back to the main page -->
    <p>Go Back To Main Page?</p>
    <a href="main.php">GO</a>
</body>
</html>
