<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$check_login = isset($_SESSION['user']) && !empty($_SESSION['user']);

$url = $_ENV['API_ROOT_DIR'] . 'contact/contactUs.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = filter_var(trim($_POST['first_name'] ?? ''), FILTER_SANITIZE_STRING);
    $lastName = filter_var(trim($_POST['last_name'] ?? ''), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $message = filter_var(trim($_POST['message'] ?? ''), FILTER_SANITIZE_STRING);

    if (empty($firstName) || empty($lastName) || empty($email) || empty($message)) {
        echo json_encode(['status' => false, 'message' => 'All fields are required.']);
        exit;
    }

    $data = [
        'first_name' => $firstName,
        'last_name' => $lastName,
        'email' => $email,
        'message' => $message,
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $response = curl_exec($ch);
    if ($response === false) {
        echo json_encode(['status' => false, 'message' => curl_error($ch)]);
    } else {
        $decodedResponse = json_decode($response, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            if (isset($decodedResponse['status']) && is_bool($decodedResponse['status'])) {
                echo json_encode([
                    'status' => $decodedResponse['status'],
                    'message' => $decodedResponse['message'] ?? 'Unexpected response',
                ]);
            } else {
                echo json_encode(['status' => false, 'message' => 'Invalid response format or status is not boolean.']);
            }
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to decode JSON response.']);
        }
    }
    curl_close($ch);
    exit;
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

<!-- Start Hero Section -->
<!-- <div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Contact</h1>
                    <p class="mb-4">Feel free to reach out to us with any questions or concerns. Our team is here to help you find the perfect mattress for your needs.</p>
                    <p><a href="" class="btn btn-secondary me-2">Shop Now</a></p>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="hero-img-wrap">
                    <img src="images/Pillow.png" class="img-fluid w-100">
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- End Hero Section -->

<!-- Start Contact Form -->
<div class="untree_co-section">
    <div class="container">
        <div class="block">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center text-primary">Contact Us</h2>
                    <p class="text-center">Feel free to reach out to us with any questions or concerns. Our team is here to help you find the perfect mattress for your needs.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-8 pb-4">
                    <form id="contactForm" action="" method="POST">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-black" for="fname">First name</label>
                                    <input type="text" class="form-control" id="fname" name="first_name" value="<?php echo $check_login ? $_SESSION['user']->first_name : "";?>" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-black" for="lname">Last name</label>
                                    <input type="text" class="form-control" id="lname" name="last_name" value="<?php echo $check_login ? $_SESSION['user']->last_name : "";?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="text-black" for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $check_login ? $_SESSION['user']->email : ""; ?> " required>
                        </div>

                        <div class="form-group mb-5">
                            <label class="text-black" for="message">Message</label>
                            <textarea name="message" class="form-control" id="message" cols="30" rows="5" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary form-control">Send Message</button>
                    </form>

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
    const form = document.querySelector('#contactForm');
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
                    text: 'Message sent successfully',
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