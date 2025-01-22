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

// :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: Session Timeout :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
$timeout_duration = 86400;

if (isset($_SESSION['last_activity'])) {
    $session_lifetime = time() - $_SESSION['last_activity'];

    if ($session_lifetime > $timeout_duration) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }
}

$_SESSION['last_activity'] = time();

$check_login = isset($_SESSION['user']) && !empty($_SESSION['user']);

if (isset($_SESSION['permission']) && $_SESSION['permission'] === 1) {
    header('Location: ./admin/index.php');
    exit();
}
// :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: End Session Timeout ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
?>
<!-- Start Header -->
<div class="bg-primary mb-0 " style="background: linear-gradient(90deg, #04048C, #04048C); color: white;">
    <div class="container">
    <div class="row align-items-center text-center text-md-start justify-content-center justify-content-md-between py-3">
    <!-- Left Column -->
    <div class="col-md-6 mb-2 mb-md-0 d-flex justify-content-center justify-content-md-start align-items-center d-none d-md-flex">
        <span class="me-2">Follow us</span>
        <a href="<?php echo $_ENV['APP_WHATSAPP']; ?>" target="_blank" class="text-decoration-none text-white">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="<?php echo $_ENV['APP_WHATSAPP']; ?>" target="_blank" class="text-decoration-none text-white ms-2">
            <i class="fab fa-twitter"></i>
        </a>
        <a href="<?php echo $_ENV['APP_WHATSAPP']; ?>" target="_blank" class="text-decoration-none text-white ms-2">
            <i class="fab fa-instagram"></i>
        </a>
    </div>
    <div class="col-md-6 mb-2 mb-md-0 d-lg-none">
        <a class="navbar-brand d-block d-md-none" href="index.php">
            <img src="images/MATDRLOGO.png" alt="Logo" height="120" style="width: auto;">
        </a>
    </div>
    <!-- Right Column -->
    <div class="col-md-6 mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
        <!-- WhatsApp Link -->
        <a href="https://wa.me/<?php echo htmlspecialchars($_ENV['APP_WHATSAPP']); ?>" class="text-decoration:none; " target="_blank" class="d-flex align-items-center text-decoration-none">
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" height="30" alt="Chat on WhatsApp">
            <span class="ms-2" style="background-color: #DCDC00; font-weight: bold;">
                <?php echo htmlspecialchars($_ENV['APP_WHATSAPP']); ?>
            </span>
        </a>
        <!-- Cart Dropdown -->
        <span class="nav-item dropdown ms-3">
            <a class="nav-link position-relative dropdown-toggle" href="#" id="cartDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="images/cart.svg" alt="Cart">
                <span id="cartItemCount" class="position-absolute top-0 start-70 translate-middle badge rounded-pill bg-danger" style="display: none;">
                    <span class="visually-hidden">unread messages</span>
                </span>
            </a>
            <ul class="dropdown-menu bg-white text-primary" aria-labelledby="cartDropdown">
                <li><a class="dropdown-item" href="cart.php">View Cart</a></li>
                <li><a class="dropdown-item" href="checkout.php">Checkout</a></li>
            </ul>
        </span>
    </div>
</div>

    </div>
</div>
<!-- Start Navbar -->
<div class="container">
    <hr class="m-0 " >
</div>
<nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand d-none d-md-block" href="index.php">
            <img src="images/MATDRLOGO.png" height="100" width="auto" alt="">
        </a>


        <div class="col-lg-4 col-md-4">
            <form action="" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-secondary ms-2">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
           Menu <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php">HOME</a>
                </li>
                <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'shop.php' ? 'active' : ''; ?>">
                    <a class="nav-link" href="shop.php">SHOP BY BRAND</a>
                </li>
                <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'pillow.php' ? 'active' : ''; ?>">
                    <a class="nav-link" href="pillow.php">PILLOW</a>
                </li>
                <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">
                    <a class="nav-link" href="contact.php">CONTACT US</a>
                </li>
            </ul>

            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="loginDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="images/user.svg" alt="User" class="me-2">
                        <span class="fw-bold"><?php echo $check_login ? $_SESSION['user']->first_name : ''; ?></span>
                    </a>
                    <ul class="dropdown-menu bg-white text-primary" aria-labelledby="loginDropdown">
                        <li><a class="dropdown-item" href="<?php echo $check_login ? 'logout.php' : 'login.php'; ?>"><?php echo $check_login ? 'LOGOUT' : 'LOGIN'; ?></a></li>
                        <?php if (!$check_login): ?>
                            <li><a class="dropdown-item" href="register.php">REGISTER</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function updateCartCount() {
        var cart = JSON.parse(localStorage.getItem('cart')) || [];
        var cartItemCount = cart.length;
        var cartItemCountElement = document.getElementById('cartItemCount');
        
        if (cartItemCount > 0) {
            cartItemCountElement.textContent = cartItemCount;
            cartItemCountElement.style.display = 'inline';
        } else {
            cartItemCountElement.style.display = 'none';
        }
    }

    updateCartCount();

    window.addEventListener('storage', function(event) {
        if (event.key === 'cart') {
            updateCartCount();
        }
    });
});
</script>



