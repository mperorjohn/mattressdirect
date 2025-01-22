<?php

// API integration 

$url = $_ENV['API_ROOT_DIR'] . 'product/getNewProduct.php';

$search = isset($_GET['search']) ? $_GET['search'] : null;

if($search){
    $url = $_ENV['API_ROOT_DIR'] . 'product/getProductBySearch.php?search='.$search;
}

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POST, false);

$result = curl_exec($ch);
if ($result === false) {
    echo json_encode(['status' => false, 'message' => 'Failed to connect to API']);
    exit();
}

$response = json_decode($result);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['status' => false, 'message' => 'Failed to decode JSON response']);
    exit();
}

// if (!$response->status) {
//          json_encode(['status' => false, 'message' => 'API returned an error: ' . $response->message]);
//     // exit();
// }

$products = isset($response->data) ? $response->data : [];

// set url back to get new products

curl_close($ch);

?>

<!-- Include ScrollReveal.js -->
<script src="https://unpkg.com/scrollreveal"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        ScrollReveal().reveal('.card', {
            duration: 1000,
            origin: 'bottom',
            distance: '50px',
            easing: 'ease-in-out',
            reset: true
        });
    });
</script>

<?php if ($response->status && !empty($products)): ?>
    <?php foreach($products as $product): ?>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card h-100">
            <a href="product-details.php?id=<?php echo $product->id; ?>">
                <img src="<?php echo $product->product_image; ?>" class="card-img-top hover-effect" alt="Product Image" style="height: auto; width: 100%; margin-top: 5px; object-fit: cover;">
            </a>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="card-title"><?php echo ucwords($product->product_name); ?></p>    
                    <p class="card-title" style="color:<?php echo isset($product->is_available) && $product->is_available ? 'green;' : 'red;'; ?>">
                        <?php echo isset($product->is_available) && $product->is_available ? 'In Stock' : 'Out of Stock'; ?>
                    </p>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-text fw-bold mb-0" style="color:#04048C;">
                        #<?php echo number_format(isset($product->product_price) && is_numeric($product->product_price) ? $product->product_price : 0, 2); ?>
                    </h5>
                    <a href="product-details.php?id=<?php echo $product->id ;?>" class="btn btn-sm rounded btn-primary"><i class="fas fa-cart-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
<?php else: ?>
    <p class="fs-3 text-danger">No products matches your search</p>
<?php endif; ?>

<style>
    .hover-effect {
        transition: transform 0.3s ease;
    }
    .hover-effect:hover {
        transform: scale(1.05);
    }
</style>