<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

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
		<title><?php echo isset($_ENV['APP_NAME']) ? $_ENV['APP_NAME'] : 'Default App Name'; ?> | Register</title>
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
                                <h1>Register</h1>
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
                            <div class="block-body mb-5">
                                <form method="post" onsubmit="return validateForm()">
                                    

                                    <div>
                                        <p>Already have an account? <a href="login.php">Login here</a></p>
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
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    background: '#f8d7da',
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
