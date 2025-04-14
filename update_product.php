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
    <!-- HTML Form for admin to insert product details -->
    <form method="post">
        <h1>Update Products</h1>

        <!-- Input field for product id -->
        ID: 
        <input type="text" name="id" placeholder="Enter ID" required>
        <!-- Input field for product name -->
        Name: 
        <input type="text" name="name" placeholder="Update Name" required>

        <!-- Input field for product price per ml -->
        Price(per ml): 
        <input type="number" name="price" placeholder="Update Price" required>

        <!-- PHP code to handle form submission -->
        <label>
        <?php 
        // Including the database connection file
        include "dashboard_connection.php"; 
        
        // Check if the form is submitted using POST method
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get input values from the form
            $id = $_POST["id"];
            $name = $_POST["name"];
            $price = $_POST["price"];

            // SQL query to update product details into the 'products' table
            $sql = "UPDATE products SET name = '$name', price = '$price' WHERE id = '$id'";

            // Execute the query and show success or error message
            if (mysqli_query($conn, $sql)) {
                echo "Product Updated Successfully!";
            } else {
                echo "Something went wrong";
            }
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
        </label>

        <!-- Submit button for the form -->
        <button type="submit">Update</button>
    </form>

    <!-- Link to view the list of products -->
    <p>Want to check?</p>
    <a href="check_list.php">Check</a>
</body>
</html>
