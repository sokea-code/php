<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id']) || empty($_SESSION['cart'])) {
    header('Location: index.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$total = 0;

foreach ($_SESSION['cart'] as $product_id => $quantity) {
    $query = "SELECT price FROM products WHERE id = $product_id";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);
    $total += $product['price'] * $quantity;
}

$query = "INSERT INTO orders (user_id, total_price) VALUES ($user_id, $total)";
mysqli_query($conn, $query);
$order_id = mysqli_insert_id($conn);

foreach ($_SESSION['cart'] as $product_id => $quantity) {
    $query = "SELECT price FROM products WHERE id = $product_id";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);
    $price = $product['price'];

    $query = "INSERT INTO order_items (order_id, product_id, quantity, price) 
              VALUES ($order_id, $product_id, $quantity, $price)";
    mysqli_query($conn, $query);
}

unset($_SESSION['cart']);
header('Location: order-confirmation.php');
?>