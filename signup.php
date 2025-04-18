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

    // Check if the form is submitted via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form inputs
        $name = $_POST["name"]; // User's name
        $address = $_POST["address"]; // User's address
        $phone = $_POST["phone"]; // User's phone number
        $email = $_POST["email"]; // User's email
        $password = $_POST["password"]; // User's password

        // Hash the password for secure storage
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Initialize the profile picture path variable
        $profile_path = "";

        // Check if a profile picture is uploaded
        if (isset($_FILES['profile_pic'])) {
            // Define the directory for storing uploaded profile pictures
            $target_dir = "uploads/";

            // Get the original file name of the uploaded profile picture
            $filename = basename($_FILES["profile_pic"]["name"]);

            // Create a unique file name to prevent overwriting and set the full file path
            $profile_path = $target_dir . uniqid() . "_" . $filename;

            // Move the uploaded file to the target directory
            move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $profile_path);
        }

        // Validate the email format
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Prepare the SQL query to insert user data into the 'users' table
            $sql = "INSERT INTO users (name, address, phone, email, password, profile_pic) 
                    VALUES ('$name','$address','$phone','$email','$hashed_password','$profile_path')";

            // Execute the SQL query
            if (mysqli_query($conn, $sql)) {
                // Redirect to the login page after successful signup
                header("Location: login.html");
                exit();
            } else {
                // Display an error message if the SQL query fails
                echo "Signup failed: " . mysqli_error($conn);
            }
        } else {
            // Display an error message if the email is not valid
            echo "Please enter a valid email.";
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
    </h1>
</body>
</html>
