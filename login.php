<?php
session_start();

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


// redirect if check_login is true

$check_login = isset($_SESSION['user']) && !empty($_SESSION['user']);
if ($check_login) {
    header('Location: index.php');
    exit();
}





$url = $_ENV['API_ROOT_DIR'] . 'user/login.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $data = ['email' => $email, 'password' => $password];
    $jsonData = json_encode($data);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

    $result = curl_exec($ch);
    if ($result === false) {
        echo json_encode(['status' => false, 'message' => 'Failed to connect to API']);
        exit();
    }

    $response = json_decode($result);
    curl_close($ch);

    if ($response === null || !isset($response->status)) {
        echo json_encode(['status' => false, 'message' => 'Invalid API response']);
        exit();
    }

    if ($response->status == true) {
        $_SESSION['user'] = $response->data;
        $_SESSION['last_activity'] = time();
        echo json_encode(['status' => true, 'message' => 'Login successful']);
        exit();
    } else {
        echo json_encode(['status' => false, 'message' => $response->message]);
        exit();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
 <meta name="keywords" content="<?php echo isset($_ENV['APP_DESCRIPTION']) ? $_ENV['APP_DESCRIPTION'] : ''; ?>" />

        <!-- Bootstrap CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link href="css/tiny-slider.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <title><?php echo isset($_ENV['APP_NAME']) ? $_ENV['APP_NAME'] : 'Default App Name'; ?> | Login</title>
    </head>

    <body>

    <!-- Navbar section -->
    <?php include 'components/navbar.php'; ?>
    <!-- End Navbar section -->
        
        <!-- Start Hero Section -->
            <div class="hero">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-lg-5">
                            <div class="intro-excerpt">
                                <h1>Login</h1>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            
                        </div>
                    </div>
                </div>
            </div>
        <!-- End Hero Section -->


        <div class="untree_co-section before-footer-section mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="block">
                            <div class="block-header mb-5 mt-3">
                                <a class="navbar-brand" href="index.php"><img src="images/matlogo2.png" height="50" width="auto" alt="" srcset=""><span>.</span></a>
                            </div>
                            <div class="block-body mb-3">
                                <form id="loginForm" method="post">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Username or Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="mb-3 form-check d-flex justify-content-between">
                                        <p>forgot password? <a href="forgot-password.php">Click here</a></p>
                                        <a href="register.php">Don't have an account? Register here</a>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="images/why-choose-us-img.jpg" class="img-fluid me-5" alt="">
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var form = this;
            var formData = new FormData(form);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', form.action, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === true) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Login successful',
                            confirmButtonColor: '#ffffff',
                            confirmButtonText: '<span style="color: #04048C;">OK</span>',
                            cancelButtonColor: '#d33',
                            background: '#04048C',
                            color: '#DCDC00'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = 'index.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            background: '#f8d7da',
                            color: '#721c24'
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        background: '#f8d7da',
                        color: '#721c24'
                    });
                }
            };
            xhr.send(formData);
        });
        </script>

        <!-- Start Footer Section -->
        <?php include 'components/footer.php'; ?>
        <!-- End Footer Section -->

        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/tiny-slider.js"></script>
        <script src="js/custom.js"></script>
    </body>

</html>
