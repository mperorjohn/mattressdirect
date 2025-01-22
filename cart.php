<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$shipping_fee = 5000;
?>
<!DOCTYPE html>
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
  <title><?php echo isset($_ENV['APP_NAME']) ? $_ENV['APP_NAME'] : 'Default App Name'; ?> | Cart</title>
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
            <h1>Cart</h1>
          </div>
        </div>
        <div class="col-lg-7">
        </div>
      </div>
    </div>
  </div>
  <!-- End Hero Section -->

  <div class="untree_co-section before-footer-section">
    <div class="container">
      <div class="row mb-5">
        <form class="col-md-12" method="post">
          <div class="site-blocks-table">
            <table class="table table-bordered">
              <thead class="thead-dark">
                <tr>
                  <th class="product-thumbnail">Image</th>
                  <th class="product-name">Product</th>
                  <th class="product-price">Price</th>
                  <th class="product-quantity">Quantity</th>
                  <th class="product-total">Total</th>
                  <th class="product-remove">Remove</th>
                </tr>
              </thead>
              <tbody id="cart-items">
                <!-- Cart items will be dynamically generated here -->
              </tbody>
            </table>
          </div>
        </form>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="row mb-5">
            <div class="col-md-6 mb-3 mb-md-0">
              <button class="btn btn-primary btn-sm btn-block" onclick="window.location.href='shop.php'">Update Cart</button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <label class="text-black h4" for="coupon">Coupon</label>
              <p>Enter your coupon code if you have one.</p>
            </div>
            <div class="col-md-8 mb-3 mb-md-0">
              <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
            </div>
            <div class="col-md-4">
              <button class="btn btn-primary">Apply Coupon</button>
            </div>
          </div>
        </div>
        <div class="col-md-6 pl-5">
          <div class="row justify-content-end">
            <div class="col-md-7">
              <div class="row">
                <div class="col-md-12 text-right border-bottom mb-5">
                  <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-6">
                  <span class="text-black">Subtotal</span>
                </div>
                <div class="col-md-6 text-right">
                  <strong class="text-black" id="cart-subtotal">#0.00</strong>
                </div>
              </div>
              <div class="row mb-5">
                <div class="col-md-6">
                  <span class="text-black">Total</span>
                </div>
                <div class="col-md-6 text-right">
                  <strong class="text-black" id="cart-total">#0.00</strong>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='checkout.php'">Proceed To Checkout</button>
                </div>
              </div>
            </div>
          </div>
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
  <!-- <script src="js/custom.js"></script> -->
  <script>
    function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

    document.addEventListener('DOMContentLoaded', function() {
      const cartItems = document.getElementById('cart-items');
      const cartSubtotal = document.getElementById('cart-subtotal');
      const cartTotal = document.getElementById('cart-total');

      function updateCartTotals() {
        let subtotal = 0;
        cartItems.querySelectorAll('tr').forEach(row => {
          const price = parseFloat(row.querySelector('.product-price').getAttribute('data-price'));
          const quantityInput = row.querySelector('.quantity-amount');
          const quantity = parseInt(quantityInput.value) || 1;
          quantityInput.value = quantity < 1 ? 1 : quantity;
          const total = price * quantity;
          row.querySelector('.product-total').textContent = `#${total.toLocaleString()}.00`;
          subtotal += total;
        });
        cartSubtotal.textContent = `#${subtotal.toLocaleString()}.00`;
        cartTotal.textContent = `#${subtotal.toLocaleString()}.00`;
      }

      
      function loadCartItems() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        cartItems.innerHTML = '';

        cart.forEach((item, index) => {
          const row = document.createElement('tr');
          row.setAttribute('data-id', index);
          row.innerHTML = `
            <td class="product-thumbnail">
              <img src="${item.productImage}" alt="Product Image" class="img-fluid">
            </td>
            <td class="product-name">
              <h2 class="h5 text-primary text-start">${capitalizeFirstLetter(item.productName)}</h2>
              <span class="text-start">${item.productSize}</span>
            </td>
            <td class="product-price" data-price="${item.sizePrice}">#${item.sizePrice.toLocaleString()}.00</td>
            <td>
              <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                <div class="input-group-prepend">
                  <button class="btn btn-outline-secondary decrease" type="button">&minus;</button>
                </div>
                <input type="text" class="form-control text-center quantity-amount" value="${item.quantity}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary increase" type="button">&plus;</button>
                </div>
              </div>
            </td>
            <td class="product-total">#${(item.sizePrice * item.quantity).toLocaleString()}.00</td>
            <td><button type="button" class="btn btn-danger btn-sm remove-item">X</button></td>
          `;
          cartItems.appendChild(row);
        });

        updateCartTotals();
      }

      cartItems.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-item')) {
          const row = event.target.closest('tr');
          const index = row.getAttribute('data-id');
          let cart = JSON.parse(localStorage.getItem('cart')) || [];
          cart.splice(index, 1);
          localStorage.setItem('cart', JSON.stringify(cart));
          row.remove();
          updateCartTotals();
        } else if (event.target.classList.contains('increase')) {
          const quantityInput = event.target.closest('.quantity-container').querySelector('.quantity-amount');
          quantityInput.value = parseInt(quantityInput.value) + 1;
          updateCartTotals();
        } else if (event.target.classList.contains('decrease')) {
          const quantityInput = event.target.closest('.quantity-container').querySelector('.quantity-amount');
          if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
            updateCartTotals();
          }
        }
      });

      cartItems.addEventListener('input', function(event) {
        if (event.target.classList.contains('quantity-amount')) {
          const value = parseInt(event.target.value) || 1;
          event.target.value = value < 1 ? 1 : value;
          updateCartTotals();
        }
      });

      loadCartItems();
    });
  </script>
</body>
</html>