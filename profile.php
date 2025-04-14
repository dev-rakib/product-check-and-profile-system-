<?php
// Start session to access session variables
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION["email"])) {
    header("location: login.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Character encoding and responsive design settings -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Page title -->
    <title>Perfume Zone Chittagong - Profile</title>

    <!-- External CSS for profile page styling -->
    <link rel="stylesheet" href="profile.css">

    <!-- Google Fonts for better typography -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
</head>
<body>

    <!-- Include database connection -->
    <?php include "dashboard_connection.php"; ?>

    <!-- Main container to structure content -->
    <div class="container">

        <!-- Header section -->
        <header class="header">
            <h1 class="brand-title">Perfume Zone Chittagong</h1>
            <p class="section-title">User Profile</p>
        </header>

        <!-- Navigation links -->
        <nav class="nav-links">
            <a href="main.php">Go Back</a> <!-- Return to main product page -->
            <a href="update_profile.php">Update</a> <!-- Link to update user info -->
            <a href="login.html">Logout</a> <!-- Link to log out (should ideally be logout.php) -->
        </nav>

        <!-- Profile display section -->
        <section class="profile-table-section">
            <div class="table-wrapper">
                <table>
                    <!-- Table headers -->
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Get logged-in user's email from session
                        $email = $_SESSION["email"];

                        // Query to fetch user details from database
                        $sql = "SELECT * FROM users WHERE email = '$email'";
                        $result = mysqli_query($conn, $sql);

                        // Loop through and display user data
                        while ($user = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $user["id"] . "</td>";
                            echo "<td>" . $user["name"] . "</td>";
                            echo "<td>" . $user["email"] . "</td>";
                            echo "</tr>";
                        }

                        // Close the database connection
                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Footer section -->
        <footer>
            <p>&copy; Developed by <span style="color:#ffc107;">Rakib Chowdhury</span></p>
        </footer>
    </div>
</body>
</html>
