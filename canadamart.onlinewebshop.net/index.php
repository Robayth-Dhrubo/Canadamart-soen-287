<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Fugaz+One&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong|Shrikhand|Fredoka One">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/css/style.css">
  <title>Canada Mart</title>
  <style>
    .logo {
      font-family: "Fredoka One", serif;
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

    <!--main header-->




    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="10000">
          <img src="img/1.jpg" class="d-block w-100 " alt="first image">
          <div class="card-img-overlay">
            <h1 class="card-title text-center text-white logo">Canada Mart</h1>
            <br>
            <br>
            <h2 class="card-text text-center text-white"> Welcome to a brand new way to do your groceries safely!</h2>

          </div>
        </div>

        <div class="carousel-item">
          <img src="img/2.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h3 class="card-title font-size:100px  text-center text text-white ">Find all you need to create a
              delicious meal</h3>
            <p>Vegan options available</p>
          </div>
        </div>


        <div class="carousel-item">
          <img src="img/3.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h3 class="card-title font-size:100px  text-center text-white">Want to try the world's best cookies?</h3>
            <p class=" text-center text-white text-">Click here for a step by step recipe</p>
          </div>
        </div>

      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>



    <!--warning-->



    <div class="alert alert-warning my-5" role="alert">
      Warning!
      <h5 class="card-text">In accordance with the new government regulations, please note that our Québec stores
        opening hours have changed. For more details, please contact your local grocer.</h5>
      <a href="#" class="btn btn-primary">More information</a>
    </div>





    <!-- advertising-->


    <div class="row row-cols-1 row-cols-md-2 g-4">

      <div class="col">
        <div class="card">
          <img src="https://dummyimage.com/400x400 class=" card-img-top img-fluid" alt="...">
          <div class="card-body">
            <h5 class="card-title">PROMOTION OF THE WEEK : CHIPS 2 FOR 1 </h5>
            <p class="card-text">450 g</p>
            <p class="card-text">$5.99</p>
            <a href="#" class="btn btn-primary">Add to cart</a>
          </div>
        </div>
      </div>



      <div class="col">
        <div class="card">
          <img src="https://dummyimage.com/400x400" class="card-img-top img-fluid" alt="...">
          <div class="card-body">
            <h5 class="card-title">Candian chicken thighs</h5>
            <p class="card-text">4 chicken thighs (approx. 750g)</p>
            <p class="card-text">6.89/unit</p>
            <a href="#" class="btn btn-primary">Add to cart</a>
          </div>
        </div>
      </div>


      <div class="col">
        <div class="card">
          <img src="https://dummyimage.com/400x400" class="card-img-top img-fluid" alt="coffee bag">
          <div class="card-body">
            <h5 class="card-title">No-Name coffee</h5>
            <p class="card-text">453 g</p>
            <p class="card-text">$18.99</p>
            <a href="#" class="btn btn-primary">Add to cart</a>
          </div>
        </div>
      </div>




      <div class="col">
        <div class="card">
          <img src="https://dummyimage.com/400x400" class="card-img-top img-fluid" alt="juice bottles">
          <div class="card-body">
            <h5 class="card-title">Assorted Flavour Juice</h5>
            <p class="card-text">1 L</p>
            <p class="card-text">$4.99</p>
            <a href="#" class="btn btn-primary">Add to cart</a>
          </div>
        </div>

      </div>
    </div>




  </div>


  <!--footer-->

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





</body>
<script src="/js/js.js"></script>

</html>