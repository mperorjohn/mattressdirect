<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '../../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '../../../');
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

// :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: End Session Timeout ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

// ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

// check permission redirect back to /admin/index.php
if(!isset($_SESSION['permission']) || $_SESSION['permission'] !== 1){
    header('Location: ../index.php');
    exit();
}

?>
<!-- Start Header/Navigation -->
 
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

        </div>
    </div>
</nav>


<style>
    a{
        text-decoration: none !important;
    }
</style>


