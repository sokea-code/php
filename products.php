<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<main>
    <h2>Products</h2>
    <div class="container py-5">
        <?php
        $query = "SELECT * FROM products";
        $result = mysqli_query($conn, $query);
        echo "<h3 class='mt-5'>All Products</h3><div class='row'>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo
                  

                  "<div class='col-md-3 mt-5'>
                            <div class='card '>
                                <img src='images/{$row['image']}' alt='{$row['name']}' class='card-img-top'>
                                <div class='card-body'>
                                    <h5 class='card-title'>{$row['name']}</h5>
                                    <p class='card-text'>{$row['price']}$</p>
                                    <a href='product-detail.php?id={$row['id']}' class='btn btn-primary'>View Details</a>
                                </div>
                            </div>
                    </div>";
                  
        }
        ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>