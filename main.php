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
    <!-- Basic meta tags for character encoding and mobile responsiveness -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Link to external CSS stylesheet -->
    <link rel="stylesheet" href="style.css">
    
    <!-- Page title shown in browser tab -->
    <title>Perfume Zone Chittagong</title>
</head>
<body>

<?php 
// Include database connection
include "dashboard_connection.php"; 
?>

<!-- Main container for layout -->
<div class="container">

    <!-- Header with branding -->
    <header>
        <h2 class="brand-title">Perfume Zone Chittagong</h2>
        <h1 class="section-title">Products</h1>
    </header>

    <!-- Navigation bar -->
    <nav>
        <!-- Display user name by fetching from DB using email from session -->
        <a href="profile.php">
            <?php 
            $email = $_SESSION["email"]; // Get email from session

            // Query to get user's name
            $sql = "SELECT name FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_assoc($result);

            // Output user's name in nav
            echo "Profile: " . $user["name"];
            ?>
        </a>

        <!-- Link to Admin panel -->
        <a href="admin_login.php">Admin</a>

        <!-- Link to logout (currently goes to login page) -->
        <a href="login.html">Logout</a>
    </nav>

    <!-- Product table section -->
    <div class="table-wrapper">
        <table>
            <!-- Table headings -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                </tr>
            </thead>

            <!-- Table body populated by PHP loop -->
            <tbody>
                <?php
                // Query to fetch all products
                $sql = "SELECT * FROM products";
                $result = mysqli_query($conn, $sql);

                // Loop through products and display in table rows
                while ($products = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $products["id"] . "</td>";
                    echo "<td>" . $products["name"] . "</td>";
                    echo "<td>" . $products["price"] . "</td>";
                    echo "</tr>";
                }

                // Close database connection
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
