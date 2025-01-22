<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


require __DIR__ . '../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '../../');
$dotenv->load();

$check_login = isset($_SESSION['user']) && !empty($_SESSION['user']);

$check_permission = isset($_SESSION['permission']) && !empty($_SESSION['permission']) && $_SESSION['permission'] == 1 ;

$update_product = isset($_GET['rw']) && $_GET['rw'] == 'true';

$url = $_ENV['API_ROOT_DIR'] . 'product/createProduct.php';

if($update_product){
    $url = $_ENV['API_ROOT_DIR'] . 'product/updateProduct.php';
}
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
    <title><?php echo isset($_ENV['APP_NAME']) ? $_ENV['APP_NAME'] : 'Default App Name'; ?> | Contact</title>
</head>

<body>

<!-- Navbar section -->
<?php include 'components/navbar.php'; ?>
<!-- End Navbar section -->

<!-- Start Contact Form -->
<div class="untree_co-section">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="card">
                    <div class="card-header">
                    <h5><?php echo $_ENV['APP_NAME'];?></h5>
                    </div>
                    <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                        <li class="list-group-item"><a href="products.php"><i class="fas fa-box"></i> Product</a></li>
                        <li class="list-group-item"><a href="contact.php"><i class="fas fa-envelope"></i> Messages</a></li>
                        <li class="list-group-item"><a href="ebook.php"><i class="fas fa-book"></i> Ebook</a></li>
                        <!-- log out -->
                        <?php if ($check_login) : ?>
                        <li class="list-group-item"><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        <?php endif; ?>
                    </ul>
                    </div>
                </div>

            </div>
            <div class="col-md-10">
            <div class="block">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center text-primary">Create Product</h2>
                    <p class="text-center"><span class="text-danger">Note:</span> After creating a product kindly go to product and create size and price, default price will appear on client's page</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-8 pb-4">
                    <form id="productForm" action="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-black" for="fname">Product name</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name"  required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-black" for="email">Product Category</label>
                                    <select name="product_category" id="" class="form-control">
                                        <option value="mattress">Mattress</option>
                                        <option value="pillow">Pillow</option>
                                    </select>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-black" for="lname">Brand name</label>
                                    <select name="product_brand_name" id="" class="form-control">
                                        <option value="mouka">Mouka</option>
                                        <option value="mouka">Mouka</option>
                                        <option value="mouka">Mouka</option>
                                    </select>
                                   
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-black" for="email">Available</label>
                                    <select name="product_available" id="" class="form-control">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-black" for="product_image_one">Product image 1<span class="fw-bold text-danger me-3">*</span></label>
                                    <input type="file" name="product_image_one" id="product_image_one" class="form-control" accept=".jpg,.jpeg,.png" required>
                                    <p class="text-muted">Accepted file types: jpg, jpeg, png</p>
                                 </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-black" for="product_image_two">Product image 2</label>
                                        <input type="file" name="product_image_2" id="product_image_2" accept=".jpg,.jpeg,.png" class="form-control">
                                        <p class="text-muted">Accepted file types: jpg, jpeg, png</p>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-black" for="product_image_three">Product image 3</label>
                                    <input type="file" name="product_image_3" id="product_image_3" accept=".jpg,.jpeg,.png" class="form-control">
                                    <p class="text-muted">Accepted file types: jpg, jpeg, png</p>

                                 </div>
                            </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-black" for="product_image_four">Product image 4</label>
                                            <input type="file" name="product_image_4" id="product_image_4" accept=".jpg,.jpeg,.png" class="form-control">
                                            <p class="text-muted">Accepted file types: jpg, jpeg, png</p>

                                        </div>
                                </div>
                        </div>
                            <div class="form-group mb-5">
                                <label class="text-black" for="description">Product Description</label>
                                <textarea name="description" class="form-control" id="description" cols="30" rows="5" required></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary form-control">Create Product</button>
                        </div>
                        
                        
                        
                        
                    </form>

                </div>

            </div>

        </div>
                
            </div>
        </div>
       

    </div>
</div>

<!-- End Contact Form -->

<!-- Start Footer Section -->
<?php include 'components/footer.php'; ?>
<!-- End Footer Section -->

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/tiny-slider.js"></script>
<script src="js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const form = document.querySelector('#productForm');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        try {
            const response = await fetch('<?php echo $url; ?>', {
                method: 'POST',
                body: formData,
            });

            const result = await response.json();

            if (response.ok && result.status) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Product created successfully',
                    confirmButtonColor: '#ffffff',
                    confirmButtonText: '<span style="color: #04048C;">OK</span>',
                    cancelButtonColor: '#d33',
                    background: '#04048C',
                    color: '#DCDC00'
                }).then(() => {
                    form.reset();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: result.message || 'Something went wrong. Please try again later.',
                    confirmButtonColor: '#04048C',
                    confirmButtonText: '<span style="color: #ffffff;">OK</span>',
                    cancelButtonColor: '#d33',
                    background: '#ffffff',
                    color: '#04048C'
                });
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message,
                confirmButtonColor: '#04048C',
                confirmButtonText: '<span style="color: #ffffff;">OK</span>',
                cancelButtonColor: '#d33',
                background: '#ffffff',
                color: '#04048C'
            });
        }
    });
</script>

</body>
</html>