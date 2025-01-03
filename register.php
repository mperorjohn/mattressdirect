<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


// redirect if if check login is true
$check_login = isset($_SESSION['user']) && !empty($_SESSION['user']);

if ($check_login) {
    header("Location: index.php");
    exit();
}


// get API directory from env 
$api_dir = $_ENV['API_ROOT_DIR'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $companyName = filter_input(INPUT_POST, 'company_name', FILTER_SANITIZE_STRING);
    $companyPhone = filter_input(INPUT_POST, 'company_phone', FILTER_SANITIZE_STRING);
    $passOne = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $passTwo = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);
    $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
    $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    $postalCode = filter_input(INPUT_POST, 'postal_code', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);

    // Check if passwords match
    if ($passOne !== $passTwo) {
        echo json_encode(['status' => 'error', 'message' => 'Passwords do not match']);
        exit;
    } elseif (strlen($passOne) < 8) {
        // Check if password length is at least 8 characters
        echo json_encode(['status' => 'error', 'message' => 'Password must be at least 8 characters long']);
        exit;
    } else {
        $data = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'phone' => $phone,
            'company_name' => $companyName,
            'company_phone' => $companyPhone,
            'password' => $passOne,
            'country' => $country,
            'state' => $state,
            'city' => $city,
            'postal_code' => $postalCode,
            'address' => $address
        ];

        $url = $api_dir . 'user/register.php';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($ch);
        curl_close($ch);

        echo $response;
        exit;
    }
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
        <title><?php echo isset($_ENV['APP_NAME']) ? $_ENV['APP_NAME'] : 'Default App Name'; ?> | Register</title>
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
                                <h1>Register</h1>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            
                        </div>
                    </div>
                </div>
            </div>
        <!-- End Hero Section -->


        <div class="container mb-5 mt-5">
            <form id="registerForm" method="post">
            <p class="fs-4 text-primary mb-3 mt-3 fw-bold">Personal Information</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstName">First Name <span class="fw-bold text-danger">*</span> </label>
                            <input type="text" name="first_name" class="form-control" id="firstName" placeholder="First Name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mt-3 mt-md-0">
                            <label for="lastName">Last Name <span class="fw-bold text-danger">*</span> </label>
                            <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Last Name" required>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email <span class="fw-bold text-danger">*</span> </label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Example@gmail.com" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mt-3 mt-md-0">
                            <label for="phone">Phone <span class="fw-bold text-danger">*</span> </label>
                            <input type="tel" name="phone" class="form-control" id="phone" placeholder="+234 000 000 000" required>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="companyName">Company Name</label>
                            <input type="text" name="company_name" class="form-control" id="companyName" placeholder="Company Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mt-3 mt-md-0">
                            <label for="companyPhone">Company Phone </label>
                            <input type="tel" name="company_phone" class="form-control" id="companyPhone">
                        </div>
                    </div>
                </div>
                <!--  -->
                <!--  -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="passOne">Password</label>
                            <input type="password" name="password" class="form-control" id="passOne" required>
                            <small id="passwordHelp" class="form-text text-danger" style="display: none;">Passwords do not match</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mt-3 mt-md-0">
                            <label for="passTwo">Confirm Password </label>
                            <input type="password" name="confirm_password" class="form-control" id="passTwo" required>
                            <small id="passwordHelp2" class="form-text text-danger" style="display: none;">Passwords do not match</small>
                        </div>
                    </div>
                </div>
                <!--  -->
                <p class="fs-4 text-primary mb-3 mt-3 fw-bold">Shipping Address</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">Country <span class="text-danger fw-bold">*</span></label>
                            <select name="country" id="country" class="form-control" required>
                                <option selected value="">Select country</option>
                                <option value="Nigeria">Nigeria</option>                                
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="state">State <span class="text-danger fw-bold">*</span></label>
                            <select name="state" id="state" class="form-control" required>
                                <option selected value="">Select State</option>
                                <option value="lagos">Lagos</option>
                                <option value="ogun">Ogun</option>
                                
                            </select>
                        </div>
                    </div>
                    
                </div>
                <!--  -->
                <div class="row">
                     <div class="col-md-6">
                        <div class="form-group mt-3 mt-md-0">
                            <label for="city">City <span class="text-danger fw-bold">*</span></label>
                            <input type="text" name="city" class="form-control" id="city" placeholder="City" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mt-3 mt-md-0">
                            <label for="postalCode">Postal Code </label>
                            <input type="number" name="postal_code" class="form-control" id="postalCode" placeholder="Postal Code">
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="">
                    <div class="form-group">
                        <label for="address">Address <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="address" class="form-control" id="address" placeholder="Address" required>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary form-control mt-3 mb-3">Register</button> 
                </div>

                <div>
                    <p>Already have an account ? <a href="login.php">Login</a></p>
                </div>
                
            </div>
            </form>
        </div>
       
            
    

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.getElementById('registerForm').addEventListener('submit', function(event) {
            event.preventDefault();


            // password validation
            var passOne = document.getElementById('passOne').value;
            var passTwo = document.getElementById('passTwo').value;
            if (passOne !== passTwo) {
                document.getElementById('passwordHelp').style.display = 'block';
                document.getElementById('passwordHelp2').style.display = 'block';
                return;
            }


            var formData = new FormData(this);
            var jsonData = {};
            formData.forEach((value, key) => jsonData[key] = value);

            fetch('<?php echo $api_dir; ?>user/register.php', {
                method: 'POST',
                headers: {
                'Content-Type': 'application/json'
                },
                body: JSON.stringify(jsonData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === true) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Registration successful',
                    confirmButtonColor: '#ffffff',
                    confirmButtonText: '<span style="color: #04048C;">OK</span>',
                    cancelButtonColor: '#d33',
                    background: '#04048C',
                    color: '#DCDC00'
                }).then(() => {
                    window.location = 'login.php';
                });
                } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message,
                    confirmButtonColor: '#04048C',
                    confirmButtonText: '<span style="color: #ffffff;">OK</span>',
                    cancelButtonColor: '#d33',
                    background: '#ffffff',
                    color: '#04048C'
                });
                }
            })
            .catch(error => {
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'An error occurred',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                background: '#f8d7da',
                color: '#721c24'
                });
            });
            });
        </script>

        <!-- Start Footer Section -->
        <?php include 'components/footer.php'; ?>
        <!-- End Footer Section -->

        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/tiny-slider.js"></script>
        <script src="js/custom.js"></script>
    </body>

</html>