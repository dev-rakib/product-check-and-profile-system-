<?php
// Start session to manage logged-in user data
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION["email"])) {
    header("location: login.html");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags for encoding and responsiveness -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Link to external stylesheet -->
    <link rel="stylesheet" href="style.css">

    <!-- Page title -->
    <title>Order</title>
</head>
<body>

<?php 
// Include the database connection file
include "dashboard_connection.php"; 
?>

<!-- Main layout container -->
<div class="container">

    <!-- Branding header -->
    <header>
        <h2 class="brand-title">Perfume Zone Chittagong</h2>
        <h1 class="section-title">Products</h1>
    </header>

    <!-- Navigation bar -->
    <nav>
        <!-- Fetch and display logged-in user's name -->
        <a href="profile.php">
            <?php 
            $email = $_SESSION["email"]; // Get user email from session

            // Query to fetch user's name
            $sql = "SELECT name FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_assoc($result);

            // Output user's name
            echo "Profile: " . $user["name"];
            ?>
        </a>

        <!-- Additional navigation links -->
        <a href="admin_login.php">Admin</a>
        <a href="search.php">Search</a>
        <a href="index.php">Go Back</a>
        <a href="logout.php">Logout</a>
    </nav>

    <!-- Order section -->
    <div class="order">
        <h1>Order Now</h1>

        <!-- Form to input product ID for ordering -->
        <form method="post">
            Type ID: 
            <input type="number" name="order" placeholder="ORDER BY ID" required>
            <button type="submit">Select</button>

            <?php
            // Handle form submission
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($_POST["order"] > 0) {
                    $order = $_POST["order"]; // Get the entered product ID

                    // SQL query to check if the product with this ID exists
                    $sql = "SELECT * FROM products WHERE id = '$order'";
                    
                    // If query runs successfully
                    if (mysqli_query($conn, $sql)) {
                        echo "Order Successful";

                        // Store the product ID in session for the next page
                        $_SESSION["order"] = $order;

                        // Redirect to order processing page
                        header("location:order_process.php");
                    } else {
                        echo "Sorry, order was unsuccessful.";
                    }
                }
            }
            ?>
        </form>

        <!-- Container for any additional result message -->
        <div class="result">
        </div>
    </div>
    
    <!-- Footer -->
    <footer>
        <p>&copy; Developed by <span style="color:#ffc107;">Rakib Chowdhury</span></p>
    </footer>
</div>
</body>
</html>
