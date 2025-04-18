<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta settings for character encoding and responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Linking external CSS file for styling -->
    <link rel="stylesheet" href="style.css">
    
    <!-- Page title -->
    <title>Admin Check</title>
</head>
<body>

    <!-- Include the PHP file that connects to the MySQL database -->
    <?php include "dashboard_connection.php"; ?>

    <!-- Main content wrapper -->
    <div class="container">

        <!-- Header section with branding and section title -->
        <header>
            <h2 class="brand-title">Perfume Zone Chittagong</h2>
            <h1 class="section-title">Products</h1>
        </header>

        <!-- Navigation bar with developer credit and useful links -->
        <nav>
            <h1>ADMIN</h1>
            <!-- Link to add new product -->
            <a href="admin.php">Add</a>
            <!-- Link to update product -->
            <a href="update_product.php">Update</a>
            <!-- Link to delete product -->
            <a href="delete_product.php">Delete</a>
            <!-- Link to orders product -->
            <a href="admin_orders_list.php">Orders</a>
            <!-- Link to logout -->
            <a href="logout.php">Logout</a>
        </nav>

        <!-- Table section for displaying product details from the database -->
        <div class="table-wrapper">
            <table>
                <!-- Table headers -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Insert Time</th>
                    </tr>
                </thead>

                <!-- Table body: dynamically filled using PHP -->
                <tbody>
                    <?php
                    // SQL query to fetch all products from the 'products' table
                    $sql = "SELECT * FROM products";
                    $result = mysqli_query($conn, $sql);

                    // Loop through each product row and display in the table
                    while($products = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$products["id"]."</td>";
                        echo "<td>".$products["name"]."</td>";
                        echo "<td>".$products["price"]."</td>";
                        echo "<td>".$products["insert_time"]."</td>";
                        echo "</tr>";
                    }

                    // Close the database connection after use
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Section with title and placeholder for future action buttons -->
        <section class="actions">
            <h1 class="section-title">Manage Products</h1>
            <div class="button-group">
                <!-- Future action buttons can be added here -->
            </div>

            <!-- Footer with developer credit -->
            <footer>
                <p>&copy; Developed by <span style="color:#ffc107;">Rakib Chowdhury</span></p>
            </footer>
        </section>
    </div>

    <!-- Placeholder div that can be styled or used for extra content -->
    <div class="copy_center">
    </div>
</body>
</html>
