<?php
include "dashboard_connection.php";
session_start();

$email = $_SESSION["email"];

// Get current user data
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newName = $_POST['name'];
    $newEmail = $_POST['email'];

    $updateSql = "UPDATE users SET name = '$newName', email = '$newEmail' WHERE email = '$email'";
    if (mysqli_query($conn, $updateSql)) {
        $_SESSION["email"] = $newEmail; // Update session email if changed
        header("Location: profile.php?updated=true");
        exit();
    } else {
        $error = "Update failed: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1 class="brand-title">Perfume Zone Chittagong</h1>
            <p class="section-title">Update Profile</p>
        </header>

        <nav class="nav-links">
            <a href="profile.php">Back to Profile</a>
        </nav>

        <section class="form-section">
            <?php if (isset($error)): ?>
                <p style="color: #f55; margin-bottom: 15px;"><?php echo $error; ?></p>
            <?php endif; ?>

            <form method="POST" class="update-form">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="<?php echo $user['name']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" required>
                </div>

                <button type="submit" class="update-btn">Update Profile</button>
            </form>
        </section>

        <footer>
            <p>&copy; Developed by <span style="color:#ffc107;">Rakib Chowdhury</span></p>
        </footer>
    </div>
</body>
</html>
