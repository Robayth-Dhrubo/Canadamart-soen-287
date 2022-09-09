<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dairy and Eggs | Canada Mart</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Fugaz+One&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="http://canadamart.onlinewebshop.net/css/style.css">
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
    <div class="row">
      <div class="col-12">
        <!-- Aisle name -->
        <div class="py-3 d-flex d-md-block justify-content-between align-items-center">
          <h1 class="text-center font-weight-bolder">Dairy and Eggs</h1>
          <div class="d-none d-md-block mx-auto rounded bg-dark bar"></div>
          <a href="#aisles" data-bs-toggle="collapse" class="d-md-none btn btn-sm btn-primary">Change aisle</a>
        </div>
      </div>

      <div class="col-12 col-md-3">
        <!-- Link to other aisles -->
        <div class="collapse" id="aisles">
          <h4 class="py-2 mt-4">Aisles:</h4>
          <div class="row g-2 text-center text-md-start">
            <div class="col-6 col-md-12">
              <div class="py-2 ps-md-2 ps-lg-3 position-relative border bg-light">
                <a href="/aisle/fruits-and-vegetables/" class="stretched-link text-reset text-decoration-none">Fruits
                  &amp; Vegetables</a>
              </div>
            </div>
            <div class="col-6 col-md-12">
              <div class="py-2 ps-md-2 ps-lg-3 position-relative border bg-light">
                <a href="/aisle/meat-and-poultry/" class="stretched-link text-reset text-decoration-none">Meat &amp;
                  Poultry</a>
              </div>
            </div>
            <div class="col-6 col-md-12">
              <div class="py-2 ps-md-2 ps-lg-3 position-relative border bg-dark text-white">
                <a href="/aisle/dairy-and-eggs/" class="stretched-link text-reset text-decoration-none">Dairy &amp;
                  Eggs</a>
              </div>
            </div>
            <div class="col-6 col-md-12">
              <div class="py-2 ps-md-2 ps-lg-3 position-relative border bg-light">
                <a href="/aisle/bread-and-bakery/" class="stretched-link text-reset text-decoration-none">Bread &amp;
                  Bakery</a>
              </div>
            </div>
            <div class="col-6 col-md-12">
              <div class="py-2 ps-md-2 ps-lg-3 position-relative border bg-light">
                <a href="/aisle/beverages/" class="stretched-link text-reset text-decoration-none">Beverages</a>
              </div>
            </div>
            <div class="col-6 col-md-12">
              <div class="py-2 ps-md-2 ps-lg-3 position-relative border bg-light">
                <a href="/aisle/snacks/" class="stretched-link text-reset text-decoration-none">Snacks</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-9 col-xl-8 offset-xl-1">
        <!-- Products -->
        <div class="row row-cols-2 row-cols-lg-3 gx-2 gx-sm-3 gx-lg-4 gy-4 g-xxl-5 my-3">
          <div class="col">
            <div class="card h-100 shadow-sm">
              <img src="img/yogurt.jpg" alt="" class="card-img-top">
              <div class="card-body">
                <h4 class="text-black">$5.49</h4>
                <h6 class="text-dark">
                  <a href="/product/?id=31" class="stretched-link text-decoration-none text-reset">Yogurt</a>
                </h6>
                <p class="text-secondary m-0 text-truncate">
                  <small>650 g</small>
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100 shadow-sm">
              <img src="img/icecream.jpg" alt="" class="card-img-top">
              <div class="card-body">
                <h4 class="text-black">$6.79</h4>
                <h6 class="text-dark">
                  <a href="/product/?id=32" class="stretched-link text-decoration-none text-reset">Ice
                    Cream</a>
                </h6>
                <p class="text-secondary m-0 text-truncate">
                  <small>414 ml</small>
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100 shadow-sm">
              <img src="img/eggsjpg.jpg" alt="" class="card-img-top">
              <div class="card-body">
                <h4 class="text-black">$7.99</h4>
                <h6 class="text-dark">
                  <a href="/product/?id=33" class="stretched-link text-decoration-none text-reset">Organic
                    Eggs</a>
                </h6>
                <p class="text-secondary m-0 text-truncate">
                  <small>12 each</small>
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100 shadow-sm">
              <img src="img/almondmilk.jpg" alt="" class="card-img-top">
              <div class="card-body">
                <h4 class="text-black">$4.49</h4>
                <h6 class="text-dark">
                  <a href="/product/?id=34" class="stretched-link text-decoration-none text-reset">Almond
                    Milk</a>
                </h6>
                <p class="text-secondary m-0 text-truncate">
                  <small>1.98 L</small>
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100 shadow-sm">
              <img src="img/butter.jpg" alt="" class="card-img-top">
              <div class="card-body">
                <h4 class="text-black">$4.99</h4>
                <h6 class="text-dark">
                  <a href="/product/?id=35" class="stretched-link text-decoration-none text-reset">Salted
                    Butter</a>
                </h6>
                <p class="text-secondary m-0 text-truncate">
                  <small>454 g</small>
                </p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100 shadow-sm">
              <img src="img/milk.jpg" alt="" class="card-img-top">
              <div class="card-body">
                <h4 class="text-black">$3.90</h4>
                <h6 class="text-dark">
                  <a href="/product/?id=36" class="stretched-link text-decoration-none text-reset">2% Milk</a>
                </h6>
                <p class="text-secondary m-0 text-truncate">
                  <small>2 L</small>
                </p>
              </div>
            </div>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/js/js.js"></script>
</body>

</html>