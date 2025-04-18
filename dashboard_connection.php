<?php

#connecting dashboard
$host = "localhost";
$user = "root";
$password = "ShoJack(120)";
$db = "pzc-tables";

try {
    $conn = mysqli_connect($host,$user,$password,$db);

    if (!$conn){
        echo "Server Not Connected";
    }
} catch (Exception $e){
    echo "ERROR: $e";
}

#creating needed table
// $sql = "CREATE TABLE IF NOT EXISTS orders (
//     order_id INT AUTO_INCREMENT PRIMARY KEY,
//     user_id INT NOT NULL,
//     product_id INT NOT NULL,
//     product_name VARCHAR(255) NOT NULL,
//     quantity INT NOT NULL,
//     price DECIMAL(10, 2) NOT NULL,
//     ordered_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
//     FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
// ) ENGINE=InnoDB;";

// if ($conn->query($sql) === TRUE) {
//     echo "Table 'orders' created successfully!";
// } else {
//     echo "Error creating table: " . $conn->error;
// }
?>
