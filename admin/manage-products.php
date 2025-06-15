<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: manage-products.php');
}

include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];

    move_uploaded_file($_FILES['image']['tmp_name'], "../images/$image");

    $query = "INSERT INTO products (name, description, price, image, category, stock) 
              VALUES ('$name', '$description', '$price', '$image', '$category', '$stock')";
    mysqli_query($conn, $query);
}
?>

<form method="POST" action="" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Product Name" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <input type="number" name="price" placeholder="Price" required>
    <input type="file" name="image" required>
    <input type="text" name="category" placeholder="Category" required>
    <input type="number" name="stock" placeholder="Stock" required>
    <button type="submit">Add Product</button>
</form>