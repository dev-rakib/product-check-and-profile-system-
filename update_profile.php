<?php
// Include the database connection file
include "dashboard_connection.php";

// Start session to manage logged-in user data
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION["email"])) {
    header("location: login.html");
    exit;
}

// Retrieve the user's email from the session
$email = $_SESSION["email"];

// Get current user data from the database
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Handle form submission for updating profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input to prevent SQL injection
    $newName = mysqli_real_escape_string($conn, $_POST['name']);
    $newAddress = mysqli_real_escape_string($conn, $_POST['address']);
    $newPhone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Initialize the profile picture path (default to current profile picture)
    $newProfilePath = $user["profile_pic"];

    // Handle profile picture upload if a file is selected
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0) {
        // Define the target directory for uploading the file
        $target_dir = "uploads/";
        $filename = basename($_FILES["profile_pic"]["name"]);
        $uniqueFile = uniqid() . "_" . $filename; // Generate a unique file name
        $target_file = $target_dir . $uniqueFile;
    
        // Attempt to move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
            // If the previous profile picture exists and is different, delete it
            if ($user["profile_pic"] && $user["profile_pic"] != $target_file) {
                // Delete the old profile picture file
                if (file_exists($user["profile_pic"])) {
                    unlink($user["profile_pic"]);
                }
            }
    
            $newProfilePath = $target_file; // Update the profile picture path
        } else {
            $error = "Failed to upload new profile picture."; // Error message if upload fails
        }
    }

    // Update user data in the database
    $updateSql = "UPDATE users SET 
        name = '$newName', 
        address = '$newAddress', 
        phone = '$newPhone', 
        profile_pic = '$newProfilePath' 
        WHERE email = '$email'";

    // Execute the update query
    if (mysqli_query($conn, $updateSql)) {
        // Redirect to the profile page with a success message
        header("Location: profile.php?updated=true");
        exit();
    } else {
        // Display an error message if the query fails
        $error = "Update failed: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Character encoding and responsive design meta tags -->
    <meta charset="UTF-8">
    <title>Update Profile - Perfume Zone</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link to custom Glassmorphism CSS -->
    <link rel="stylesheet" href="profile.css">

    <!-- External fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <header class="header">
            <h1 class="brand-title">Perfume Zone Chittagong</h1>
            <p class="section-title">Update Profile</p>
        </header>

        <!-- Navigation Links -->
        <nav class="nav-links">
            <a href="profile.php">Back to Profile</a>
        </nav>

        <!-- Profile Update Form -->
        <section class="form-section">
            <!-- Display error message if any -->
            <?php if (isset($error)): ?>
                <p style="color: #ff6b6b; font-weight: bold; margin-bottom: 20px;"><?php echo $error; ?></p>
            <?php endif; ?>

            <!-- Form to update user details -->
            <form method="POST" class="update-form" enctype="multipart/form-data">
                <!-- Input for Name -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                </div>
                
                <!-- Input for Address -->
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($user['address']); ?>" required>
                </div>
                
                <!-- Input for Phone Number -->
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
                </div>
                
                <!-- Input for Profile Picture -->
                <div class="form-group">
                    <label for="profile_pic">Profile Picture</label>
                    <input type="file" name="profile_pic" id="profile_pic" accept="image/*">
                </div>

                <!-- Submit button -->
                <button type="submit" class="update-btn">Update Profile</button>
            </form>
        </section>

        <!-- Footer Section -->
        <footer>
            <p>&copy; Developed by <span style="color:#ffc107;">Rakib Chowdhury</span></p>
        </footer>
    </div>
</body>
</html>
