<?php
$mysqli = new mysqli("localhost", "root", "", "web_mysqli", 3306);

// Check connection
if ($mysqli->connect_error) {
    echo "Kết nối lỗi: " . $mysqli->connect_error;
    exit();
}
?>