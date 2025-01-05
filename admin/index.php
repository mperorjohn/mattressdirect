<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '../../');
$dotenv->load();

$check_login = isset($_SESSION['user']) && !empty($_SESSION['user']);

// check permission if 1 else redirect back to index 


$url = $_ENV['API_ROOT_DIR'] . 'contact/contactUs.php';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="John Oyekola">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="<?php echo isset($_ENV['APP_DESCRIPTION']) ? $_ENV['APP_DESCRIPTION'] : ''; ?>" />

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/tiny-slider.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <title><?php echo isset($_ENV['APP_NAME']) ? $_ENV['APP_NAME'] : 'Default App Name'; ?> | Dashboard</title>
</head>

<body>

<!-- Navbar section -->
<?php include 'components/navbar.php'; ?>
<!-- End Navbar section -->

<!-- a body with side bar -->
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">
                    <h5><?php echo $_ENV['APP_NAME'];?></h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                        <li class="list-group-item"><a href="products.php"><i class="fas fa-box"></i> Product</a></li>
                        <li class="list-group-item"><a href="contact.php"><i class="fas fa-envelope"></i> Messages</a></li>
                        <li class="list-group-item"><a href="ebook.php"><i class="fas fa-book"></i> Ebook</a></li>
                        <!-- log out -->
                        <?php if ($check_login) : ?>
                        <li class="list-group-item"><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-secondary p-3">
                    <p class="fs-5">Welcome  <?php echo isset($_SESSION['user']) && $_SESSION['user'] ? " " . " " . $_SESSION['user']->first_name : "";?></p>
                 </div>
            </div>
        </div>
    </div>
</div>







 
<!-- Start Footer Section -->
<?php include 'components/footer.php'; ?>
<!-- End Footer Section -->

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/tiny-slider.js"></script>
<script src="js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>