<?php
$conn = new mysqli('127.0.0.1', 'root', '123456', 'address_book');
if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
}
?>
