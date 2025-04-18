<?php
// Start session to access logged-in user data
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION["email"])) {
    header("location: login.html");
    exit; // Stop script execution
}

// Include database connection
include "dashboard_connection.php";

// Get logged-in user's email from session
$email = $_SESSION["email"];

// Fetch user data from database
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic setup -->
    <meta charset="UTF-8">
    <title>Profile - Perfume Zone</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link to custom Glassmorphism CSS -->
    <link rel="stylesheet" href="profile.css">

    <!-- Google Fonts & Font Awesome Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Page container -->
    <div class="container">

        <!-- Site header -->
        <header class="header">
            <h1 class="brand-title">Perfume Zone Chittagong</h1>
            <p class="section-title">Your Profile</p>
        </header>

        <!-- Navigation links -->
        <nav class="nav-links">
            <a href="index.php"><i class="fas fa-arrow-left"></i> Go Back</a>
            <a href="update_profile.php"><i class="fas fa-edit"></i> Edit Profile</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </nav>

        <!-- Profile card container -->
        <div class="profile-card" 
            style="display: flex; align-items: center; gap: 30px; padding: 30px; border-radius: 20px; background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(8px); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);">
            
            <!-- Profile picture -->
            <div class="profile-pic">
                <img src="<?php echo $user["profile_pic"]; ?>" alt="Profile Picture" 
                     style="width: 120px; height: 120px; border-radius: 50%; border: 3px solid #ffc107; object-fit: cover;">
            </div>

            <!-- User info section -->
            <div class="profile-info" style="flex: 1;">
                <!-- User name -->
                <h2 style="font-size: 2rem; color: #ffc107;"><?php echo htmlspecialchars($user["name"]); ?></h2>

                <!-- Email, address, phone (secured with htmlspecialchars) -->
                <p style="color: #ccc; margin: 10px 0;"><?php echo htmlspecialchars($user["email"]); ?></p>
                <p style="color: #ccc; margin: 10px 0;"><?php echo htmlspecialchars($user["address"]); ?></p>
                <p style="color: #ccc; margin: 10px 0;"><?php echo htmlspecialchars($user["phone"]); ?></p>

                <!-- User ID -->
                <div style="margin-top: 15px;">
                    <strong style="color: #f7f7f7;">User ID:</strong> <?php echo $user["id"]; ?>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer>
            <p>&copy; Developed by <span style="color:#ffc107;">Rakib Chowdhury</span></p>
        </footer>
    </div>
</body>
</html>

<?php 
// Close the database connection
mysqli_close($conn); 
?>
