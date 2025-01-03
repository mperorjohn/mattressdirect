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
<div class="hero">
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
</div>
<!-- End Hero Section -->

<!-- Start Contact Form -->
<div class="untree_co-section">
  <div class="container">
    <div class="block">
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-8 pb-4">
          <div class="row mb-5">
            <div class="col-lg-4">
              <div class="service no-shadow align-items-center link horizontal d-flex active" data-aos="fade-left" data-aos-delay="0">
                <div class="service-icon color-1 mb-4">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                  </svg>
                </div> <!-- /.icon -->
                <div class="service-contents">
                  <p class="text-primary"><?php echo $_ENV['APP_ADDRESS'] ;?></p>
                </div> <!-- /.service-contents-->
              </div> <!-- /.service -->
            </div>

            <div class="col-lg-4">
              <div class="service no-shadow align-items-center link horizontal d-flex active" data-aos="fade-left" data-aos-delay="0">
                <div class="service-icon color-1 mb-4">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                  </svg>
                </div> <!-- /.icon -->
                <div class="service-contents">
                  <p>info@yourdomain.com</p>
                </div> <!-- /.service-contents-->
              </div> <!-- /.service -->
            </div>

            <div class="col-lg-4">
              <div class="service no-shadow align-items-center link horizontal d-flex active" data-aos="fade-left" data-aos-delay="0">
                <div class="service-icon color-1 mb-4">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                  </svg>
                </div> <!-- /.icon -->
                <div class="service-contents">
                  <p class="text-primary"><?php echo $_ENV['APP_CONTACT'] ;?></p>
                </div> <!-- /.service-contents-->
              </div> <!-- /.service -->
            </div>
          </div>

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
                  <input type="text" class="form-control" id="lname" name="last_name" value="<?php echo $check_login ? $_SESSION['user']->last_name : "";?>" required required>
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
