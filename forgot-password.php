<?php

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
       

        <!-- Start Footer Section -->
        <?php include 'components/footer.php'; ?>
        <!-- End Footer Section -->

        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/tiny-slider.js"></script>
        <script src="js/custom.js"></script>
    </body>

</html>
