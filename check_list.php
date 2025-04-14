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

        <!-- Navigation bar with developer credit and logout link -->
        <nav>
            <h1>Developed By Rakib Chowdhury</h1>
            <a href="admin_login.php">Logout</a>
        </nav>

        <!-- Table section for displaying product details -->
        <div class="table-wrapper">
            <table>
                <!-- Table header -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Insert Time</th>
                    </tr>
                </thead>

                <!-- Table body populated with PHP and MySQL data -->
                <tbody>
                    <?php
                    // SQL query to fetch all records from the 'products' table
                    $sql = "SELECT * FROM products";
                    $result = mysqli_query($conn, $sql);

                    // Loop through each row and display the data in the table
                    while($products = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$products["id"]."</td>";
                        echo "<td>".$products["name"]."</td>";
                        echo "<td>".$products["price"]."</td>";
                        echo "<td>".$products["insert_time"]."</td>";
                        echo "</tr>";
                    }

                    // Close the database connection
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Section for additional actions (like adding more products) -->
        <section class="actions">
            <h1 class="section-title">Manage Products</h1>
            <div class="button-group">
                <!-- Link to add more products -->
                <a href="admin.php">Add More</a>
            </div>

            <!-- Footer with developer credit -->
            <footer>
                <p>&copy; Developed by <span style="color:#ffc107;">Rakib Chowdhury</span></p>
            </footer>
        </section>
    </div>

    <!-- Empty div for future use or styling purposes -->
    <div class="copy_center">
    </div>
</body>
</html>
