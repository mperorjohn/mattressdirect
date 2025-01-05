<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$id = $_GET['id'];

// die($id);
// :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: get product by id ::
// API integration
$url = $_ENV['API_ROOT_DIR'] . 'product/getProductById.php?id=';
$size_url = $_ENV['API_ROOT_DIR'] . 'size/getSizebyProduct.php?product_id=';



if (isset($_GET['id'])) {
	$url .= $_GET['id'];
	$size_url .= $_GET['id'];
} else {
	header('Location: index.php');
	exit();
}
// die($url);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);


if ($result === false) {
	echo json_encode(['status' => false, 'message' => 'Failed to connect to API']);
	exit();
}

$response = json_decode($result);

if ($response === null || !isset($response->status)) {
	echo json_encode(['status' => false, 'message' => 'Invalid API response']);
	exit();
}

if ($response->status == false) {
	echo json_encode(['status' => false, 'message' => $response->message]);

	// then redirect to the home page
	header('Location: index.php');
	exit();
}

$product = $response->data;
// :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: end get product by id ::

// var_dump($product);


// ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: generate code ::
function generateCode(){
	$length = 6;
	$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

 $new_code = generateCode();



//  ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: end generate code ::


// ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: Size Integration ::
// size API integration


// die($size_url);


$ch = curl_init($size_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);

if ($result === false) {
	echo json_encode(['status' => false, 'message' => 'Failed to connect to API']);
	exit();
}

$response = json_decode($result);

if ($response === null || !isset($response->status)) {
	echo json_encode(['status' => false, 'message' => 'Invalid API response']);
	exit();
}

if ($response->status == false) {
	echo json_encode(['status' => false, 'message' => $response->message]);
	exit();
}

$size = $response->data;

// var_dump($size);

// ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: end Size Integration ::


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
                            <img src="<?php echo is_array($product->product_image) ? $product->product_image[0] : $product->product_image; ?>" class="card-img-top hover-effect zoom" alt="Product Image" style="height: 100%; width: 100%; margin-top: 5px; object-fit: cover;">
                        </div>
                    </div>
                    
                    <div class="related-images mt-3">
                        <div class="row justify-content-center">
                            <?php 
                            if (is_array($product->product_image)) {
                                $related_images = array_slice($product->product_image, 1, 4);
                                foreach ($related_images as $image) {
                                    echo '<div class="col-6 col-md-3 mb-3">
                                            <img src="' . $image . '" class="img-fluid" alt="Related Image" style="height: 200px; width: 100%; object-fit: cover;">
                                          </div>';
                                }
                            } else {
                                echo '<div class="col-6 col-md-3 mb-3">
                                        <img src="' . $product->product_image . '" class="img-fluid" alt="Related Image" style="height: 200px; width: 100%; object-fit: cover;">
                                      </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-details card p-5">
                    <p class="fs-5"><?php echo ucwords($product->product_name); ?></p>
                    <h2 class=" text-primary fw-bold price" >#<?php echo is_numeric($product->product_price) ? number_format($product->product_price, 0, '.', ',') : '00'; ?>.00</h2>
                    <span>Brand: <span style="font-weight: bold;color:grey;"><?php echo ucfirst($product->product_brand_name);?></span></span>
                    <span>Category: <span style="font-weight: bold;color:grey;"><?php echo ucwords($product->product_category);?></span></span>
                    <span >Product Code: <span style="color:grey;"><?php echo $product->id . $new_code; ?></span> </span>
                    <span >Availability: <span style="color:<?php echo isset($product->is_available ) && $product->is_available ? 'green' : 'red';?>"><?php echo isset($product->is_available ) && $product->is_available ? 'In Stock' : 'Out of Stock';?></span> </span>

                    <div class="mt-3">
                        <hr>
                        <span class="mt-5 mb-5"></span>
                        <p><?php echo $product->product_description; ?></p>
                        <hr class="mt-5">
                    </div>

                    <div>
                        <p class="fs-3">Available Options</p>
                        <form id="add-to-cart-form" action="" method="post">
                            <div class="form-group">
                                <label for="size">Mattress Sizes <span class="text-danger fw-bold">*</span></label>
								<?php if (!empty($size)): ?>
									<select class="form-select" id="size">
										<option class="form-control" disabled>Select Size</option>
										<?php foreach ($size as $s): ?>
											<option class="form-control" value="<?php echo $s->id; ?>" data-price="<?php echo $s->price; ?>">
												<?php echo $s->size . ' (' . number_format($s->price, 2) . ')'; ?>
											</option>
										<?php endforeach; ?>
									</select>
								<?php else: ?>
									<p>No size available</p>
								<?php endif; ?>
                            </div>
                            
                            <div class="form-group d-flex align-items-center mt-3 flex-wrap">
                                <label for="quantity" class="me-2">Qty</label>
                                <div class="input-group" style="width: 120px;">
                                    <button type="button" class="btn-outline-secondary fw-bold" id="decrement-btn">-</button>
                                    <input type="number" class="form-control text-center" id="quantity" value="1" min="1">
                                    <button style="border:none; ouline:none;" type="button" class="btn-outline-secondary fw-bold" id="increment-btn">+</button>
                                </div>
                                <input type="hidden" name="totalPrice" id="totalPrice" value="<?php echo $product->product_price; ?>">
                                <input type="hidden" name="product_code" value="<?php echo $product->id . $new_code; ?>">
                                <button type="button" id="add-to-cart-btn" class="fw-bold btn btn-primary ms-3 mt-2 mt-md-0" style="border-radius:5px !important;">+ Cart</button>
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
                            <!-- Toast Container -->
                            <div class="toast-container position-absolute bottom-0 start-50 translate-middle-x p-3">
                                <div id="cart-toast" class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="d-flex">
                                        <div class="toast-body bg-success text-white">
                                            You have successfully added the product to your cart.
                                        </div>
                                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
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
    const sizeSelect = document.getElementById('size');
    const addToCartBtn = document.getElementById('add-to-cart-btn');
    const cartToast = new bootstrap.Toast(document.getElementById('cart-toast'));
    const basePrice = <?php echo $product->product_price; ?>;
    const incrementBtn = document.getElementById('increment-btn');
    const decrementBtn = document.getElementById('decrement-btn');

    // Reset quantity to 1 on page reload
    quantityInput.value = 1;
    priceElement.textContent = `#${basePrice.toLocaleString()}.00`;
    totalPriceInput.value = basePrice;

    quantityInput.addEventListener('input', function() {
        updateTotalPrice();
    });

    sizeSelect.addEventListener('change', function() {
        updateTotalPrice();
    });

    incrementBtn.addEventListener('click', function() {
        quantityInput.value = parseInt(quantityInput.value) + 1;
        updateTotalPrice();
    });

    decrementBtn.addEventListener('click', function() {
        if (quantityInput.value > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
            updateTotalPrice();
        }
    });

    addToCartBtn.addEventListener('click', function() {
        const selectedSize = sizeSelect.options[sizeSelect.selectedIndex];
        const sizeId = selectedSize ? selectedSize.value : null;
        const sizePrice = selectedSize ? parseFloat(selectedSize.getAttribute('data-price')) : basePrice;
        const quantity = parseInt(quantityInput.value);
        const totalPrice = sizePrice * quantity;
        const productImage = <?php echo json_encode(is_array($product->product_image) ? $product->product_image[0] : $product->product_image); ?>;
        const productSize = selectedSize ? selectedSize.textContent : 'N/A';

        const cartItem = {
            productId: '<?php echo $product->id; ?>',
            productName: '<?php echo addslashes($product->product_name); ?>',
            sizeId: sizeId,
            sizePrice: sizePrice,
            quantity: quantity,
            totalPrice: totalPrice,
            productImage: productImage,
            productDescription: '<?php echo addslashes($product->product_description); ?>',
            productSize: productSize
        };

        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        cart.push(cartItem);
        localStorage.setItem('cart', JSON.stringify(cart));

        cartToast.show();
    });

    function updateTotalPrice() {
        const quantity = parseInt(quantityInput.value);
        const selectedSize = sizeSelect.options[sizeSelect.selectedIndex];
        const sizePrice = selectedSize ? parseFloat(selectedSize.getAttribute('data-price')) : basePrice;

        if (!isNaN(quantity) && quantity > 0) {
            const totalPrice = sizePrice * quantity;
            priceElement.textContent = `#${totalPrice.toLocaleString()}.00`;
            totalPriceInput.value = totalPrice;
        } else {
            // Reset to base price if invalid input
            quantityInput.value = 1;
            priceElement.textContent = `#${basePrice.toLocaleString()}.00`;
            totalPriceInput.value = basePrice;
        }
    }
});
</script>
</div>
        


        <!-- Start Footer Section -->
         <div class="mt-5">

             <?php include 'components/footer.php'; ?>
         </div>
        <!-- End Footer Section -->

        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/tiny-slider.js"></script>
        <script src="js/custom.js"></script>
    </body>

</html>