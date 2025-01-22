<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// var_dump($_SESSION);

function generateOrderId(){
    $length = 10;
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$orderId = generateOrderId();

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
        <title><?php echo isset($_ENV['APP_NAME']) ? $_ENV['APP_NAME'] : 'Default App Name'; ?> | Checkout</title>
    </head>


    <body>

        <!-- Navbar section -->
    <?php include 'components/navbar.php'; ?>
    <!-- End Navbar section -->

       

        <div class="untree_co-section">
            <div class="container">
              <div class="row mb-5">
                <?php if (!isset($_SESSION['user']) || !$_SESSION['user']): ?>
                    <div class="col-md-12">
                    <div class="border p-4 rounded" role="alert">
                        Returning customer? <a href="login.php">Click here</a> to login
                    </div>
                    </div>
                <?php endif; ?>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                  <h2 class="h3 mb-3 text-primary">Shipping Address</h2>
                  <div class="p-3 p-lg-5 border bg-white">
                    <div class="form-group">
                      <label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
                      <select id="c_country" class="form-control">
                        <option selected value="nigeria">Nigeria</option>    
                      </select>
                    </div>
                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_fname" name="c_fname" value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']->first_name : ''; ?>">
                      </div>
                      <div class="col-md-6">
                        <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_lname" name="c_lname" value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']->last_name : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-12">
                        <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_address" name="c_address" placeholder="Street address" value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']->address : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group mt-3">
                      <input type="text" class="form-control" placeholder="Apartment, suite, unit etc. (optional)">
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="c_state_country" class="text-black">State / Country <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_state_country" name="c_state_country" value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']->state : ''; ?>">
                      </div>
                      <div class="col-md-6">
                        <label for="c_postal_zip" class="text-black">Posta / Zip <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_postal_zip" name="c_postal_zip" value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']->postal_code : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group row mb-5">
                      <div class="col-md-6">
                        <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_email_address" name="c_email_address" value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']->email : ''; ?>">
                      </div>
                      <div class="col-md-6">
                        <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number" value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']->phone : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="c_create_account" class="text-black" data-bs-toggle="collapse" href="#create_an_account" role="button" aria-expanded="false" aria-controls="create_an_account"><input type="checkbox" value="1" id="c_create_account"> Create an account?</label>
                      <div class="collapse" id="create_an_account">
                        <div class="py-2 mb-4">
                          <p class="mb-3">Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                          <div class="form-group">
                            <label for="c_account_password" class="text-black">Account Password</label>
                            <input type="email" class="form-control" id="c_account_password" name="c_account_password" placeholder="">
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="form-group">
                      <label for="c_ship_different_address" class="text-black" data-bs-toggle="collapse" href="#ship_different_address" role="button" aria-expanded="false" aria-controls="ship_different_address"><input type="checkbox" value="1" id="c_ship_different_address"> Ship To A Different Address?</label>
                      <div class="collapse" id="ship_different_address">
                        <div class="py-2">

                          <div class="form-group">
                            <label for="c_diff_country" class="text-black">Country <span class="text-danger">*</span></label>
                            <select id="c_diff_country" class="form-control">
                              <option value="1">Select a country</option>     
                            </select>
                          </div>


                          <div class="form-group row">
                            <div class="col-md-6">
                              <label for="c_diff_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="c_diff_fname" name="c_diff_fname">
                            </div>
                            <div class="col-md-6">
                              <label for="c_diff_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="c_diff_lname" name="c_diff_lname">
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="col-md-12">
                              <label for="c_diff_companyname" class="text-black">Company Name </label>
                              <input type="text" class="form-control" id="c_diff_companyname" name="c_diff_companyname">
                            </div>
                          </div>

                          <div class="form-group row  mb-3">
                            <div class="col-md-12">
                              <label for="c_diff_address" class="text-black">Address <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="c_diff_address" name="c_diff_address" placeholder="Street address">
                            </div>
                          </div>

                          <div class="form-group">
                            <input type="text" class="form-control" placeholder="Apartment, suite, unit etc. (optional)">
                          </div>

                          <div class="form-group row">
                            <div class="col-md-6">
                              <label for="c_diff_state_country" class="text-black">State / Country <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="c_diff_state_country" name="c_diff_state_country">
                            </div>
                            <div class="col-md-6">
                              <label for="c_diff_postal_zip" class="text-black">Posta / Zip <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="c_diff_postal_zip" name="c_diff_postal_zip">
                            </div>
                          </div>

                          <div class="form-group row mb-5">
                            <div class="col-md-6">
                              <label for="c_diff_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="c_diff_email_address" name="c_diff_email_address">
                            </div>
                            <div class="col-md-6">
                              <label for="c_diff_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="c_diff_phone" name="c_diff_phone" placeholder="Phone Number">
                            </div>
                          </div>

                        </div>

                      </div>
                    </div>

                    <div class="form-group">
                      <label for="c_order_notes" class="text-black">Order Notes</label>
                      <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
                    </div>

                  </div>
                </div>
                <div class="col-md-6">

                  <div class="row mb-5">
                    <div class="col-md-12">
                      <h2 class="h3 mb-3 text-primary">Order Id</h2>
                      <div class="p-3 p-lg-5 border bg-white">
                        <p class="text-primary fs-3"> <span class="text-primary"><?php echo $orderId; ?></span></p>
                      </div>

                

                      
                    </div>
                  </div>

                  <div class="row mb-5">
                    <div class="col-md-12">
                      <h2 class="h3 mb-3 text-primary">Your Order</h2>
                      <div class="p-3 p-lg-5 border bg-white">
                        <table class="table site-block-order-table mb-5">
                          <thead>
                            <th>Product</th>
                            <th>Total</th>
                          </thead>
                          <tbody id="order-items">
                            <!-- Order items will be dynamically generated here -->
                          </tbody>
                        </table>

                        <div class="border p-3 mb-3">
                          <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Bank Transfer</a></h3>

                          <div class="collapse" id="collapsebank">
                            <div class="py-2">
                              <p class="mb-0">Kindly make your payment directly into our bank account and use your Order ID as the payment reference. We’ll start processing your order as soon as the funds are cleared in our account. Thank you for your understanding!.</p>
                            </div>
                          </div>
                        </div>


                        <div class="border p-3 mb-5">
                          <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">
                                <div class="d-flex align-items-center">
                                    <img src="images/mastercard.png" height="30" width="auto" alt="" class="me-3">
                                    <img src="images/visacard.png" height="30" width="auto" alt="" class="me-3">
                                    <img src="images/vervecard.png" height="30" width="auto" alt="" class="me-3">
                                
                                

                                </div>
                            </a></h3>

                          <div class="collapse" id="collapsepaypal">
                            <div class="py-2">
                              <p class="mb-0">Pay securely using your credit or debit card. We accept Mastercard, Visa, and Verve. Your order will be processed immediately upon successful payment.</p>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <button class="btn p-3 btn-primary form-control" onclick="window.location='thankyou.php'">Place Order</button>
                        </div>

                      </div>
                    </div>
                  </div>

                </div>
              </div>
              <!-- </form> -->
            </div>
          </div>
          <?php include 'components/payment-channel.php'; ?>

        <!-- Start Footer Section -->
         <?php include 'components/footer.php'; ?>
        <!-- End Footer Section -->


        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/tiny-slider.js"></script>
        <script src="js/custom.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const orderItems = document.getElementById('order-items');

                function loadOrderItems() {
                    const cart = JSON.parse(localStorage.getItem('cart')) || [];
                    orderItems.innerHTML = '';

                    let subtotal = 0;

                    cart.forEach(item => {
                        const row = document.createElement('tr');
                        const total = item.sizePrice * item.quantity;
                        subtotal += total;

                        row.innerHTML = `
                            <td>${item.productName} <strong class="mx-2">x</strong> ${item.quantity}</td>
                            <td>#${total.toLocaleString()}.00</td>
                        `;
                        orderItems.appendChild(row);
                    });

                    const subtotalRow = document.createElement('tr');
                    subtotalRow.innerHTML = `
                        <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                        <td class="text-black">#${subtotal.toLocaleString()}.00</td>
                    `;
                    orderItems.appendChild(subtotalRow);

                    const totalRow = document.createElement('tr');
                    totalRow.innerHTML = `
                        <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                        <td class="text-black font-weight-bold"><strong>#${subtotal.toLocaleString()}.00</strong></td>
                    `;
                    orderItems.appendChild(totalRow);
                }

                loadOrderItems();
            });
        </script>
    </body>

</html>