<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<main class="container py-5">
    <?php
    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];
        $query = "SELECT * FROM products WHERE id = $product_id";
        $result = mysqli_query($conn, $query);
        $product = mysqli_fetch_assoc($result);

        if ($product) {
            echo "<div class='row'>
                    <div class='col-md-6'>
                        <img src='images/{$product['image']}' alt='{$product['name']}' class='img-fluid rounded shadow'>
                    </div>
                    <div class='col-md-6'>
                        <h2 class='text-success'>{$product['name']}</h2>
                        <p class='text-muted'>{$product['description']}</p>
                        <h4 class='text-danger'>{$product['price']}$</h4>
                        <form action='cart.php' method='POST' class='mt-3'>
                            <input type='hidden' name='product_id' value='{$product['id']}'>
                            <div class='mb-3'>
                                <label for='quantity' class='form-label'>Quantity:</label>
                                <input type='number' name='quantity' id='quantity' value='1' min='1' class='form-control w-50'>
                            </div>
                            <button type='submit' class='btn btn-success btn-lg'>Add to Cart</button>
                        </form>
                    </div>
                  </div>";

            // Fetch and display similar products
            $category = $product['category']; // Assuming there is a 'category' column in the 'products' table
            $similar_query = "SELECT * FROM products WHERE category = '$category' AND id != $product_id LIMIT 4";
            $similar_result = mysqli_query($conn, $similar_query);

            if (mysqli_num_rows($similar_result) > 0) {
                echo "<hr><h3 class='mt-5'>Similar Products</h3><div class='row'>";
                while ($similar_product = mysqli_fetch_assoc($similar_result)) {
                    echo "<div class='col-md-3'>
                            <div class='card'>
                                <img src='images/{$similar_product['image']}' alt='{$similar_product['name']}' class='card-img-top'>
                                <div class='card-body'>
                                    <h5 class='card-title'>{$similar_product['name']}</h5>
                                    <p class='card-text'>{$similar_product['price']}$</p>
                                    <a href='product-detail.php?id={$similar_product['id']}' class='btn btn-primary'>View Details</a>
                                </div>
                            </div>
                          </div>";
                }
                echo "</div>";
            } else {
                echo "<p>No similar products found.</p>";
            }

        } else {
            echo "<div class='alert alert-danger'>Product not found.</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Invalid product ID.</div>";
    }
    ?>
</main>

<?php include 'includes/footer.php'; ?>
