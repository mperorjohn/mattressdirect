<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Updated path to vendor/autoload.php
require __DIR__ . '../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '../../');
$dotenv->load();

$check_login = isset($_SESSION['user']) && !empty($_SESSION['user']);
if (!$check_login) {
    header('Location: ../login.php');
    exit();
}

// Prepare API URL
$url = $_ENV['API_ROOT_DIR'] . 'contact/getAllMessage.php';

// Call API via cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POST, false);

$result = curl_exec($ch);
if ($result === false) {
    $contacts = [];
} else {
    $response = json_decode($result, true);
    if (json_last_error() !== JSON_ERROR_NONE || empty($response) || !$response['status']) {
        $contacts = [];
    } else {
        $contacts = isset($response['data']) ? $response['data'] : [];
    }
}
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
    <meta name="keywords" content="<?php echo $_ENV['APP_DESCRIPTION'] ?? ''; ?>" />
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/tiny-slider.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <title><?php echo $_ENV['APP_NAME'] ?? 'Default App Name'; ?> | Contact</title>
    <style>
    .contact-message {
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 5px;
        background-color: #f9f9f9;
        word-wrap: break-word; /* Ensures long words wrap */
        overflow-wrap: break-word; /* Fallback for other browsers */
    }
    .contact-message p {
        margin: 0;
        word-break: break-word; /* Break words inside paragraphs if needed */
    }
    .contact-message strong {
        display: inline-block;
        width: 100px;
    }
</style>
</head>
<body>
<?php include 'components/navbar.php'; ?>

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
        <div class="container mt-5">
            <h2>Contact Messages</h2>

            <!-- Pagination Info -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>Total Messages: <span id="totalMessages"><?php echo count($contacts); ?></span></div>
                <div>
                    Showing <span id="startItem">1</span> to <span id="endItem">10</span> of
                    <span id="totalMessages2"><?php echo count($contacts); ?></span>
                </div>
            </div>

            <div id="contactContainer" class="contact-messages"></div>
            <!-- Pagination Controls -->
            <nav aria-label="Contact Pagination">
                <ul class="pagination justify-content-center mt-4" id="pagination"></ul>
            </nav>
        </div>
        </div>
    </div>
</div>




<?php include 'components/footer.php'; ?>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/tiny-slider.js"></script>
<script src="js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
const contactsJS = <?php echo json_encode($contacts); ?> || [];
let currentPage = 1;
const itemsPerPage = 5;

function renderContacts() {
    const container = document.getElementById('contactContainer');
    container.innerHTML = '';

    if (contactsJS.length === 0) {
        container.innerHTML = '<p>No contact messages found.</p>';
        document.getElementById('startItem').textContent = 0;
        document.getElementById('endItem').textContent = 0;
        return;
    }

    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const paginatedContacts = contactsJS.slice(startIndex, endIndex);

    paginatedContacts.forEach(contact => {
        const firstName = contact.first_name ?? '';
        const lastName = contact.last_name ?? '';
        const email = contact.email ?? '';
        const message = contact.message ?? '';
        const createdAt = contact.created_at ?? '';

        const msgDiv = document.createElement('div');
        msgDiv.className = 'contact-message';
        msgDiv.innerHTML = `
            <p><strong>First Name:</strong> ${escapeHTML(firstName)}</p>
            <p><strong>Last Name:</strong> ${escapeHTML(lastName)}</p>
            <p><strong>Email:</strong> ${escapeHTML(email)}</p>
            <p><strong>Message:</strong> ${escapeHTML(message)}</p>
            <p><strong>Created At:</strong> ${escapeHTML(createdAt)}</p>
        `;
        container.appendChild(msgDiv);
    });

    document.getElementById('startItem').textContent = startIndex + 1;
    document.getElementById('endItem').textContent = Math.min(endIndex, contactsJS.length);
}

function updatePagination() {
    const totalMessages = contactsJS.length;
    const totalPages = Math.ceil(totalMessages / itemsPerPage);
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = '';

    const prevDisabled = (currentPage === 1) ? 'disabled' : '';
    pagination.innerHTML += `
        <li class="page-item ${prevDisabled}">
            <a class="page-link" href="#" aria-label="Previous">Previous</a>
        </li>
    `;

    for (let i = 1; i <= totalPages; i++) {
        const activeClass = (i === currentPage) ? 'active' : '';
        pagination.innerHTML += `
            <li class="page-item ${activeClass}">
                <a class="page-link" href="#">${i}</a>
            </li>
        `;
    }

    const nextDisabled = (currentPage === totalPages || totalPages === 0) ? 'disabled' : '';
    pagination.innerHTML += `
        <li class="page-item ${nextDisabled}">
            <a class="page-link" href="#" aria-label="Next">Next</a>
        </li>
    `;
}

document.getElementById('pagination').addEventListener('click', function(e) {
    if (e.target.tagName === 'A') {
        e.preventDefault();
        let text = e.target.textContent;

        if (text === 'Previous' && currentPage > 1) {
            currentPage--;
        } else if (text === 'Next' && currentPage < Math.ceil(contactsJS.length / itemsPerPage)) {
            currentPage++;
        } else if (!isNaN(parseInt(text))) {
            currentPage = parseInt(text);
        }
        renderContacts();
        updatePagination();
    }
});

function escapeHTML(str) {
    return str.replace(/[&<>"'\/]/g, function (c) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            '\'': '&#39;',
            '/': '&#x2F;'
        };
        return map[c];
    });
}

renderContacts();
updatePagination();
</script>
</body>
</html>