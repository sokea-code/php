<?php include 'includes/header.php'; ?>

<main>
    <section class="hero">
        <h1 class="texth1">Welcome to FUZION</h1>
        <p>Your one-stop shop for Fashion and Looks Cool.</p>
        <a href="products.php" class="btn">Shop Now</a>
    </section>

    <style>
        .featured-products {
            margin: 50px 0;
            padding: 0 20px;
        }

        .featured-products h2 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .product-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .product-card h5 {
            font-size: 18px;
            font-weight: 600;
            margin: 15px 0 10px;
            padding: 0 15px;
            color: #333;
        }

        .product-card p {
            font-size: 16px;
            color: #333;
            padding: 0 15px;
        }

        .product-card .btn {
            display: block;
            width: 80%;
            margin: 10px auto 20px;
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 10px 0;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
        }

        .product-card .btn:hover {
            background-color: #0056b3;
        }
    </style>

    <section class="featured-products">
        <h2>Featured Products</h2>
        <div class="product-grid">
            <?php
            include 'includes/db.php';
            $query = "SELECT * FROM products LIMIT 4";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='product-card'>
                        <img src='images/{$row['image']}' alt='{$row['name']}'>
                        <h5>{$row['name']}</h5>
                        <p>{$row['price']}$</p>
                        <a href='product-detail.php?id={$row['id']}' class='btn'>View Details</a>
                      </div>";
            }
            ?>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
