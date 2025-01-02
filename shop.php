<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$products = [];
for ($i = 1; $i <= 10; $i++) {
	$products[] = [
		'id' => $i + 1,
		'name' => 'Product ' . ($i + 2),
		'price' => 512000 + ($i * 10000),
		'image' => 'https://mattress.ng/image/cache/catalog/cream1-300x300.jpg'
	];
}


$brands  = [
	['id' => 1, 'name' => 'Brand 1', 'image' => 'https://mattress.ng/image/cache/catalog/mouka%20logo%20x-100x100.png'],
	['id' => 2, 'name' => 'Brand 2', 'image' => 'https://mattress.ng/image/cache/catalog/vitafoam%20logo%20x-100x100.png'],
	['id' => 3, 'name' => 'Brand 3', 'image' => 'https://mattress.ng/image/cache/catalog/vitafoam%20logo%20x-100x100.png'],
	['id' => 4, 'name' => 'Brand 4', 'image' => 'https://mattress.ng/image/cache/catalog/vitafoam%20logo%20x-100x100.png'],
	['id' => 5, 'name' => 'Brand 5', 'image' => 'https://mattress.ng/image/cache/catalog/vitafoam%20logo%20x-100x100.png'],
	// Add more brands as needed
];



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
		<title><?php echo isset($_ENV['APP_NAME']) ? $_ENV['APP_NAME'] : 'Default App Name'; ?> | Shop</title>
	</head>


	<body>

		<!-- Navbar section -->
	<?php include 'components/navbar.php'; ?>
	<!-- End Navbar section -->


		<div class="container mt-3 pt-3">
		<nav class="breadcrumb mt-3" aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Shop</li>
			</ol>
		</nav>

		<div class="bg-light p-3 mt-3 mb-3 d-flex flex-column flex-md-row justify-content-between align-items-center">
			<p class="fs-5 mb-2 mb-md-0">Items(<?php echo count($products); ?>)</p>
			<p class="fs-5 mb-2 mb-md-0">Showing <span id="startItem">1</span> to <span id="endItem">5</span> of <?php echo count($products); ?> items</p>
			<!-- Sort and Items Per Page Options -->
			<div class="d-flex justify-content-end flex-column flex-md-row">
				<select class="form-select w-auto me-0 me-md-2 mb-2 mb-md-0" id="itemsPerPage">
					<option value="5">Show 5</option>
					<option value="10">Show 10</option>
					<option value="15">Show 15</option>
					<option value="20">Show 20</option>
				</select>
				<select class="form-select w-auto" id="sortOptions">
					<option value="default">Sort by</option>
					<option value="priceAsc">Price: Low to High</option>
					<option value="priceDesc">Price: High to Low</option>
					<option value="nameAsc">Name: A to Z</option>
					<option value="nameDesc">Name: Z to A</option>
				</select>
			</div>
		</div>
<!--  -->
		
		<div class="row">
			<div class="col-md-3">
				<h5>Brands</h5>
				<ul class="list-group list-group-flush">
					<li class="list-group-item"><a href="#">All</a></li>
					<?php foreach ($brands as $brand): ?>
						<li class="list-group-item">
							<a href="shop.php?brand_id=<?php echo $brand['id']; ?>" style="text-decoration: none;">
								<img src="<?php echo $brand['image']; ?>" alt="<?php echo $brand['name']; ?>" style="width: 70px; height: 70px; margin-right: 10px;">
								<?php echo $brand['name']; ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="col-md-9">
				<div class="row" id="productList">
					<?php foreach ($products as $product): ?>
						<div class="col-md-6 col-lg-4 mb-4 product-item" data-price="<?php echo $product['price']; ?>" data-name="<?php echo $product['name']; ?>">
							<div class="card h-100">
								<a href="product-details.php?id=<?php echo $product['id']; ?>">
									<img src="<?php echo $product['image']; ?>" class="card-img-top hover-effect" alt="Product Image" style="height: auto; width: 100%; margin-top: 5px; object-fit: cover;">
								</a>
								<div class="card-body">
									<p class="card-title"><?php echo $product['name']; ?></p>
									<div class="d-flex justify-content-between align-items-center">
										<h5 class="card-text fw-bold mb-0" style="color:#04048C;">#<?php echo number_format($product['price'], 2); ?></h5>
										<a href="#" class="btn btn-sm btn-primary"><i class="fas fa-cart-plus"></i></a>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>

		<!-- Pagination -->
		<nav aria-label="Page navigation example">
			<ul class="pagination justify-content-center mt-4" id="pagination">
				<li class="page-item disabled">
					<a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
				</li>
				<li class="page-item"><a class="page-link" href="#">1</a></li>
				<li class="page-item"><a class="page-link" href="#">2</a></li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item">
					<a class="page-link" href="#">Next</a>
				</li>
			</ul>
		</nav>
	</div>


	<script>
	const jsProducts = <?php echo json_encode($products); ?>;
	let currentPage = 1;
	let itemsPerPage = 5;

	function renderProducts() {
		const productList = document.getElementById('productList');
		productList.innerHTML = '';

		const start = (currentPage - 1) * itemsPerPage;
		const end = start + itemsPerPage;
		const paginatedProducts = jsProducts.slice(start, end);

		paginatedProducts.forEach(product => {
			const productItem = document.createElement('div');
			productItem.className = 'col-md-6 col-lg-3 mb-4 product-item';
			productItem.dataset.price = product.price;
			productItem.dataset.name = product.name;
			productItem.innerHTML = `
				<div class="card h-100">
					<a href="product-details.php?id=${product.id}">
						<img src="${product.image}" class="card-img-top hover-effect" alt="Product Image" style="height: auto; width: 100%; margin-top: 5px; object-fit: cover;">
					</a>
					<div class="card-body">
						<p class="card-title">${product.name}</p>
						<div class="d-flex justify-content-between align-items-center">
							<h5 class="card-text fw-bold mb-0" style="color:#04048C;">#${product.price.toLocaleString()}</h5>
							<a href="#" class="btn btn-sm btn-primary"><i class="fas fa-cart-plus"></i></a>
						</div>
					</div>
				</div>
			`;
			productList.appendChild(productItem);
		});

		document.getElementById('startItem').textContent = start + 1;
		document.getElementById('endItem').textContent = Math.min(end, jsProducts.length);
	}

	function updatePagination() {
		const pagination = document.getElementById('pagination');
		const totalPages = Math.ceil(jsProducts.length / itemsPerPage);

		pagination.innerHTML = `
			<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
				<a class="page-link" href="#" tabindex="-1" aria-disabled="${currentPage === 1}">Previous</a>
			</li>
		`;

		for (let i = 1; i <= totalPages; i++) {
			pagination.innerHTML += `
				<li class="page-item ${currentPage === i ? 'active' : ''}">
					<a class="page-link" href="#">${i}</a>
				</li>
			`;
		}

		pagination.innerHTML += `
			<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
				<a class="page-link" href="#">Next</a>
			</li>
		`;
	}

	document.getElementById('itemsPerPage').addEventListener('change', function() {
		itemsPerPage = parseInt(this.value);
		currentPage = 1;
		renderProducts();
		updatePagination();
	});

	document.getElementById('sortOptions').addEventListener('change', function() {
		const sortOption = this.value;
		if (sortOption === 'priceAsc') {
			jsProducts.sort((a, b) => a.price - b.price);
		} else if (sortOption === 'priceDesc') {
			jsProducts.sort((a, b) => b.price - a.price);
		} else if (sortOption === 'nameAsc') {
			jsProducts.sort((a, b) => a.name.localeCompare(b.name));
		} else if (sortOption === 'nameDesc') {
			jsProducts.sort((a, b) => b.name.localeCompare(a.name));
		}
		renderProducts();
	});

	document.getElementById('pagination').addEventListener('click', function(event) {
		if (event.target.tagName === 'A') {
			event.preventDefault();
			const pageText = event.target.textContent;
			if (pageText === 'Previous' && currentPage > 1) {
				currentPage--;
			} else if (pageText === 'Next' && currentPage < Math.ceil(products.length / itemsPerPage)) {
				currentPage++;
			} else if (!isNaN(parseInt(pageText))) {
				currentPage = parseInt(pageText);
			}
			renderProducts();
			updatePagination();
		}
	});

	renderProducts();
	updatePagination();
	</script>
		<!-- Start Footer Section -->
		<?php include 'components/footer.php'; ?>
		<!-- End Footer Section -->


		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
	</body>

</html>
