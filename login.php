<?php
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();




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
                            <div class="block-header">
                                <a class="navbar-brand" href="index.php">Furni<span>.</span></a>
                            </div>
                            <div class="block-body mb-3">
                                <form method="post" onsubmit="return validateForm()">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Username or Email</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                    <div class="mb-3 form-check d-flex justify-content-between">
                                        <p>forgot password? <a href="forgot-password.php">Click here</a></p>
                                        <a href="register.php">Don't have an account? Register here</a>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Login</button>

                                    <div class="mt-3">
                                        <p class="text-center">Or login with</p>
                                        <a href="#" style="background-color:transparent; border:2px solid #4169E1; color:#4169E1;" class="btn btn-light w-100 mt-2"><img src="images/google.png" height="20" with="auto" /> Google</a>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
        function validateForm() {
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            if (email == "" || password == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Both fields must be filled out',
                    confirmButtonColor: '#4169E1',
                    cancelButtonColor: '#d33',
                    background: '#fffff',
                    color: '#721c24'
                });
                return false;
            }
            return true;
        }
        </script>

        <!-- <script>
        function validateForm() {
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            if (email == "" || password == "") {
                alert("Both fields must be filled out");
                return false;
            }
            return true;
        }
        </script> -->




	

		<!-- Start Footer Section -->
		<?php include 'components/footer.php'; ?>
		<!-- End Footer Section -->


		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
	</body>

</html>
