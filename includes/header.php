<?php
session_start();
$activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FUZION</title>
    <link rel="stylesheet" href="css/styles.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom CSS for Navbar -->
    <style>
        .navbar {
            background: linear-gradient(90deg, rgba(40, 167, 69, 1), rgba(25, 135, 84, 1));
        }
        .navbar-brand {
            font-size: 1.8rem;
            font-weight: bold;
            color: white !important;
            transition: transform 0.3s ease;
        }
        .navbar-brand:hover {
            transform: scale(1.1);
        }
        .nav-link {
            color: white !important;
            font-weight: 500;
            margin: 0 10px;
            padding: 8px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.3);
            font-weight: bold;
        }
        .btn-outline-danger {
            color: white;
            border-color: white;
            transition: all 0.3s ease;
        }
        .btn-outline-danger:hover {
            background-color: white;
            color: #dc3545;
        }
        .navbar-toggler {
            border-color: white;
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255, 255, 255, 1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="index.php">FUZION</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link <?php echo ($activePage == 'index') ? 'active' : ''; ?>" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link <?php echo ($activePage == 'products') ? 'active' : ''; ?>" href="products.php">Products</a></li>
                        <li class="nav-item"><a class="nav-link <?php echo ($activePage == 'cart') ? 'active' : ''; ?>" href="cart.php">Cart</a></li>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <li class="nav-item"><a class="nav-link btn btn-outline-danger px-3" href="logout.php">Logout</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link <?php echo ($activePage == 'login') ? 'active' : ''; ?>" href="login.php">Login</a></li>
                            <li class="nav-item"><a class="nav-link <?php echo ($activePage == 'register') ? 'active' : ''; ?>" href="register.php">Register</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>