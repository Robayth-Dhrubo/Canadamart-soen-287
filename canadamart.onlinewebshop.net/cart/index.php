<?php
session_start();
if (isset($_COOKIE['items'])) {
  $product_ids = isset($_COOKIE['items']) ? (explode(',', trim($_COOKIE['items'], '[]'))) : '';
  $product_qty = isset($_COOKIE['quantities']) ? (explode(',', trim($_COOKIE['quantities'], '[]'))) : '';
  // $product_ids = preg_filter('/^/', 'id=', $product_ids);
  $products_xml = simplexml_load_file(__DIR__ . '/../data/products.xml');
  echo '<script>var priceList = [];</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Cart | Canada Mart</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fugaz+One&display=swap">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/css/style.css">
  <style>
    [class^="bi-"]::before,
    [class*=" bi-"]::before {
      line-height: 1.3;
    }
  </style>
</head>

<body>
  <!-- First navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-md mt-2">
      <!-- Branding -->
      <a class="navbar-brand" href="/">
        <img src="https://upload.wikimedia.org/wikipedia/commons/f/fd/Maple_Leaf.svg" width="32" alt="Canada mart logo">
        <span style="font-family: Fugaz One;">Mart</span>
      </a>
      <!-- Cart -->
      <a href="/cart/" class="position-relative d-inline-block text-reset ms-auto ms-sm-0 px-2 ps-lg-0 order-sm-5 order-md-last">
        <i class="bi bi-cart-fill text-light fs-2"></i>
        <span class="position-absolute top-0 start-100 translate-middle">
          <span class="badge rounded-pill bg-light text-dark" id="ci-count"></span>
        </span>
      </a>
      <!-- Search toggler -->
      <a class="btn border ms-3 me-2 d-sm-none" data-bs-toggle="collapse" href="#searchCol">
        <i class="bi bi-search text-light"></i>
      </a>
      <!-- Nav toggler -->
      <button class="navbar-toggler ms-sm-3 me-sm-2 order-sm-last" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Search -->
      <div class="collapse w-50 mx-auto mt-2 mt-sm-0" id="searchCol">
        <form>
          <div class="input-group">
            <input type="search" class="form-control" placeholder="Search">
            <a href="#" class="btn btn-secondary">
              <i class="bi bi-search"></i>
            </a>
          </div>
        </form>
      </div>
    </div>
  </nav>
  <!-- Second navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light bg-gradient mb-3 mb-md-5">
    <div class="container">
      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
              Aisles
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/aisle/fruits-and-vegetables/">Fruits &amp; Vegetables</a></li>
              <li><a class="dropdown-item" href="/aisle/meat-and-poultry/">Meat &amp; Poultry</a></li>
              <li><a class="dropdown-item" href="/aisle/dairy-and-eggs/">Dairy & Eggs</a></li>
              <li><a class="dropdown-item" href="/aisle/bread-and-bakery/">Bread &amp; Bakery</a></li>
              <li><a class="dropdown-item" href="/aisle/beverages/">Beverages</a></li>
              <li><a class="dropdown-item" href="/aisle/snacks/">Snacks</a></li>
            </ul>
          </li>
          <?php
          if (isset($_SESSION['role']) && isset($_SESSION['uid'])) {
            if ($_SESSION['role'] == 'admin') {
              echo '<li class="nav-item">
                      <a class="nav-link" href="/products/">Products</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/users/">Users</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/orders/">Orders</a>
                    </li>';
            }
            echo '<li class="nav-item">
                    <a class="nav-link" href="/logout/">Logout</a>
                  </li>';
          } else {
            echo '<li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Flyers</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/sign-up/">Sign up</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/login/">Login</a>
                  </li>';
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="row gx-xl-5 my-5">
      <!-- Cart summary -->
      <div class="col-12 col-lg-3 mb-5 mb-lg-0 order-lg-2" id="cart-summary">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-1 mb-md-3 mb-lg-0">
          <div class="col">
            <div class="card shadow-sm mb-3">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                  <h2>Cart Summary</h2>
                  <span class="badge rounded-pill fs-6 bg-dark" data-bs-toggle="tooltip" title="Number of items" id="item-count"></span>
                </div>

                <ul class="list-unstyled d-grid gap-2 my-3">
                  <li class="d-flex justify-content-between">
                    <span class="fw-lighter">Subtotal</span>
                    <span class="fw-bolder">$<span id="subtotal">0.00</span></span>
                  </li>
                  <li class="d-flex justify-content-between">
                    <span class="fw-lighter">GST (5%)</span>
                    <span>$<span id="gst">0.00</span></span>
                  </li>
                  <li class="d-flex justify-content-between">
                    <span class="fw-lighter">QST (9.975%)</span>
                    <span>$<span id="qst">0.00</span></span>
                  </li>
                  <li class="d-flex justify-content-between fs-4 border-top">
                    <span class="fw-lighter">Total</span>
                    <span class="fw-bolder">$<span id="total">0.00</span></span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card shadow-sm">
              <div class="card-body">
                <h2 class="mb-4">
                  Promotional Code
                </h2>
                <p class="text-muted">
                  If you have a promotional code, you can enter it here before checking out.
                </p>
                <form>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="ABC1234">
                    <button class="btn btn-secondary" type="button">Button</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- Checkout button -->
            <a href="<?php if (isset($_SESSION['role']) && isset($_SESSION['uid'])) {
                        echo "placeorder.php";
                      } else {
                        echo "/login";
                      } ?>" class="btn btn-primary w-100 mt-3">
              <i class="bi bi-check2-circle pe-2"></i>
              Checkout
            </a>
            <p class="text-muted mt-3">
              Once you click on checkout, you'll be asked to enter your payment info
            </p>
          </div>
        </div>
      </div>

      <!-- List of items -->
      <div class="col-12 col-lg-9 order-lg-1" id="item-container">
        <div class="d-flex justify-content-between align-items-center">
          <h2 class="mb-4">My cart</h2>
          <a href="/" class="btn btn-outline-primary">Continue shopping</a>
        </div>

        <?php
        if (isset($_COOKIE['items']) && strlen($_COOKIE['items']) > 2) {
          for ($i = 0; $i < count($product_ids); $i++) {
            $product = $products_xml->xpath('/products/product[id=' . $product_ids[$i] . ']');
        ?>
            <div class="row align-items-center py-3 border-bottom" id="ci-<?php echo $product[0]->id; ?>">
              <!-- Product image -->
              <div class="col-3 col-lg-2 col-xl-auto">
                <img src="<?php echo $product[0]->image; ?>" class="cart-item-img img-fluid rounded">
              </div>
              <!-- Product title -->
              <div class="col-9 col-lg-4 col-xxl-5">
                <small class="text-secondary text-uppercase"><?php echo $product[0]->brand; ?></small>
                <h5 class="m-0"><?php echo $product[0]->name; ?></h5>
                <small class="text-muted"><?php echo $product[0]->weight; ?></small>
              </div>
              <!-- Quantity modifier -->
              <div class="col-5 col-sm-4 offset-sm-3 col-lg-3 offset-lg-0 col-xl-auto mt-2 mt-xl-3">
                <div class="row row-cols-lg-auto gx-2 align-items-center">
                  <div class="col-auto" onclick="decreaseQty(this.id)" id="ci-<?php echo $product[0]->id; ?>-d">
                    <i class="bi bi-dash-circle fs-2"></i>
                  </div>
                  <div class="col">
                    <input type="number" min="0" size="2" onfocusin="getCurrentQty(this.id)" onfocusout="changeQty(this.id)" class="form-control" id="ci-<?php echo $product[0]->id; ?>-q">
                  </div>
                  <div class="col-auto" onclick="increaseQty(this.id)" id="ci-<?php echo $product[0]->id; ?>-i">
                    <i class="bi bi-plus-circle fs-2"></i>
                  </div>
                </div>
              </div>
              <!-- Price -->
              <div class="col-4 col-sm-3 col-lg-2 col-xl-2 mt-2 mt-xl-3 text-center">
                <span class="fs-5">$<span id="ci-<?php echo $product[0]->id; ?>-p"></span></span>
              </div>
              <!-- Delete button -->
              <div class="col-auto mt-2 mt-xl-3 ms-auto ms-xl-0 me-4 me-lg-0">
                <button type="button" onclick="deleteItm(this.id)" class="btn p-0 text-danger" id="ci-<?php echo $product[0]->id; ?>-dl">
                  <i class="bi bi-trash fs-3"></i>
                </button>
              </div>
            </div>
        <?php
            echo '<script>
                priceList.push(' . $product[0]->price . ');
              </script>
              ';
          }
        } else {
          echo 'Your cart is empty.';
        }
        ?>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="bg-dark mt-5">
    <div class="container">
      <div class="row py-5">
        <!-- Opening hours -->
        <div class="col-12 col-sm-7 col-md-6 col-lg-4 text-white mb-4">
          <h4 class="mb-3">Opening hours:</h4>
          <div class="row">
            <div class="col-4">Monday</div>
            <div class="col-8">08:00 AM - 07:30 PM</div>
          </div>
          <div class="row">
            <div class="col-4">Tuesday</div>
            <div class="col-8">08:00 AM - 07:30 PM</div>
          </div>
          <div class="row">
            <div class="col-4">Wednesday</div>
            <div class="col-8">08:00 AM - 07:30 PM</div>
          </div>
          <div class="row">
            <div class="col-4">Thursday</div>
            <div class="col-8">08:00 AM - 07:30 PM</div>
          </div>
          <div class="row">
            <div class="col-4">Friday</div>
            <div class="col-8">08:00 AM - 07:30 PM</div>
          </div>
          <div class="row">
            <div class="col-4">Saturday</div>
            <div class="col-8">08:00 AM - 05:00 PM</div>
          </div>
          <div class="row">
            <div class="col-4">Sunday</div>
            <div class="col-8">08:00 AM - 05:00 PM</div>
          </div>
        </div>
        <!-- Canada Mart -->
        <div class="col-12 col-sm-5 col-md-5 col-lg-4 offset-md-1 ms-lg-auto text-white mb-4">
          <h4 class="mb-3">Canada Mart</h4>
          <div class="row">
            <div class="col-5 col-sm-6 col-lg-5">
              <ul class="list-unstyled">
                <li class=""><a href="#" class="text-reset text-decoration-none">Flyers</a></li>
                <li><a href="#" class="text-reset text-decoration-none">Coupons</a></li>
                <li><a href="#" class="text-reset text-decoration-none">Services</a></li>
                <li><a href="#" class="text-reset text-decoration-none">Priority</a></li>
                <li><a href="#" class="text-reset text-decoration-none">Gift card</a></li>
                <li><a href="#" class="text-reset text-decoration-none">Products</a></li>
                <li><a href="#" class="text-reset text-decoration-none">Recipes</a></li>
              </ul>
            </div>
            <div class="col-7 col-sm-6 col-lg-6 offset-lg-1">
              <ul class="list-unstyled">
                <li><a href="#" class="text-reset text-decoration-none">Corporate</a></li>
                <li><a href="#" class="text-reset text-decoration-none">Suppliers</a></li>
                <li><a href="#" class="text-reset text-decoration-none">Partners</a></li>
                <li><a href="#" class="text-reset text-decoration-none">Careers</a></li>
                <li><a href="#" class="text-reset text-decoration-none">Privacy policy</a></li>
                <li><a href="#" class="text-reset text-decoration-none">About</a></li>
                <li><a href="#" class="text-reset text-decoration-none">Contact</a></li>
              </ul>
            </div>
          </div>

        </div>
        <!-- About -->
        <div class="col-12 col-lg-auto ms-lg-auto">
          <div class="text-white">
            <a href="/" class="fs-3 text-reset text-decoration-none">
              <h4 class="mb-2">
                <img src="https://upload.wikimedia.org/wikipedia/commons/f/fd/Maple_Leaf.svg" width="32" alt="Canada mart logo">
                <span style="font-family: Fugaz One;">Mart</span>
              </h4>
            </a>
          </div>
          <div class="text-white lead">
            Designed and built for your safety <br>&copy; Created by Canada Mart Team
          </div>
          <div class="mt-3 text-white">
            <a href="https://www.youtube.com/" class="text-reset text-decoration-none me-4 me-lg-4">
              <i class="bi bi-youtube fs-2"></i>
            </a>
            <a href="https://www.twitter.com/" class="text-reset text-decoration-none me-4 me-lg-4">
              <i class="bi bi-twitter fs-2"></i>
            </a>
            <a href="https://www.facebook.com/" class="text-reset text-decoration-none me-4 me-lg-4">
              <i class="bi bi-facebook fs-2"></i>
            </a>
            <a href="https://www.instagram.com/" class="text-reset text-decoration-none me-4 me-lg-4">
              <i class="bi bi-instagram fs-2"></i>
            </a>
            <a href="https://www.linkedin.com/" class="text-reset text-decoration-none">
              <i class="bi bi-linkedin fs-2"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/js/js.js"></script>
  <script src="/js/cart.js"></script>
</body>

</html>