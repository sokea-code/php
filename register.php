<?php include 'includes/db.php'; 
include 'includes/header.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - FUZION</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5 mb-5">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h2 class="card-title text-center mb-4">Sign Up</h2>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $name = $_POST['name'];
                            $email = $_POST['email'];
                            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

                            $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
                            if (mysqli_query($conn, $query)) {
                                echo "<div class='alert alert-success text-center mb-4'>Registration successful. <a href='login.php' class='alert-link'>Login here</a>.</div>";
                            } else {
                                echo "<div class='alert alert-danger text-center mb-4'>Error: " . mysqli_error($conn) . "</div>";
                            }
                        }
                        ?>
                        <form method="POST" action="register.php">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Sign Up</button>
                            <p class="text-center mt-3 mb-0">Already have an account? <a href="login.php" class="text-success text-decoration-none">Login</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
include 'includes/footer.php';
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>