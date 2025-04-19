<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("location: login.html");
    exit;
}
include "dashboard_connection.php";
$email = $_SESSION["email"];
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

$orders_sql = "SELECT * FROM orders WHERE user_id = '{$user['id']}'";
$orders_result = mysqli_query($conn, $orders_sql);

$total_sql = "SELECT SUM(price) FROM orders"; 
$total_result = mysqli_query($conn, $total_sql);
$total = mysqli_fetch_assoc($total_result);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile - Perfume Zone</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1 class="brand-title">Perfume Zone Chittagong</h1>
            <p class="section-title">Your Profile</p>
        </header>

        <nav class="nav-links">
            <a href="index.php"><i class="fas fa-arrow-left"></i> Go Back</a>
            <a href="update_profile.php"><i class="fas fa-edit"></i> Edit Profile</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </nav>

        <div class="profile-card">
            <div class="profile-pic">
                <img src="<?php echo $user["profile_pic"]; ?>" alt="Profile Picture">
            </div>
            <div class="profile-info">
                <h2><?php echo htmlspecialchars($user["name"]); ?></h2>
                <p><?php echo htmlspecialchars($user["email"]); ?></p>
                <p><?php echo htmlspecialchars($user["address"]); ?></p>
                <p><?php echo htmlspecialchars($user["phone"]); ?></p>
                <div class="user-id">
                    <strong>User ID:</strong> <?php echo $user["id"]; ?>
                </div>
            </div>
        </div>

        <!-- Orders Card Section -->
        <div class="orders-card">
            <h2>Your Orders</h2>
            <h2>Total Spent: <?php 
            if ($total && $total['SUM(price)'] !== null) {
                echo $total['SUM(price)'] . "৳";
            } else {
                echo "0৳";
            }?></h2>
            <?php while ($order = mysqli_fetch_assoc($orders_result)): ?>
                <div class="order">
                    <div class="order-header">
                        <h3>Order ID: <?php echo htmlspecialchars($order["order_id"]); ?></h3>
                    </div>
                    <div class="order-details">
                        <p><strong>Product Name:</strong> <?php echo htmlspecialchars($order["product_name"]); ?></p>
                        <p><strong>Quantity:</strong> <?php echo htmlspecialchars($order["quantity"]); ?></p>
                        <p><strong>Price:</strong> $<?php echo htmlspecialchars($order["price"]); ?></p>
                        <p>Ordered on: <?php echo htmlspecialchars($order["ordered_time"]); ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <footer>
            <p>&copy; Developed by <span>Rakib Chowdhury</span></p>
        </footer>
    </div>
</body>
</html>

<?php mysqli_close($conn); ?>
