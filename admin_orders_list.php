<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta settings for character encoding and responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Linking external CSS file for styling -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="login_signup_admin_style.css">
    
    <!-- Page title -->
    <title>Check Orders</title>
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
            <!-- Link to products -->
            <a href="check_list.php">Go to Products Page</a>
            <!-- Link to logout -->
            <a href="logout.php">Logout</a>
        </nav>

        <!-- Table section for displaying orders details from the database -->
        <div class="table-wrapper">
            <table>
                <!-- Table headers -->
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Product Name</th>
                        <th>quantity</th>
                        <th>price</th>
                        <th>ordered_time</th>
                    </tr>
                </thead>

                <!-- Table body: dynamically filled using PHP -->
                <tbody>
                    <?php
                    // SQL query to fetch all products from the 'products' table
                    $sql = "SELECT * FROM orders";
                    $result = mysqli_query($conn, $sql);
                    
                    
                    // Loop through each product row and display in the table
                    while($orders = mysqli_fetch_assoc($result)) {
                        //Taking user name
                        $user_id = $orders["user_id"];
                        $NameSql= "SELECT * FROM users WHERE id='$user_id'";
                        $user_name = mysqli_query($conn,$NameSql);
                        $user = mysqli_fetch_assoc($user_name);

                        echo "<tr>";
                        echo "<td>".$orders["order_id"]."</td>";
                        echo "<td>".$orders["user_id"]."</td>";
                        echo "<td>".$user["name"]."</td>";
                        echo "<td>".$orders["product_name"]."</td>";
                        echo "<td>".$orders["quantity"]."</td>";
                        echo "<td>".$orders["price"]."</td>";
                        echo "<td>".$orders["ordered_time"]."</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div> <br>
        <form method="post">
            <label for="ID">Search by User ID</label>
            <input type="number" name="id" placeholder="User ID Here">
            <button type="submit">Search</button>
        </form><br>
        <!-- Table section for displaying orders details from the database -->
        <div class="table-wrapper">
            <table>
                <!-- Table headers -->
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                    </tr>
                </thead>

                <!-- Table body: dynamically filled using PHP -->
                <tbody>
                    <?php
                    if($_SERVER["REQUEST_METHOD"]=="POST"){
                        $user_input_id = $_POST["id"];
                        $user_sql = "SELECT * FROM users WHERE id = '$user_input_id'";
                        $user_query = mysqli_query($conn,$user_sql);
    
                        // Loop through each product row and display in the table
                        while($users = mysqli_fetch_assoc($user_query)) {
    
                            echo "<tr>";
                            echo "<td>".$users["id"]."</td>";
                            echo "<td>".$users["name"]."</td>";
                            echo "<td>".$users["address"]."</td>";
                            echo "<td>".$users["phone"]."</td>";
                            echo "<td>".$users["email"]."</td>";
                            echo "</tr>";
                        }
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
