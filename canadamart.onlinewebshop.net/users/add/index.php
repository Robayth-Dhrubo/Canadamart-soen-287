<?php

session_start();

if (!isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {
  header("Location: /");
}
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Fugaz+One&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="http://canadamart.onlinewebshop.net/css/style.css">
  <title>Edit User Profile</title>
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
  <!-- Brand name -->
  <div class="container">
    <h1>New User</h1>

    <form action="adduser.php" method="post">
      <!-- Product image -->
      <h4 class="mt-5 mb-3">
        Account Information
      </h4>
      <div class="row mb-3">
        <label for="Email" class="col-md-3 col-form-label">Email</label>
        <div class="col-md-9">
          <input type="email" name="email" class="form-control" id="Email">
        </div>
      </div>
      <div class="row mb-3">
        <label for="Password" class="col-md-3 col-form-label">Password</label>
        <div class="col-md-9">
          <input type="password" name="password" class="form-control" id="Password">
        </div>
      </div>
      <h4 class="mt-5 mb-3">
        Personal Information
      </h4>
      <div class="row mb-3">
        <label for="first name" class="col-md-3 col-form-label">First name</label>
        <div class="col-md-9">
          <input type="text" name="fname" class="form-control" id="first name">
        </div>
      </div>
      <div class="row mb-3">
        <label for="last name" class="col-md-3 col-form-label">Last name</label>
        <div class="col-md-9">
          <input type="text" name="lname" class="form-control" id="last name">
        </div>
      </div>
      <div class="row mb-3">
        <label for="Age" class="col-md-3 col-form-label">Age</label>
        <div class="col-md-9">
          <input type="text" name="age" class="form-control" id="Age">
        </div>
      </div>
      <div class="row mb-3">
        <label for="Address" class="col-md-3 col-form-label">Address</label>
        <div class="col-md-9">
          <input type="text" name="address" class="form-control" id="Address">
        </div>
      </div>
      <div class="row mb-3">
        <label for="City" class="col-md-3 col-form-label">City</label>
        <div class="col-md-9">
          <input type="text" name="city" class="form-control" id="City">
        </div>
      </div>
      <div class="row mb-3">
        <label for="Province" class="col-md-3 col-form-label">Province</label>
        <div class="col-md-9">
          <input type="text" name="province" class="form-control" id="Province">
        </div>
      </div>
      <div class="row mb-3">
        <label for="Country" class="col-md-3 col-form-label">Country</label>
        <div class="col-md-9">
          <input type="text" name="country" class="form-control" id="Country">
        </div>
      </div>
      <div class="row mb-3">
        <label for="Postal code" class="col-md-3 col-form-label">Postal code</label>
        <div class="col-md-9">
          <input type="text" name="postalcode" class="form-control" id="Postal code">
        </div>
      </div>

      <button type="submit" class="btn btn-primary btn-sm me-1">Create User</button>
  </div>

  </div>
  </form>
  </div>

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