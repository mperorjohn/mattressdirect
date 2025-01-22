<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$check_login = isset($_SESSION['user']) && !empty($_SESSION['user']);

$url = $_ENV['API_ROOT_DIR'] . 'contact/contactUs.php';

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
    <title><?php echo isset($_ENV['APP_NAME']) ? $_ENV['APP_NAME'] : 'Default App Name'; ?> | Guide</title>
</head>

<body>

<!-- Navbar section -->
<?php include 'components/navbar.php'; ?>
<!-- End Navbar section -->

<!-- Guide note section -->

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="guide-note mt-5 mb-5">
            <p style="text-transform:uppercase; line-height:1.5;" class="text-black text-center fs-1 mt-3">Discover the <span class="text-danger">5 Mistakes to Avoid when buying a mattress</span> for better sleep, health and all - day productivity</p>
            <p class="fs-6">Research Reveals That Low-Quality Mattress Can Increase Your Stress Levels and Affect Productivity in Life… But This Mattress Buying Guide Will Ensure You Buy the Right Mattress Without Any Hassle!</p>
            </div>
        
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="https://images.squarespace-cdn.com/content/v1/5beb00a47e3c3abd688e43b4/1584077530459-ZBIUGNWZM9TTBEEI0BU2/sleep+disorder" class="img-fluid" height="50%" widith="auto" alt="mattress">
        </div>
        <div class="col-md-6 " id="guideForm">
            <p  style="text-transform:uppercase; line-height:1.5;" class="text-primary text-center fs-1">YES! I WANT TO SLEEP BETTER. GIVE ME MY FREE GUIDE</p>
           <form action="" class="mt-3 shadow p-3" id="guideForm">
                <div class="form-group mb-3">
                    <input type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Name">
                    <!-- <small id="nameHelp" class="form-text text-muted">We'll never share your name with anyone else.</small> -->
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary form-control">Download Guide <span class="me-3"><i class="fa-solid fa-download"></i></span></button>
                </div>
           </form>
        </div>
    </div>
    <!--  -->


    <div class="row mt-5 mb-5">
        <div style="background-color:#04048C !important;" class="col-lg-12 card  p-5">
            <div>
                <p  style="color:#DCDC00;" class=" fs-2 text-center text-uppercase">We Have Gotten the Secret Health Wisdom</p>
                <p style="color:#DCDC00;" class="fs-5 fw-bold text-center">Here's What You'll Discover Inside:</p>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <img src="https://media.istockphoto.com/id/1146406764/photo/woman-is-choosing-new-mattress-for-good-sleeping.jpg?s=612x612&w=0&k=20&c=8AtNhMbezszhLlxLK8w2bxjVq90FVXZ5qb6-W5vDV2c=" class="img-fluid" height="100%" widith="auto" alt="mattress">

        </div>
        <div class="col-md-8 mt-5 mb-5">
            <div class="accordion" id="guideAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    🛏️ Selecting The Right Mattress For You
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#guideAccordion">
                <div class="accordion-body">
                    <ul class="list-unstyled">
                    <li><input type="checkbox" checked> How to Avoid the 5 Key Mistakes When Buying a Mattress.</li>
                    <li><input type="checkbox" checked> How to pick it? Choose according to the way you sleep.</li>
                    <li><input type="checkbox" checked> Tips to get the perfect size.</li>
                    </ul>
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    💤 Better Sleep for Better Health
                </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#guideAccordion">
                <div class="accordion-body">
                    <ul class="list-unstyled">
                    <li><input type="checkbox" checked> We'll talk about how the right mattress can make your sleep way better and even improve your health.</li>
                    <li><input type="checkbox" checked> Plus, we've got tips on how to take care of your mattress so it stays comfortable for years.</li>
                    </ul>
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    🛒 Smart Shopping Tips
                </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#guideAccordion">
                <div class="accordion-body">
                    <ul class="list-unstyled">
                    <li><input type="checkbox" checked> How to deal with so-called Warranties and Trial Periods.</li>
                    <li><input type="checkbox" checked> Lifetime understanding of the secret sale tricks of the sellers.</li>
                    </ul>
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    🔍 Choosing the Best Mattress
                </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#guideAccordion">
                <div class="accordion-body">
                    <ul class="list-unstyled">
                    <li><input type="checkbox" checked> Understanding the reality behind leaving cheap mattresses.</li>
                    <li><input type="checkbox" checked> Helping you figure out the best one for you.</li>
                    </ul>
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    📏 Finding the Perfect Fit
                </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#guideAccordion">
                <div class="accordion-body">
                    <ul class="list-unstyled">
                    <li><input type="checkbox" checked> How does your body weight have an impact on buying a mattress.</li>
                    <li><input type="checkbox" checked> Which one is the most comfy and supports you for a long time.</li>
                    </ul>
                </div>
                </div>
            </div>
            </div>
            <div class="mt-3">
                    <button type="button" onclick="window.location='#guideForm'" class="btn btn-primary form-control">Download Guide <span class="me-3"><i class="fa-solid fa-download"></i></span></button>
                </div>
        </div>
    </div>

</div>

<?php include 'components/payment-channel.php'; ?>

<!-- Start Footer Section -->
<?php include 'components/footer.php'; ?>
<!-- End Footer Section -->

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/tiny-slider.js"></script>
<script src="js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>
</html>