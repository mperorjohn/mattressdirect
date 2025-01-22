<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Corrected path to vendor/autoload.php
require __DIR__ . '../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '../../');
$dotenv->load();

$check_login = isset($_SESSION['user']) && !empty($_SESSION['user']);

$url = $_ENV['API_ROOT_DIR'] . 'product/getAllProduct.php';

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

$products = isset($response->data) ? $response->data : [];

curl_close($ch);
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
  <title><?php echo isset($_ENV['APP_NAME']) ? $_ENV['APP_NAME'] : 'Default App Name'; ?> | Dashboard</title>
</head>

<body>

<!-- Navbar section -->
<?php include 'components/navbar.php'; ?>
<!-- End Navbar section -->

<div class="container mt-5 mb-5">
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
      <div class="card">
        <div class="card-header bg-primary text-secondary p-3">
            <p class="fs-5">Welcome  <?php echo isset($_SESSION['user']) && $_SESSION['user'] ? " " . " " . $_SESSION['user']->first_name : "";?></p>
        </div>
        
      </div>

      <div class="bg-light p-3 mt-3 mb-3 d-flex flex-column flex-md-row justify-content-between align-items-center">
        <p class="fs-5 mb-2 mb-md-0">Items(<span id="totalItems"><?php echo count($products); ?></span>)</p>
        <p class="fs-5 mb-2 mb-md-0">
          Showing <span id="startItem">1</span> to <span id="endItem">5</span>
          of <span id="totalItems"><?php echo count($products); ?></span> items
        </p>
        <div class="d-flex justify-content-end flex-column flex-md-row">
          <select class="form-select w-auto me-0 me-md-2 mb-2 mb-md-0" id="itemsPerPage">
            <option value="8">Show 8</option>
            <option value="16">Show 16</option>
            <option value="32">Show 32</option>
            <option value="40">Show 40</option>
          </select>
          <select class="form-select w-auto" id="sortOptions">
            <option value="default">Sort by</option>
            <option value="priceAsc">Price: Low to High</option>
            <option value="priceDesc">Price: High to Low</option>
            <option value="nameAsc">Name: A to Z</option>
            <option value="nameDesc">Name: Z to A</option>
          </select>
        </div>
      </div>

      <div class="row">
            <div class="d-flex">
                <button class="text-secondary btn btn-primary" onclick="window.location='create-product.php'">Add Product</button>

            </div>
      </div>

      <div class="row mt-3" id="productList">
        <div class="d-flex"></div>
        <?php foreach($products as $product): ?>
        <div class="col-md-6 col-lg-3 mb-4">
          <div class="card h-100">
            <a href="product-details.php?id=<?php echo $product->id; ?>">
              <img
                src="<?php echo $product->product_image; ?>"
                class="card-img-top hover-effect"
                alt="Product Image"
                style="height: auto; width: 100%; margin-top: 5px; object-fit: cover;"
              >
            </a>
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <p class="card-title"><?php echo ucwords($product->product_name); ?></p>
                <p
                  class="card-title"
                  style="color:<?php echo isset($product->is_available) && $product->is_available ? 'green;' : 'red;'; ?>"
                >
                  <?php echo isset($product->is_available) && $product->is_available ? 'In Stock' : 'Out of Stock'; ?>
                </p>
              </div>
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-text fw-bold mb-0" style="color:#04048C;">
                  #<?php echo is_numeric($product->product_price) && !empty($product->product_price) ? number_format($product->product_price, 2) : '0.00'; ?>
                </h5>
                <div class="dropdown">
                  <!-- Three Vertical Dots Icon -->
                  <i
                    class="fas fa-ellipsis-v"
                    id="actionDropdown"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    style="cursor: pointer;"
                  ></i>
                  <!-- Dropdown Menu -->
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionDropdown">
                    <li>
                      <a class="dropdown-item small" href="product-details.php?id=<?php echo $product->id; ?>">
                        <i class="fas fa-eye"></i> View
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item small" href="create-product.php?rw=true&id=<?php echo $product->id; ?>">
                        <i class="fas fa-edit"></i> Update
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item small" href="product-delete.php?id=<?php echo $product->id; ?>">
                        <i class="fas fa-trash"></i> Delete
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center" id="pagination"></ul>
      </nav>
    </div>
  </div>
</div>

<!-- Start Footer Section -->
<?php include 'components/footer.php'; ?>
<!-- End Footer Section -->

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/tiny-slider.js"></script>
<script src="js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }

  const jsProducts = <?php echo json_encode($products); ?>;
  let currentPage = 1;
  let itemsPerPage = 8;

  function renderProducts() {
    const productList = document.getElementById('productList');
    productList.innerHTML = '';

    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const paginatedProducts = jsProducts.slice(start, end);

    paginatedProducts.forEach(product => {
      const productItem = document.createElement('div');
      productItem.className = 'col-md-6 col-lg-3 mb-4 product-item';
      productItem.dataset.price = product.product_price;
      productItem.dataset.name = product.product_name;
      productItem.innerHTML = `
        <div class="card h-100">
          <a href="product-details.php?id=${product.id}">
            <img
              src="${product.product_image}"
              class="card-img-top hover-effect"
              alt="Product Image"
              style="height: auto; width: 100%; margin-top: 5px; object-fit: cover;"
            >
          </a>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <p class="card-title">${capitalizeFirstLetter(product.product_name)}</p>
              <p class="card-title mb-0" style="color:${product.is_available ? 'green' : 'red'}">
                ${product.is_available ? 'In Stock' : 'Out of Stock'}
              </p>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="card-text fw-bold mb-0" style="color:#04048C;">
                #${Number(product.product_price) ? Number(product.product_price).toLocaleString() : '0.00'}
              </h5>
              <div class="dropdown">
                <i
                  class="fas fa-ellipsis-v"
                  id="actionDropdown"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  style="cursor: pointer;"
                ></i>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionDropdown">
                  <li>
                    <a class="dropdown-item small" href="product-details.php?id=${product.id}">
                      <i class="fas fa-eye"></i> View
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item small" href="create-product.php?rw=true&id=${product.id}">
                      <i class="fas fa-edit"></i> Update
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item small" href="product-delete.php?id=${product.id}">
                      <i class="fas fa-trash"></i> Delete
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      `;
      productList.appendChild(productItem);
    });

    document.getElementById('startItem').textContent = start + 1;
    document.getElementById('endItem').textContent = Math.min(end, jsProducts.length);
  }

  function updatePagination() {
    const pagination = document.getElementById('pagination');
    const totalPages = Math.ceil(jsProducts.length / itemsPerPage);

    pagination.innerHTML = `
      <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
        <a class="page-link" href="#" tabindex="-1" aria-disabled="${currentPage === 1}">Previous</a>
      </li>
    `;

    for (let i = 1; i <= totalPages; i++) {
      pagination.innerHTML += `
        <li class="page-item ${currentPage === i ? 'active' : ''}">
          <a class="page-link" href="#">${i}</a>
        </li>
      `;
    }

    pagination.innerHTML += `
      <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
        <a class="page-link" href="#">Next</a>
      </li>
    `;
  }

  document.getElementById('itemsPerPage').addEventListener('change', function() {
    itemsPerPage = parseInt(this.value) || 8;
    currentPage = 1;
    renderProducts();
    updatePagination();
  });

  document.getElementById('sortOptions').addEventListener('change', function() {
    const sortOption = this.value;
    if (sortOption === 'priceAsc') {
      jsProducts.sort((a, b) => a.product_price - b.product_price);
    } else if (sortOption === 'priceDesc') {
      jsProducts.sort((a, b) => b.product_price - a.product_price);
    } else if (sortOption === 'nameAsc') {
      jsProducts.sort((a, b) => a.product_name.localeCompare(b.product_name));
    } else if (sortOption === 'nameDesc') {
      jsProducts.sort((a, b) => b.product_name.localeCompare(a.product_name));
    }
    renderProducts();
  });

  document.getElementById('pagination').addEventListener('click', function(event) {
    if (event.target.tagName === 'A') {
      event.preventDefault();
      const pageText = event.target.textContent;
      if (pageText === 'Previous' && currentPage > 1) {
        currentPage--;
      } else if (pageText === 'Next' && currentPage < Math.ceil(jsProducts.length / itemsPerPage)) {
        currentPage++;
      } else if (!isNaN(parseInt(pageText))) {
        currentPage = parseInt(pageText);
      }
      renderProducts();
      updatePagination();
    }
  });

  renderProducts();
  updatePagination();
</script>
</body>
</html>