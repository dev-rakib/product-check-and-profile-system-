<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic meta tags and linking CSS for styling -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login_signup_admin_style.css">
    <title>For Admins</title>
</head>
<body>
    <!-- HTML Form for admin to deleting product details -->
    <form method="post">
        <h1>Delete Product</h1>

        <!-- Input field for product id -->
        ID: 
        <input type="number" name="id" placeholder="ID" required>

        <!-- PHP code to handle form submission -->
        <label>
        <?php 
        // Including the database connection file
        include "dashboard_connection.php"; 
        
        // Check if the form is submitted using POST method
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get input values from the form
            $id = $_POST["id"];

            // SQL query to delete product details from 'products' table
            $sql = "DELETE FROM products WHERE id = '$id'";

            // Execute the query and show success or error message
            if (mysqli_query($conn, $sql)) {
                echo "Product Deleted Successfully!";
            } else {
                echo "Something went wrong";
            }
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
        </label>

        <!-- Delete button for the form -->
        <button type="submit">Delete</button>
    </form>

    <!-- Link to view the list of products -->
    <p>Want to check?</p>
    <a href="check_list.php">Check</a>
</body>
</html>
