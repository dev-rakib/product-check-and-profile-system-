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
    
    <!-- Link to external CSS stylesheet for styling the page -->
    <link rel="stylesheet" href="style.css">
    
    <!-- Page title shown in the browser tab -->
    <title>Perfume Zone Chittagong</title>
</head>
<body>

<?php 

// Include database connection file
include "dashboard_connection.php"; 

// Retrieve user's email from session
$email = $_SESSION["email"]; 

// Query to fetch the user's details from the 'users' table
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result); // Get the user's information
?>

<!-- Main container that wraps all content -->
<div class="container">

    <!-- Header section with branding and title -->
    <header>
        <h2 class="brand-title">Perfume Zone Chittagong</h2>
        <h1 class="section-title">Products</h1>
    </header>

    <!-- Navigation bar for user interaction and navigation -->
    <nav>
        <!-- Display user's profile picture -->
        <img 
            src="<?php echo $user["profile_pic"];?>" 
            alt="profile_pic" 
            style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover; border: 2px solid #ffc107; box-shadow: 0 0 10px rgba(255, 193, 7, 0.4); margin-right: 10px;"
        >

        <!-- Link to user's profile page, displaying their name -->
        <a href="profile.php">
            <?php echo $user["name"]; ?>
        </a>

        <!-- Navigation links to various pages -->
        <a href="admin_login.php">Admin</a>
        <a href="search.php">Search</a>
        <a href="order.php">Order Now</a>
        <a href="logout.php">Logout</a>
    </nav>

    <!-- Table section displaying the list of products -->
    <div class="table-wrapper">
        <table>
            <!-- Table headings -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price(per ml)</th>
                </tr>
            </thead>

            <!-- Table body dynamically generated with PHP -->
            <tbody>
                <?php
                // SQL query to fetch all product records
                $sql = "SELECT * FROM products";
                $result = mysqli_query($conn, $sql);

                // Loop through each product and display as a row in the table
                while ($products = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $products["id"] . "</td>";
                    echo "<td>" . $products["name"] . "</td>";
                    echo "<td>" . $products["price"] . "tk</td>";
                    echo "</tr>";
                }

                // Close the database connection to free up resources
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>

    <!-- Footer section with credits -->
    <footer>
        <p>&copy; Developed by <span style="color:#ffc107;">Rakib Chowdhury</span></p>
    </footer>
</div>
</body>
</html>
