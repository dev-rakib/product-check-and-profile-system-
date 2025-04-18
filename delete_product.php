<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic meta tags for character encoding and responsive layout -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Linking the external CSS file for styling -->
    <link rel="stylesheet" href="login_signup_admin_style.css">

    <!-- Title of the page shown on the browser tab -->
    <title>For Admins</title>
</head>
<body>
    <!-- HTML Form for admin to delete a product by ID -->
    <form method="post">
        <h1>Delete Product</h1>

        <!-- Input field for product ID -->
        ID: 
        <input type="number" name="id" placeholder="ID" required>

        <!-- PHP block to process the form submission -->
        <label>
        <?php 
        // Include database connection settings
        include "dashboard_connection.php"; 
        
        // Check if the form is submitted using POST method
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get the product ID from the form
            $id = $_POST["id"];

            // SQL query to delete the product from the 'products' table using the provided ID
            $sql = "DELETE FROM products WHERE id = '$id'";

            // Execute the query and check if it was successful
            if (mysqli_query($conn, $sql)) {
                // Success message if deletion worked
                echo "Product Deleted Successfully!";
            } else {
                // Error message if something went wrong
                echo "Something went wrong";
            }
        }

        // Close the connection to the database
        mysqli_close($conn);
        ?>
        </label>

        <!-- Submit button to trigger deletion -->
        <button type="submit">Delete</button>
    </form>

    <!-- Link to go back and check the product list -->
    <p>Want to check?</p>
    <a href="check_list.php">Check</a>
</body>
</html>
