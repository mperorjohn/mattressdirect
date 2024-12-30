<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$price = 512000;

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
		<link href="./css/style.css" rel="stylesheet">
		<!-- <link rel="stylesheet" href="./css/style.css"> -->
		<title><?php echo isset($_ENV['APP_NAME']) ? $_ENV['APP_NAME'] : 'Default App Name'; ?> | Details</title>


				<style>
					.zoom-container {
						overflow: hidden;
						position: relative;
					}

					.zoom {
						transition: transform .2s; /* Animation */
						transform-origin: center center;
					}

					.zoom-container:hover .zoom {
						transform: scale(1.5); /* (150% zoom) */
					}
				</style>
	</head>

	<body>
	<!-- Navbar section -->
	<?php include 'components/navbar.php'; ?>
	<!-- End Navbar section -->
		
		
	<div class="container">
		<!-- Breadcrumb -->
		<nav class="breadcrumb mt-5" aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Product Details</li>
			</ol>
		</nav>
		<!-- End Breadcrumb -->

		<div class="row">
			<div class="col-md-6">
				<div class="product-image">
					<div class="card">
						<div class="zoom-container">
							<img src="https://mattress.ng/image/cache/catalog/cream1-300x300.jpg" class="card-img-top hover-effect zoom" alt="Product Image" style="height: 100%; width: 100%; margin-top: 5px; object-fit: cover;">
						</div>
					</div>
					
					<div class="related-images mt-3">
						<div class="row justify-content-center">
							<div class="col-6 col-md-3 mb-3">
								<img src="https://mattress.ng/image/cache/catalog/cream1-300x300.jpg" class="img-fluid" alt="Related Image 1" style="height: 200px; width: 100%; object-fit: cover;">
							</div>
							<div class="col-6 col-md-3 mb-3">
								<img src="https://mattress.ng/image/cache/catalog/cream1-300x300.jpg" class="img-fluid" alt="Related Image 2" style="height: 200px; width: 100%; object-fit: cover;">
							</div>
							<div class="col-6 col-md-3 mb-3">
								<img src="https://mattress.ng/image/cache/catalog/bubble2-600x600.jpg" class="img-fluid" alt="Related Image 3" style="height: 200px; width: 100%; object-fit: cover;">
							</div>
							<div class="col-6 col-md-3 mb-3">
								<img src="https://mattress.ng/image/cache/catalog/cream1-300x300.jpg" class="img-fluid" alt="Related Image 4" style="height: 200px; width: 100%; object-fit: cover;">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="product-details card p-5">
					<p class="fs-5">Mouka Foam</p>
					<h2 class=" text-primary fw-bold price" >#<?php echo is_numeric($price) ? number_format($price, 0, '.', ',') : '00'; ?>.00</h2>
					<span>Brand: <span style="font-weight: bold;color:grey;">Mouka</span></span>
					<span >Product Code: <span style="color:grey;">88DBEHHW</span> </span>
					<span >Availability: <span style="color:green;">In Stock</span> </span>

					<div class="mt-3">
						<hr>
						<span class="mt-5 mb-5"></span>
						<p>...</p>
						<hr class="mt-5">
					</div>

					<div>
						<p class="fs-3">Available Options</p>
						<form action="" method="post">
							<div class="form-group">
								<label for="size">Mattress Sizes <span class="text-danger fw-bold">*</span></label>
								<select class="form-select" id="size">
								<option class="form-contolol" value="5">6 x 6 (50,000)</option>
								<option class="form-contolol" value="6">6 x 7 (55,000)</option>
								<option class="form-contolol" value="7">7 x 7 (60,000)</option>
								<option class="form-contolol" value="8">8 x 8 (65,000)</option>
								<option class="form-contolol" value="9">9 x 9 (70,000)</option>
								</select>
							</div>
							
							<div class="form-group d-flex align-items-center mt-3">
								<label for="quantity" class="me-3">Qty</label>
								<input type="number" class="form-control text-center me-3" id="quantity" value="1" min="1" style="width: 80px;">
								<input type="hidden" name="totalPrice" id="totalPrice" value="<?php echo $price; ?>">
								<button class="fw-bold btn btn-primary" style="border-radius:5px ! important;">+ Add to Cart</button>
							</div>
							<hr >
							<p class="text-center fs-5">Checkout</p>
							<div class="form-group d-flex align-items-center justify-content-center ">
								<div class="feature text-center me-5">
									<div class="icon">
										<img src="images/truck.svg" alt="Image" class="img-fluid">
									</div>
									<p class="text-success">Fast &amp; Free Shipping</p>
								</div>
								<!--  -->
								<div class="feature text-center me-5">
									<div class="icon">
										<img src="images/bag.svg" alt="Image" class="imf-fluid">
									</div>
									<p class="text-success">Easy to Shop</p>
								</div>
								<!--  -->
								<div class="feature text-center me-5">
									<div class="icon">
										<img src="images/support.svg" alt="Image" class="imf-fluid">
									</div>
									<p class="text-success">24/7 Support</p>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
	</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
	const quantityInput = document.getElementById('quantity');
	const priceElement = document.querySelector('.price');
	const totalPriceInput = document.getElementById('totalPrice');
	const basePrice = <?php echo $price; ?>;

	// Reset quantity to 1 on page reload
	quantityInput.value = 1;
	priceElement.textContent = `#${basePrice.toLocaleString()}.00`;
	totalPriceInput.value = basePrice;

	quantityInput.addEventListener('input', function() {
		const quantity = parseInt(this.value);
		const totalPrice = isNaN(quantity) ? 0 : basePrice * quantity;
		priceElement.textContent = `#${totalPrice.toLocaleString()}.00`;
		totalPriceInput.value = totalPrice;
		console.log(totalPrice);
	});
});
</script>
</div>
		


		<!-- Start Footer Section -->
		 <div class="mt-5">

			 <?php include 'components/footer.php'; ?>
		 </div>
		<!-- End Footer Section -->

		<script>
		document.addEventListener('DOMContentLoaded', function() {
			const mainImage = document.querySelector('.product-image .card-img-top');
			const thumbnails = document.querySelectorAll('.related-images .img-fluid');

			thumbnails.forEach(thumbnail => {
				thumbnail.addEventListener('click', function() {
					mainImage.src = this.src;
				});
			});

			const nextButton = document.querySelector('.related-images .btn-primary');
			let currentIndex = 0;

			nextButton.addEventListener('click', function(event) {
				event.preventDefault();
				currentIndex = (currentIndex + 1) % thumbnails.length;
				mainImage.src = thumbnails[currentIndex].src;
			});
		});
		</script>

		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
	</body>

</html>
