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
// $sql = "CREATE TABLE products (
//     id INT PRIMARY KEY AUTO_INCREMENT,
//     name VARCHAR(100) NOT NULL,
//     quantity INT NOT NULL,
//     price INT NOT NULL,
//     insert_time DATETIME DEFAULT CURRENT_TIMESTAMP
// )";

// if (mysqli_query($conn,$sql)){
//     echo "Table Created";
// } else {
//     echo "Not Created";
// }
?>
