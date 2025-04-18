<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic meta tags and linking external CSS for styling -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login_signup_admin_style.css">
    <!-- Page Title -->
    <title>For Admins</title>
</head>
<body>

    <!-- HTML Form for Admins to Insert Product Details -->
    <form method="post">
        <h1>Insert Details</h1>

        <!-- Input field for product name -->
        Name: 
        <input type="text" name="name" placeholder="Name" required>

        <!-- Input field for product price per ml -->
        Price(per ml): 
        <input type="number" name="price" placeholder="Price" required>

        <!-- Label to show output messages after form submission -->
        <label>
        <?php 
        // Include the database connection file
        include "dashboard_connection.php"; 
        
        // Check if the form is submitted via POST method
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get form data from input fields
            $name = $_POST["name"];
            $price = $_POST["price"];

            // SQL query to insert product data into the 'products' table
            $sql = "INSERT INTO products (name, price) VALUES ('$name', '$price')";

            // Run the query and show appropriate message
            if (mysqli_query($conn, $sql)) {
                // Success message if insert works
                echo "Product Added Successfully!";
            } else {
                // Error message if query fails
                echo "Something went wrong";
            }
        }

        // Close the connection to the database
        mysqli_close($conn);
        ?>
        </label>

        <!-- Submit button to insert product -->
        <button type="submit">Insert</button>
    </form>

    <!-- Link to view/check the product list -->
    <p>Want to check?</p>
    <a href="check_list.php">Check</a>
</body>
</html>
