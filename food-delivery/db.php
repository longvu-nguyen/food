<?php
$conn = new mysqli("localhost", "root", "", "food_delivery");
if ($conn->connect_error) {
    die("Lỗi kết nối: " . $conn->connect_error);
}
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>