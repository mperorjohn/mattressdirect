<?php





?>






<?php
for ($i = 0; $i < 12; $i++) {

    $id = $i + 1;
    ?>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card h-100">
            <a href="product-details.php?id=<?php echo $id; ?>">
                <img src="https://mattress.ng/image/cache/catalog/cream1-300x300.jpg" class="card-img-top hover-effect" alt="Product Image" style="height: auto; width: 100%; margin-top: 5px; object-fit: cover;">
            </a>
            <div class="card-body">
                <p class="card-title">Product 2</p>
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-text fw-bold mb-0" style="color:#4169E1;">#512,000.00</h5>
                    <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-cart-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <style>
        .hover-effect {
            transition: transform 0.3s ease;
        }
        .hover-effect:hover {
            transform: scale(1.05);
        }
    </style>
    <?php
}
?>

