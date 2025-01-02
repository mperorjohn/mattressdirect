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
                    <a class="nav-link" href="index.php">HOME</a>
                </li>
                <li class="nav-item dropdown <?php echo basename($_SERVER['PHP_SELF']) == 'shop.php' ? 'active' : ''; ?>">
                    <a class="nav-link dropdown-toggle" href="#" id="shopDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        SHOP BY BRAND
                    </a>
                    <ul class="dropdown-menu bg-white text-primary" aria-labelledby="shopDropdown">
                        <div class="d-none d-md-flex flex-wrap">
                            <?php
                            // Assuming you have an array of brands
                            $brands = [
                                ['id' => 1, 'name' => 'Brand 1', 'image' => 'https://mattress.ng/image/cache/catalog/mouka%20logo%20x-100x100.png'],
                                ['id' => 2, 'name' => 'Brand 2', 'image' => 'https://mattress.ng/image/cache/catalog/mouka%20logo%20x-100x100.png'],
                                // Add more brands as needed
                            ];

                            foreach ($brands as $brand) {
                                echo '<div class="p-2">';
                                echo '<a class="dropdown-item" href="shop.php?brand_id=' . $brand['id'] . '">';
                                echo '<img src="' . $brand['image'] . '" alt="' . $brand['name'] . '" height="50" width="auto"> ' . $brand['name'];
                                echo '</a>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                        <div class="d-md-none">
                            <?php
                            foreach ($brands as $brand) {
                                echo '<li><a class="dropdown-item" href="shop.php?brand_id=' . $brand['id'] . '">';
                                echo '<img src="' . $brand['image'] . '" alt="' . $brand['name'] . '" height="20" width="auto"> ' . $brand['name'];
                                echo '</a></li>';
                            }
                            ?>
                        </div>
                    </ul>
                </li>
                
                <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'pillow.php' ? 'active' : ''; ?>">
                    <a class="nav-link" href="pillow.php">PILLOW</a></li>
               
                <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">
                    <a class="nav-link" href="contact.php">CONTACT US</a></li>
                
            </ul>

            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="images/user.svg" alt="User">
                    </a>
                    <ul class="dropdown-menu bg-white text-primary" aria-labelledby="loginDropdown">
                        <li><a class="dropdown-item" href="login.php">LOGIN</a></li>
                        <li><a class="dropdown-item" href="register.php">REGISTER</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php"><img src="images/cart.svg" alt="Cart"></a>
                </li>
            </ul>
        </div>
    </div>
</nav>