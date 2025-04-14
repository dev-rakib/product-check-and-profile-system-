<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags for character encoding and responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- External CSS file for styling -->
    <link rel="stylesheet" href="login.css">

    <!-- Page title -->
    <title>check login</title>
</head>
<body>

    <!-- Display any messages or login results inside an <h1> -->
    <h1>
    <?php
    // Include the file that establishes the database connection
    include "dashboard_connection.php";

    // Check if the request method is POST (form submission)
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get email and password input values from form
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        // SQL query to get all users (should ideally filter with WHERE email = '$email')
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $details = mysqli_query($conn, $sql);

        // Check if any users exist
        if (mysqli_num_rows($details) > 0) {
            // Get the first user (should be filtered by email!)
            $user = mysqli_fetch_assoc($details);

            // Verify if entered password matches the hashed password in the database
            if (password_verify($password, $user['password'])) {
                echo "Logged In Successful";

                // Start a session and store user information
                session_start();
                $_SESSION["email"] = $email;
                $_SESSION["password"] = $password;

                // Redirect to main.php
                header("Location: main.php");
                exit();
            } else {
                // If password does not match
                echo "Wrong Password";
            }

        } else {
            // If no users are found
            echo "No User Found";

            // Redirect back to login form
            header("Location: login.html");
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
    </h1>

</body>
</html>
