<?php
// Start session to manage logged-in user data
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION["email"])) {
    header("location: login.html");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta settings for character encoding and responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="style.css">
    
    <!-- Title of the page -->
    <title>Order</title>
</head>
<body>

<?php 
// Include database connection
include "dashboard_connection.php"; 
?>

<!-- Main container for page layout -->
<div class="container">

    <!-- Header section with branding -->
    <header>
        <h2 class="brand-title">Perfume Zone Chittagong</h2>
        <h1 class="section-title">Products</h1>
    </header>

    <!-- Navigation bar -->
    <nav>
        <!-- Display user's name by fetching from DB using session email -->
        <a href="profile.php">
            <?php 
            $email = $_SESSION["email"]; // Get email from session

            // Query to get user's name
            $sql = "SELECT name FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_assoc($result);

            // Output user's name
            echo "Profile: " . $user["name"];
            ?>
        </a>

        <!-- Navigation links -->
        <a href="admin_login.php">Admin</a>
        <a href="search.php">Search</a>
        <a href="index.php">Go Back</a>
        <a href="logout.php">Logout</a>
    </nav>
    
    <!-- Order form section -->
    <div class="order">
        <h1>Final Process</h1>

        <!-- Form to input quantity for order -->
        <form method="post">
            <input type="number" name="quantity" placeholder="Quantity in ml" required><br>
            <button type="submit">ORDER</button>
        </form>

        <?php
        // Check if session variable for product order exists
        if (isset($_SESSION["order"])) {
            $product_id = $_SESSION["order"];
            $user_email = $_SESSION["email"];

            // Proceed only if product ID is valid
            if ($product_id > 0) {
                // Get user ID from database
                $sql_user = "SELECT id FROM users WHERE email='$user_email'";
                $user_result = mysqli_query($conn, $sql_user);
                $user_id_fetch = mysqli_fetch_assoc($user_result);

                // Get product name from database
                $sql_product = "SELECT name FROM products WHERE id='$product_id'";
                $product_result = mysqli_query($conn, $sql_product);
                $product_name_fetch = mysqli_fetch_assoc($product_result);

                // Get product price from database
                $sql_product_price = "SELECT price FROM products WHERE id = '$product_id'";
                $product_price_result = mysqli_query($conn, $sql_product_price);
                $product_price_fetch = mysqli_fetch_assoc($product_price_result);

                // Store necessary info in variables
                $user_id = $user_id_fetch['id'];
                $product_name = $product_name_fetch['name'];
                $product_price = $product_price_fetch['price'];
                
            } else {
                // Redirect to order page if invalid product ID
                header("location: order.php");
            }
        } else {
            // Redirect if no order session found
            header("location: order.php");
        }

        // Process order when form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $quantity = $_POST["quantity"]; // Get quantity from form
            $price = $product_price * $quantity; // Calculate total price

            // Insert order into 'orders' table
            $sql = "INSERT INTO orders (user_id, product_id, product_name, quantity, price) 
                    VALUES ('$user_id', '$product_id', '$product_name', '$quantity', '$price')";

            // Show success message if order placed
            if (mysqli_query($conn, $sql)) {
                echo "Your Order Was Successful!<br>You need to pay " . $price . "tk";
            }
        }
        ?>
    </div>

    <!-- Footer section with credits -->
    <footer>
        <p>&copy; Developed by <span style="color:#ffc107;">Rakib Chowdhury</span></p>
    </footer>
</div>
</body>
</html>
