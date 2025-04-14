<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Character encoding and responsive design meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link to external CSS for signup page -->
    <link rel="stylesheet" href="signup.css">

    <!-- Page title -->
    <title>check signup</title>
</head>
<body>
    <h1>
    <?php
    // Include the database connection file
    include "dashboard_connection.php";

    // Check if the form has been submitted via POST method
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Retrieve and store form inputs
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Hash the password for secure storage
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Validate email format using PHP's filter
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            // SQL query to insert user details into database
            $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

            // Execute query and check for success
            if (mysqli_query($conn, $sql)) {
                echo "Signup Successful";

                // Redirect user to login page after successful signup
                header("location: login.html");
            } else {
                // Show message if insertion fails
                echo "Please Enter Details Correctly";
            }

        } else {
            // Show error if email is not valid
            echo "Please Enter A Valid Email";
        }
    }

    // Close database connection
    mysqli_close($conn);
    ?>
    </h1>
</body>
</html>
