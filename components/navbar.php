<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Set environment variables in $_ENV
foreach ($_SERVER as $key => $value) {
    if (strpos($key, 'APP_') === 0) {
        $_ENV[$key] = $value;
    }
}



?>

<!-- Start Header/Navigation -->
<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
    <div class="container">
        <a class="navbar-brand" href="index.php"><img src="images/matlogomain.png" height="40" width="auto" alt=""><span></span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'shop.php' ? 'active' : ''; ?>">
                    <a class="nav-link" href="shop.php">Shop</a></li>
                <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>">
                    <a class="nav-link" href="about.php">About us</a></li>
                <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'services.php' ? 'active' : ''; ?>">
                    <a class="nav-link" href="services.php">Services</a></li>
                <li class="nav-item dropdown <?php echo basename($_SERVER['PHP_SELF']) == 'brands.php' ? 'active' : ''; ?>">
                    <a class="nav-link dropdown-toggle" href="#" id="brandsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Brands
                    </a>
                    <ul class="dropdown-menu bg-primary text-white" aria-labelledby="brandsDropdown">
                        <li><a class="dropdown-item" href="#">Brand 1</a></li>
                        <li><a class="dropdown-item" href="#">Brand 2</a></li>
                        <li><a class="dropdown-item" href="#">Brand 3</a></li>
                    </ul>
                </li>
                <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">
                    <a class="nav-link" href="contact.php">Contact us</a></li>
            </ul>

            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                <li>
                    <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="images/user.svg">
                    </a>
                    <ul class="dropdown-menu bg-primary text-white" aria-labelledby="loginDropdown">
                        <li><a class="dropdown-item" href="login.php">Login</a></li>
                        <li><a class="dropdown-item" href="register.php">Register</a></li>
                    </ul>
                </li>
                <li><a class="nav-link" href="cart.php"><img src="images/cart.svg"></a></li>
            </ul>
        </div>
    </div>
</nav>