<?php
// Start session to manage logged-in user data
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION["email"])) {
    header("location: login.html"); // Redirect if not logged in
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Character encoding and viewport settings -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Link to external CSS stylesheet for styling -->
    <link rel="stylesheet" href="style.css">
    <title>Order</title>
</head>
<body>

<?php 
// Include database connection file
include "dashboard_connection.php"; 
?>

<!-- Main container for layout -->
<div class="container">

    <!-- Header with branding (site name and page title) -->
    <header>
        <h2 class="brand-title">Perfume Zone Chittagong</h2>
        <h1 class="section-title">Products</h1>
    </header>

    <!-- Navigation bar -->
    <nav>
        <!-- Display logged-in user's name dynamically by fetching it from the database -->
        <a href="profile.php">
            <?php 
            $email = $_SESSION["email"]; // Get the logged-in user's email from session

            // Query to get the user's name from the database using the email
            $sql = "SELECT name FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_assoc($result);

            // Output the user's name in the navigation bar
            echo "Profile: " . $user["name"];
            ?>
        </a>

        <!-- Admin panel link (for authorized users) -->
        <a href="admin_login.php">Admin</a>

        <!-- Order page link -->
        <a href="order.php">Order</a>

        <!-- Link to main page -->
        <a href="index.php">Main Page</a>

        <!-- Logout link (currently redirects to the login page) -->
        <a href="logout.php">Logout</a>
    </nav>

    <!-- Search section to allow users to search for products -->
    <div class="search">
        <h1>Search</h1>
        <!-- Search form that sends search input via POST -->
        <form method="post">
            <input type="text" name="search" placeholder="Search By Name">
            <button type="submit">Find</button>
        </form>
    </div>

    <!-- Product table section to display product search results -->
    <div class="table-wrapper">
        <table>
            <!-- Table headings -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price (per ml)</th>
                </tr>
            </thead>

            <!-- Table body populated by PHP loop based on search results -->
            <tbody>
                <?php
                // Check if the form has been submitted via POST
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    $search = $_POST["search"]; // Get the search term from the form

                    // Query to fetch products based on the search term
                    $sql = "SELECT * FROM products WHERE name = '$search'";
                    $result = mysqli_query($conn, $sql);

                    // Loop through the products and display them in table rows
                    while ($products = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $products["id"] . "</td>"; // Product ID
                        echo "<td>" . $products["name"] . "</td>"; // Product Name
                        echo "<td>" . $products["price"] . "tk</td>"; // Product Price per ml
                        echo "</tr>";
                    }
                }
                
                // Close the database connection after completing the operations
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
    
    <!-- Footer section -->
    <footer>
        <p>&copy; Developed by <span style="color:#ffc107;">Rakib Chowdhury</span></p>
    </footer>
</div>
</body>
</html>
