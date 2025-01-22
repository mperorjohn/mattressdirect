<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$search = isset($_GET['search']) ? $_GET['search'] : null;


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
		<title><?php echo isset($_ENV['APP_NAME']) ? $_ENV['APP_NAME'] : 'Default App Name'; ?> | Home</title>
	</head>

	<body>
	<!-- Navbar section -->
	<?php include 'components/navbar.php'; ?>
	<!-- End Navbar section -->
		<!-- Start Banner Carousel -->
		<div class="container  <?php echo isset($_GET['search']) ? 'd-none' : ''; ?>">
			<div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img src="images/Banner.jpg" class="d-block mx-auto img-fluid" alt="Banner 1">
						<div class="carousel-caption d-none d-md-block">
							<!-- <h5>First Slide</h5>
							<p>First slide description.</p> -->
						</div>
					</div>
					<div class="carousel-item">
						<img src="images/sofa.png" class="d-block mx-auto img-fluid" alt="Banner 2">
						<div class="carousel-caption d-none d-md-block">
							<!-- <h5>Second Slide</h5>
							<p>Second slide description.</p> -->
						</div>
					</div>
					<div class="carousel-item">
						<img src="images/product-2.png" class="d-block mx-auto img-fluid" alt="Banner 3">
						<div class="carousel-caption d-none d-md-block">
							<!-- <h5>Third Slide</h5>
							<p>Third slide description.</p> -->
						</div>
					</div>
				</div>
				<button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Previous</span>
				</button>
				<button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Next</span>
				</button>
			</div>
		</div>
		<div class="container  <?php echo isset($_GET['search']) ? 'd-none' : ''; ?> ">
		 <div class="row">
			 <div class="col-md-12 mt-5 text-center">
				<p style="text-transform:uppercase; line-height:1.5;" class="text-black fs-1 mt-3">Discover the <span class="text-danger">5 Mistakes to Avoid when buying a mattress</span> for better sleep, health and all - day productivity</p>
				<p class="fs-6">Research Reveals That Low-Quality Mattress Can Increase Your Stress Levels and Affect Productivity in Life… But This Mattress Buying Guide Will Ensure You Buy the Right Mattress Without Any Hassle!</p>
				
				<a href="guide.php"  class="btn btn-primary">Download Guide <span class="me-3"><i class="fa-solid fa-download"></i></span></a>
			 </div>
		 </div>
	 </div>
		<!-- End Banner Carousel -->
		<!-- Start Foam Brands Section -->
		<div class="container my-5">
			<!-- <h2 class="text-left mb-4 text-primary">Our Foam Brands</h2> -->
			<div class="row">
				<div class="col-12">
					<div id="brandCarousel" class="carousel slide" data-bs-ride="carousel">
						<div class="carousel-inner">
							<div class="carousel-item active">
								<div class="row">
									<div class="col-3">
										<img src="images/mouka.png" class="img-fluid" style="width: 100px; height: auto;" alt="Brand 1">
									</div>
									<div class="col-3">
										<img src="images/vitafoam-plc-nigeria--600.png" class="img-fluid" style="width: 100px; height: auto;" alt="Brand 2">
									</div>
									<div class="col-3">
										<img src="images/sarafoam.png" class="img-fluid" style="width: 100px; height: auto;" alt="Brand 3">
									</div>
									<div class="col-3">
										<img src="images/unifoam.jpg" class="img-fluid" style="width: 100px; height: auto;" alt="Brand 4">
									</div>
								</div>
							</div>
							<div class="carousel-item">
								<div class="row">
									<div class="col-3">
										<img src="images/wincodownload.jpeg" class="img-fluid" style="width: 100px; height: auto;" alt="Brand 1">
									</div>
									<div class="col-3">
										<img src="images/royalfoam.png" class="img-fluid" style="width: 100px; height: auto;" alt="Brand 2">
									</div>
									<div class="col-3">
										<img src="https://olivefoam.ng/wp-content/uploads/2024/08/olive_foam_logo2-removebg-preview.png" class="img-fluid" style="width: 100px; height: auto;" alt="Brand 3">
									</div>
									<div class="col-3">
										<img src="https://mattress.ng/image/cache/catalog/1111/WhatsApp%20Image%202024-11-05%20at%2012.09.19_373a23a1-825x220.png" class="img-fluid" style="width: 100px; height: auto;" alt="Brand 4">
									</div>
								</div>
							</div>
						</div>
						<!-- <button class="carousel-control-prev" type="button" data-bs-target="#brandCarousel" data-bs-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Previous</span>
						</button>
						<button class="carousel-control-next" type="button" data-bs-target="#brandCarousel" data-bs-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Next</span>
						</button> -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Foam Brands Section  -->
		<!-- Start Best Selling Section -->
		<div class="container my-2">
			<div class="p-3">
				<h2 class="text-left mb-4 text-primary">Latest Products</h2>
			</div>
			<hr>
		</div>
		<!-- End Best Selling Section -->
		<!-- Start Product Cards Section -->
		<div class="container my-5">
			<div class="row">
				
					<?php include 'components/card.php' ?>
			</div>
		</div>
		<div class="d-flex bg-primary align-items-center justify-content-center container text-white">
			<div class="d-flex justify-content-center mt-5">
				<div class=" text-center me-5">
					<div class="icon">
						<i class="fas fa-truck fa-2x text-secondary"></i>
					</div>
					<p class="text-secondary">Fast &amp; Free Shipping</p>
				</div>
				<div class=" text-center me-5">
					<div class="icon">
						<i class="fas fa-shopping-bag fa-2x text-secondary"></i>
					</div>
					<p class="text-secondary">Easy to Shop</p>
				</div>
				<div class=" text-center me-5">
					<div class="icon">
						<i class="fas fa-headset fa-2x text-secondary"></i>
					</div>
					<p class="text-secondary">24/7 Support</p>
				</div>
			</div>
		</div>

		<?php include 'components/payment-channel.php'; ?>

		



		<!-- End Product Cards Section -->

		<!-- Start Hero Section -->
			<!-- <div class="hero " >
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Comfortable and Affordable <span class="d-block">Mattresses</span></h1>
								<p class="mb-4">Experience the best sleep of your life with our top-quality mattresses. Designed for comfort and durability, our mattresses are perfect for every home.</p>
								<p><a href="shop.php" class="btn btn-secondary me-2">Shop Now</a></p>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="hero-img-wrap">
								<img src="images/Pillow.png" height="70" width="auto" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</div>
		End Hero Section -->

		<!-- Start Product Section -->
	
		<!-- Start Why Choose Us Section -->
		<!-- <div class="why-choose-section">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-6">
						<h2 class="section-title">Why Choose Us</h2>
						<p>We offer a wide range of high-quality mattresses that combine comfort and affordability. Our products are designed to provide you with the best sleep experience, ensuring you wake up refreshed and ready to take on the day.</p>

						<div class="row my-5">
							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="images/truck.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>Fast &amp; Free Shipping</h3>
									<p>Enjoy fast and free shipping on all orders, ensuring you receive your new mattress quickly and without any extra cost.</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="images/bag.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>Easy to Shop</h3>
									<p>Our shopping process is straightforward and user-friendly, ensuring a seamless experience from browsing to checkout.</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="images/support.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>24/7 Support</h3>
									<p>Our dedicated support team is available 24/7 to assist you with any questions or concerns, ensuring a smooth and satisfying shopping experience.</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="images/return.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>Hassle Free Returns</h3>
									<p>We offer a hassle-free return policy, allowing you to return products within 30 days if you are not completely satisfied with your purchase.</p>
								</div>
							</div>

						</div>
					</div>

					<div class="col-lg-5">
						<div class="img-wrap">
							<img src="images/why-choose-us-img.jpg" alt="Image" class="img-fluid">
						</div>
					</div>

				</div>
			</div>
		</div> -->
		<!-- End Why Choose Us Section -->

		<?php include 'components/testimonial.php'; ?>


		<!-- Start Footer Section -->
		<?php include 'components/footer.php'; ?>
		<!-- End Footer Section -->


		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
	</body>

</html>
