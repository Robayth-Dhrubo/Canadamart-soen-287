<?php
session_start();

if (!isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {
  header("Location: /");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product List | Canada Mart</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fugaz+One&display=swap">
  <link rel="stylesheet" href="http://canadamart.onlinewebshop.net/css/style.css">
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
          <span class="badge rounded-pill bg-light text-dark">6</span>
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

  <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center">
      <h1>Product List</h1>
      <a href="add/" class="btn btn-outline-primary"><i class="bi bi-plus"></i>Add Product</a>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <form class="form-inline my-2 my-lg-0"></form>
          <li>
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          </li>
          <li>
            &nbsp;
          </li>
          <li>
            <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</span></button>
          </li>
          </form>
          <li>
            &nbsp;
          </li>
        </ul>
      </div>
    </nav>
    <div class="table-responsive">
      <table id="mytable" class="table table-bordred table-striped table-hover">
        <thead>
          <th>ID</th>
          <th>Image</th>
          <th>Brand</th>
          <th>Product Name</th>
          <th>weight</th>
          <th>Description</th>
          <th>Price</th>
          <th>Product Type</th>
          <th>Storage Type</th>
          <th>Edit</th>
          <th>Delete</th>
        </thead>
        <tbody>
          <?php
          $xml = simplexml_load_file(__DIR__ . "/../data/products.xml") or die("Error: Cannot create object");
          foreach ($xml->children() as $products) {
          ?>
            <tr>
              <td><?php echo $products->id ?></td>
              <td><img src="<?php echo $products->image; ?>" alt="image not found" class="img-fluid" height="150" width="150"></td>
              <td><?php echo $products->brand ?></td>
              <td><?php echo $products->name ?></td>
              <td><?php echo $products->weight ?></td>
              <td><?php echo $products->description ?></td>
              <td>$<?php echo $products->price ?></td>
              <td><?php echo $products->type ?></td>
              <td><?php echo $products->storagetype ?></td>
              <td>
                <p>
                  <a href="add/index.php?update=true&id=<?php echo $products->id; ?>" class="btn btn-secondary btn-xs">
                    <i class="bi bi-pencil"></i>
                  </a>
                </p>
              </td>
              <td>
                <p>
                  <a href="delete.php?id=<?php echo $products->id; ?>" class="btn btn-danger btn-xs">
                    <i class="bi bi-trash"></i>
                  </a>
                </p>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
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
</body>

</html>