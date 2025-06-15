<?php 
include 'includes/db.php';
include 'includes/header.php';
?>

<style>
    .checkout-container {
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        text-align: center;
        max-width: 600px;
        width: 100%;
        margin: auto;
        margin-top: 50px;
    }

    h2 {
        font-size: 28px;
        color: #444;
        margin-bottom: 20px;
    }

    .total-amount {
        font-size: 22px;
        font-weight: bold;
        color: #c19b76;
        margin-bottom: 20px;
    }

    .paypal-container {
        margin-top: 20px;
    }

    .empty-cart {
        font-size: 18px;
        color: #888;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        height: 45px;
        border-radius: 5px;
        padding: 10px;
        border: 1px solid #ccc;
        width: 100%;
    }

    .btn-checkout {
        background-color: #28a745;
        color: white;
        font-size: 18px;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
        width: 100%;
        margin-top: 20px;
    }
</style>

<main class='body12'>
    <div class="checkout-container">
        <h2>Checkout</h2>
        <?php
        if (empty($_SESSION['cart'])) {
            echo "<p class='empty-cart'>Your cart is empty.</p>";
        } else {
            // Calculate the total amount
            $total = 0;
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                $query = "SELECT price FROM products WHERE id = $product_id";
                $result = mysqli_query($conn, $query);
                $product = mysqli_fetch_assoc($result);
                $total += $product['price'] * $quantity;
            }

            echo "<p class='total-amount'>Total: $total$</p>";
        ?>
            <!-- User Info Form -->
            <form id="checkoutForm">
                <div class="form-group">
                    <input type="text" id="fullName" class="form-control" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                    <input type="tel" id="phoneNumber" class="form-control" placeholder="Phone Number" required>
                </div>
                <div class="form-group">
                    <input type="email" id="email" class="form-control" placeholder="Email Address" required>
                </div>
                <button type="button" class="btn-checkout" id="checkoutButton">Proceed to PayPal</button>
            </form>

            <div id="paypal-button-container" class="paypal-container"></div>
        <?php
        }
        ?>
    </div>
</main>

<!-- Include the PayPal JavaScript SDK -->
<script src="https://www.paypal.com/sdk/js?client-id=AZNuL9hNmkDLeCAidODattrswtdGClTj1jF59gD2rzTrVu015wtFNbRa3A6DoAwQ9lftpw2WJCjSQ6Db&currency=USD"></script>
<script>
    // Hide PayPal button initially
    document.getElementById('paypal-button-container').style.display = 'none';

    // When the "Proceed to PayPal" button is clicked
    document.getElementById('checkoutButton').addEventListener('click', function() {
        // Validate user input
        const fullName = document.getElementById('fullName').value;
        const phoneNumber = document.getElementById('phoneNumber').value;
        const email = document.getElementById('email').value;

        if (fullName === '' || phoneNumber === '' || email === '') {
            alert('Please fill in all required fields.');
            return;
        }

        // Show PayPal button after validation
        document.getElementById('checkoutForm').style.display = 'none';
        document.getElementById('paypal-button-container').style.display = 'block';

        // Render the PayPal button
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo $total; ?>'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    alert('Transaction completed by ' + details.payer.name.given_name);
                    window.location.href = 'order-confirmation.php';
                });
            }
        }).render('#paypal-button-container');
    });
</script>
