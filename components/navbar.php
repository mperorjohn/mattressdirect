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
// Set session timeout (in seconds), e.g., 10 minutes = 600 seconds
$timeout_duration = 86400;

// Check if the session exists and the last activity time
if (isset($_SESSION['last_activity'])) {
    $session_lifetime = time() - $_SESSION['last_activity']; // Time since last activity

    if ($session_lifetime > $timeout_duration) {
        // Session has timed out, destroy it
        session_unset();
        session_destroy();
        header("Location: login.php"); // Redirect to login or timeout page
        exit();
    }
}

// Update last activity time
$_SESSION['last_activity'] = time();

$check_login = isset($_SESSION['user']) && !empty($_SESSION['user']);


// check permission redirect back to /admin/index.php
if(isset($_SESSION['permission']) && $_SESSION['permission'] === 1){
    header('Location: ./admin/index.php');
    exit();
}

// :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: End Session Timeout ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::


?>
<!-- Start Header/Navigation -->
 <div class="bg-primary mb-0" style="background-color: #04048C !important; color: white;">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 text-center text-md-start">
               <button class="btn btn-secondary mt-3 mb-3" style="border:2px solid red;" onclick="window.location='guide.php'">Wise buyer only !</button>
            </div>
            <div class="col-12 col-md-6 text-center text-md-end">
                <p class="fs-6 mt-0 mb-0">Contact: <?php echo $_ENV['APP_CONTACT']; ?></p>
            </div>  
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 text-center text-md-start">
                <p class="fs-6 mb-0">Follow us: 
                    <span class="me-2"><a href="#"><span style="color:white !important;" class="fa fa-brands fa-facebook-f"></a></span>	
                    <span class="me-2"><a href="#"><span style="color:white !important;" class="fa fa-brands fa-twitter"></span></a></span>
                    <span class="me-2"><a href="#"><span style="color:white !important;" class="fa fa-brands fa-instagram"></span></a></span>
                </p>
            </div>
            <div class="col-lg-4 col-md-4">
                <form action="" method="GET" class="d-flex">
                    <input type="text" name="search" id="" class="form-control" placeholder="Search...">
                    <button type="submit" class="btn btn-secondary ms-2">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="col-12 col-md-4 text-center text-md-end">
                <span class="text-secondary">Live Chat <a href="https://wa.me/<?php echo $_ENV['APP_WHATSAPP'];?>" target="_blank">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" height="30" width="auto" alt="Chat on WhatsApp" style="width: 50px;">
                 </a>
                </span>
            </div>
        </div>
    </div>

 </div>
<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar p-3">
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
                <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'shop.php' ? 'active' : ''; ?>">
                    <a class="nav-link" href="shop.php">SHOP BY BRAND</a>
                </li>
                
                <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'pillow.php' ? 'active' : ''; ?>">
                    <a class="nav-link" href="pillow.php">PILLOW</a></li>
               
                <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">
                    <a class="nav-link" href="contact.php">CONTACT US</a></li>
                
            </ul>

            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="loginDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="images/user.svg" alt="User" class="me-2"><span class="fw-bold"><?php echo $check_login?  $_SESSION['user']->first_name : ''; ?></span>
                    </a>
                    <ul class="dropdown-menu bg-white text-primary" aria-labelledby="loginDropdown">
                        <li><a class="dropdown-item" href="<?php echo $check_login ? 'logout.php' : 'login.php'; ?>"><?php echo isset($_SESSION['user']) && !empty($_SESSION['user']) ? 'LOGOUT ' : 'LOGIN'; ?></a></li>
                        <?php if (!$check_login): ?>
                            <li><a class="dropdown-item" href="register.php">REGISTER</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <li class="nav-item dropdown">
                        <a class="nav-link position-relative dropdown-toggle" href="#" id="cartDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="images/cart.svg" alt="Cart">
                            <span id="cartItemCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="display: none;">
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        </a>
                        <ul class="dropdown-menu bg-white text-primary" aria-labelledby="cartDropdown">
                            <li><a class="dropdown-item" href="cart.php">View Cart</a></li>
                            <li><a class="dropdown-item" href="checkout.php">Checkout</a></li>
                        </ul>
                    </li>
                </li>
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

                        // Initial update
                        updateCartCount();

                        // Update cart count when localStorage changes
                        window.addEventListener('storage', function(event) {
                            if (event.key === 'cart') {
                                updateCartCount();
                            }
                        });
                    });
                </script>
            </ul>
        </div>
    </div>
</nav>