<?php
session_start();
$products_xml = simplexml_load_file(__DIR__ . "/../data/products.xml");
$product_info = $products_xml->xpath("/products/product[id=" . $_GET['id'] . "]");
echo "<script>
        var productID = " . $_GET['id'] . ";
      </script>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $product_info[0]->name; ?> | Canada Mart</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fugaz+One&display=swap">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/css/style.css">
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
    <div class="row my-5" id="display-product">
      <!-- Product image -->
      <div class="col-auto col-md-4 mb-5 mb-md-0 mx-auto me-md-5 me-xl-0">
        <img class="img-fluid" src="<?php echo $product_info[0]->image; ?>" alt="Product image">
      </div>
      <!-- Product title, description, price -->
      <div class="col-12 col-md col-xl-7 offset-xl-1">
        <div class="text-uppercase text-secondary"><?php echo $product_info[0]->brand; ?></div>
        <div class="text-capitalize">
          <h1><?php echo $product_info[0]->name; ?></h1>
        </div>
        <div class="fs-6 text-muted"><?php echo $product_info[0]->weight; ?></div>
        <div class="py-3">
          <?php echo $product_info[0]->description; ?>
        </div>
        <!-- Favourite, Add to list, Details buttons -->
        <div class="row row-cols-auto gx-3 align-items-center mt-2 mb-4 mb-md-0">
          <div class="col">
            <button class="btn p-0" id="btn-favorite">
              <i class="bi bi-heart fs-2"></i>
            </button>
          </div>
          <div class="col">
            <button type="button" class="btn btn-outline-primary">Add to list</button>
          </div>
          <div class="col">
            <button type="button" class="btn btn-outline-primary" id="details">Details</button>
          </div>
        </div>
        <!-- Price -->
        <div class="mt-3">
          <div class="bg-light bg-gradient py-2 mb-2 text-center text-secondary">
            The price is valid until May 23
          </div>
          <span class="fs-3 me-3">$<?php echo $product_info[0]->price; ?></span>
          <br>
          <small class="text-secondary">$0.50/100g</small>
        </div>
        <!-- Add to cart -->
        <div class="my-3">
          <div class="row row-cols-auto gx-2 align-items-center">
            <div class="col" id="decrease-btn">
              <i class="bi bi-dash-circle fs-2"></i>
            </div>
            <div class="col">
              <input type="number" min="0" size="2" onfocusout="changeQty()" class="form-control" id="quantity">
            </div>
            <div class="col" id="increase-btn">
              <i class="bi bi-plus-circle fs-2"></i>
            </div>
            <div class="col">
              <button class="btn btn-primary ms-4 ms-md-5 px-4 px-lg-5" id="add-to-cart">
                <i class="bi bi-bag-plus-fill pe-2"></i>
                Add to cart
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-5">
      <div class="col-12">
        <nav class="mb-2">
          <div class="nav nav-tabs" id="nav-tab">
            <a class="nav-link active px-2 px-sm-3" data-bs-toggle="tab" href="#specifications">Specifications</a>
            <a class="nav-link px-2 px-sm-3" data-bs-toggle="tab" href="#description">Description</a>
            <a class="nav-link px-2 px-sm-3" data-bs-toggle="tab" href="#nutritional-information">Nutritional info</a>
          </div>
        </nav>
        <div class="tab-content" id="tab-content">
          <div class="tab-pane fade show active" id="specifications">
            <table class="table table-striped table-hover">
              <tbody>
                <tr>
                  <th>Product Type</th>
                  <td><?php echo $product_info[0]->type; ?></td>
                </tr>
                <tr>
                  <th>Storage Type</th>
                  <td><?php echo $product_info[0]->storagetype; ?></td>
                </tr>
                <tr>
                  <th>Brand</th>
                  <td><?php echo $product_info[0]->brand; ?></td>
                </tr>
                <tr>
                  <th>Item#</th>
                  <td><?php echo $product_info[0]->id; ?></td>
                </tr>
                <tr>
                  <th>SKU</th>
                  <td>6000200619391</td>
                </tr>
                <tr>
                  <th>UPC</th>
                  <td>6410013173</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="tab-pane fade" id="description">
            <!-- Asynchronous loading from the server -->
          </div>
          <div class="tab-pane fade" id="nutritional-information">

            <p class="mt-3"><strong>Ingredients:</strong> WHEAT FLOUR, VEGETABLE OIL (VEGETABLE OIL, TBHQ, CITRIC
              ACID), HIGH MOISTURE SKIM MILK CHEESE (SKIM
              MILK, WHEY PROTEIN, SALT, BACTERIAL CULTURE, CHYMOSIN, ANNATTO), PALM OIL SHORTENING, SALT, SPICES,
              YEAST, SPICE EXTRACT, ENZYMES (AMYLASE, PROTEASE), SOY LECITHIN. CONTAINS WHEAT, MILK AND SOY
              INGREDIENTS. MAY CONTAIN MUSTARD AND SULPHITES.</p>
            <p>
              we always strive to make sure the information about the products we sell is always as accurate as
              possible. However, because products are regularly improved, the product information, ingredients,
              nutritional guides and dietary or allergy advice may occasionally change.
            </p>
            <p>
              As a result, we recommend that you always read the label carefully before using or consuming any
              products. Please do not solely rely on the information provided on this website. Walmart Canada does not
              accept any liability for any inaccuracies or incorrect information contained on this website.
            </p>
          </div>
        </div>

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

  <!-- Toast -->
  <div class="position-fixed bottom-0 start-50 translate-middle-x w-auto h-auto mb-4">
    <div class="toast shadow bg-dark text-white border border-secondary">
      <div class="d-flex">
        <i class="bi bi-check-circle-fill my-auto ms-3 me-1"></i>
        <div class="toast-body">
          The item has been added to your cart.
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/js/js.js"></script>
  <script src="/js/dp.js"></script>
</body>

</html>