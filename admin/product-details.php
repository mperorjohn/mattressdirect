<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '../../');
$dotenv->load();

$check_login = isset($_SESSION['user']) && !empty($_SESSION['user']);
if (!$check_login) {
    header('Location: ../login.php');
    exit();
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit();
}

// API Endpoints
$url = $_ENV['API_ROOT_DIR'] . 'product/getProductById.php?id=' . urlencode($id);
$size_url = $_ENV['API_ROOT_DIR'] . 'size/getSizebyProduct.php?product_id=' . urlencode($id);
$additional_images_url = $_ENV['API_ROOT_DIR'] . 'product/getProductImages.php?id=' . urlencode($id);
$create_size_url = $_ENV['API_ROOT_DIR'] . 'size/createSize.php';

// Fetch product
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$responseData = curl_exec($ch);
curl_close($ch);

if ($responseData === false) {
    exit('Failed to connect to product API');
}

$response = json_decode($responseData);
if (!$response || !$response->status) {
    header('Location: index.php');
    exit();
}

$product = $response->data;

// Fetch sizes
$ch = curl_init($size_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$sizeResponseData = curl_exec($ch);
curl_close($ch);

if ($sizeResponseData === false) {
    exit('Failed to connect to size API');
}

$sizeResponse = json_decode($sizeResponseData);
if (!$sizeResponse || !$sizeResponse->status) {
    $sizes = [];
} else {
    $sizes = $sizeResponse->data;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $size = $_POST['size'];
    $price = $_POST['price'];
    $is_default = $_POST['is_default'];
    $is_available = $_POST['is_available'];
    $product_id = $_POST['product_id'];

    $data = [
        'size' => $size,
        'price' => $price,
        'is_default' => $is_default,
        'is_available' => $is_available,
        'product_id' => $product_id
    ];

    $ch = curl_init($create_size_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $result = curl_exec($ch);
    curl_close($ch);

    if ($result === false) {
        $message = 'Failed to connect to API';
    } else {
        $response = json_decode($result, true);
        if (!$response || !$response['status']) {
            $message = $response['message'] ?? 'Unknown error';
            $message = 'API returned an error: ' . $message;
        } else {
            $message = 'Size created successfully';
        }
    }
}

// Fetch additional images
$ch = curl_init($additional_images_url);
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

$additional_images = isset($response->data) ? $response->data : [];

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Admin">
  <link rel="shortcut icon" href="favicon.png">
  <meta name="description" content="" />
  <meta name="keywords" content="<?php echo $_ENV['APP_DESCRIPTION'] ?? ''; ?>" />

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="css/tiny-slider.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <title><?php echo $_ENV['APP_NAME'] ?? 'Default App Name'; ?> | Product Details (Admin)</title>

  <style>
    .zoom-container {
        overflow: hidden;
        position: relative;
        height: 610px; /* Set a fixed height for the image container */
    }
    .zoom {
      transition: transform .2s;
      transform-origin: center center;
    }
    .zoom-container:hover .zoom {
      transform: scale(1.5);
    }
    .product-details {
      margin-top: 15px;
    }
    .tooltiptext {
        visibility: hidden;
        width: 200px;
        background-color: black;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        bottom: 125%; /* Position the tooltip above the text */
        left: 50%;
        margin-left: -100px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    li:hover .tooltiptext {
        visibility: visible;
        opacity: 1;
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
            <div class="product-image card">
                <div class="zoom-container">
                    <img 
                        src="<?php echo is_array($product->product_image) ? $product->product_image[0] : $product->product_image; ?>" 
                        class="card-img-top hover-effect zoom" 
                        alt="Product Image" 
                        style="height: 100%; width: 100%; object-fit: cover;"
                    >
                </div>
            </div>
            <div class="related-images mt-3">
                <div class="row justify-content-center">
                    <?php 
                    if (!empty($additional_images)) {
                        foreach ($additional_images as $image) {
                            echo '<div class="col-6 col-md-3 mb-3">
                                    <img src="' . $image->image_path . '" class="img-fluid" alt="Related Image" style="height: 200px; width: 100%; object-fit: cover; cursor: pointer;">
                                    </div>';
                        }
                    } else {
                        echo '<div class="col-6 col-md-3 mb-3">
                                <img src="' . (is_array($product->product_image) ? $product->product_image[0] : $product->product_image) . '" class="img-fluid" alt="Related Image" style="height: 200px; width: 100%; object-fit: cover; cursor: pointer;">
                                </div>';
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="product-details card p-5">
                <p class="fs-5"><?php echo ucwords($product->product_name); ?></p>
                <h2 class="text-primary fw-bold">
                    #<?php echo is_numeric($product->product_price) ? number_format($product->product_price, 0, '.', ',') : '00'; ?>.00
                </h2>
                <p>Brand: <strong><?php echo ucfirst($product->product_brand_name); ?></strong></p>
                <p>Category: <strong><?php echo ucwords($product->product_category); ?></strong></p>
                <p>Availability: 
                    <strong style="color:<?php echo ($product->is_available ?? false) ? 'green' : 'red'; ?>">
                        <?php echo ($product->is_available ?? false) ? 'In Stock' : 'Out of Stock'; ?>
                    </strong>
                </p>
                <hr>
                <p><?php echo $product->product_description; ?></p>
                <hr class="mt-4">
                <h4>Sizes Available</h4>
                <?php if (!empty($sizes)): ?>
                    <ul>
                        <?php foreach ($sizes as $s): ?>
                            <li>
                                <?php echo $s->size . ' (#' . number_format($s->price, 2) . ')'; ?>
                                <?php if ($s->is_default): ?>
                                    <strong>(Default)</strong>
                                    <span class="tooltiptext">Default price is the one showing on the user's end</span>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No sizes available.</p>
                <?php endif; ?>
                <div class="form">
                    <!-- add size -->
                    <div class="form-group mt-3">
                        <label for="size">Add Size</label>
                        <?php if ($message): ?>
                            <div class="alert alert-info"><?php echo $message; ?></div>
                        <?php endif; ?>
                        <form id="addSizeForm" action="" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                            <input type="text" name="size" class="form-control" placeholder="Enter size">
                            <input type="number" name="price" class="form-control mt-2" placeholder="Enter price">
                            <!-- select yes or no for is_default -->
                             <label for="toDefault">Set Default</label>
                            <select name="is_default" class="form-select mt-2">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                           <label for="is_available">Available</label>
                            <select name="is_available" class="form-select mt-2">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-2">Add Size</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                </div>

<!-- Start Footer Section -->
<div class="mt-5">
    <?php include 'components/footer.php'; ?>
</div>
<!-- End Footer Section -->

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/tiny-slider.js"></script>
<script src="js/custom.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mainImage = document.querySelector('.product-image .card-img-top');
        const additionalImages = document.querySelectorAll('.related-images img');

        additionalImages.forEach(image => {
            image.addEventListener('click', function() {
                mainImage.src = this.src;
            });
        });
    });
</script>
</body>
</html>