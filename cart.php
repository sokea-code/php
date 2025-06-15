<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<main class="container py-5">
    <h2 class="mb-4">Your Cart</h2>
    
    <?php
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] += $quantity;
        } else {
            $_SESSION['cart'][$product_id] = $quantity;
        }
    }
    
    if (empty($_SESSION['cart'])) {
        echo "<div class='alert alert-warning'>Your cart is empty.</div>";
    } else {
        echo "<div class='table-responsive'><table class='table table-bordered'>";
        echo "<thead class='table-dark'><tr><th>Image</th><th>Product</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th>Action</th></tr></thead><tbody>";
        
        $total = 0;
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $query = "SELECT * FROM products WHERE id = $product_id";
            $result = mysqli_query($conn, $query);
            $product = mysqli_fetch_assoc($result);
            $subtotal = $product['price'] * $quantity;
            $total += $subtotal;
            
            echo "<tr>
                    <td><img src='images/{$product['image']}' alt='{$product['name']}' class='img-fluid' style='max-width: 80px;'></td>
                    <td>{$product['name']}</td>
                    <td>{$product['price']}$</td>
                    <td>{$quantity}</td>
                    <td>{$subtotal}$</td>
                    <td><a href='remove-from-cart.php?id=$product_id' class='btn btn-danger btn-sm'>Remove</a></td>
                  </tr>";
        }
        
        echo "</tbody></table></div>";
        echo "<div class='text-end'><h4>Total: $$total</h4></div>";
        echo "<div class='text-end mt-3'><a href='checkout.php' class='btn btn-success'>Proceed to Checkout</a></div>";
    }
    ?>
</main>

<?php include 'includes/footer.php'; ?>
