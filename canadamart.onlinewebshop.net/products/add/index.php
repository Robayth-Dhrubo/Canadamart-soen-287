<?php
session_start();

if (!isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {
  header("Location: /");
}

$name_edit = null;
$Aisle_edit = null;
$description_edit = null;
$type_edit = null;
$storagetype_edit = null;
$brand_edit = null;
$Item_edit = null;
$price_edit = null;
$weight_edit = null;
$nutritionalInfo_edit = null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add a product | Canada Mart</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Fugaz+One&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="http://canadamart.onlinewebshop.net/css/style.css">
  <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

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

  <div class="container">
    <h1>Add a product</h1>
    <?php
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
      $id = $_GET["id"];


      $xml = simplexml_load_file(__DIR__ . "/../../data/products.xml") or die("Error: Cannot create object");
      foreach ($xml->children() as $products) {
        if ($products->id == $id) {
          $name_edit = $products->name;
          $Aisle_edit = $products->Aisle;
          $description_edit = $products->description;
          $type_edit = $products->type;
          $storagetype_edit = $products->storagetype;
          $brand_edit = $products->brand;
          $Item_edit = $products->Item;
          $price_edit = $products->price;
          $weight_edit = $products->weight;
          $nutritionalInfo_edit = $products->nutritionalInfo;
          break;
        }
      }
    }
    if ($image_edit = null || $image_edit = '') {
      $image_edit = 'https://dummyimage.com/200x200';
    }
    ?>
    <form name="product_save" action="" method="POST" class="my-5">
      <!-- Product image -->
      <div class="row mb-3">
        <label class="col-md-3 col-form-label">Product image</label>
        <div class="col-md-9">
          <div class="row gx-5">
            <div class="col-auto">
              <img id="blah" src="https://dummyimage.com/200x200" alt="Product image" class="img-fluid">
            </div>
            <div class="col-auto col-sm-6 col-lg-auto d-flex flex-column justify-content-center">
              <div class="mb-3">
                <label for="productImg" class="form-label">Change image</label>
                <input type="file" onchange="readURL(this);" class="form-control" id="productImg" name="productImg">
              </div>
              <!-- <a href="#" class="btn btn-outline-secondary mb-3">Change</a> -->
              <a href="#" class="btn btn-outline-danger" onclick="changeImage();">
                <i class="bi bi-trash"></i>
                Remove</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Brand name -->
      <div class="row mb-3">
        <label for="brand" class="col-md-3 col-form-label">Brand name</label>
        <div class="col-md-9 col-xxl-8">
          <input type="text" class="form-control" id="brand" value="<?php echo $brand_edit; ?>" name="brand">
        </div>
      </div>
      <!-- Product title -->
      <div class="row mb-3">
        <label for="title" class="col-md-3 col-form-label">Product title</label>
        <div class="col-md-9 col-xxl-8">
          <input type="text" class="form-control" id="title" value="<?php echo $name_edit; ?>" name="title">
        </div>
      </div>
      <!-- Product type -->
      <div class="row mb-3">
        <label for="title" class="col-md-3 col-form-label">Product type</label>
        <div class="col-md-9 col-xxl-8">
          <input type="text" class="form-control" id="type" value="<?php echo $type_edit; ?>" name="type">
        </div>
      </div>
      <!-- Product Aisles -->
      <div class="row mb-3">
        <label for="title" class="col-md-3 col-form-label">Aisle Name</label>
        <div class="col-md-9 col-xxl-8">
          <select name="Aisle" id="Aisle" name="Aisle" aria-label="select Aisle Name" class="form-select">
            <option selected>Select Aisle Name</option>
            <option value="Fruits and Vegetables">Fruits and Vegetables</option>
            <option value="Meat & Poultry">Meat & Poultry</option>
            <option value="Dairy & Eggs">Dairy & Eggs</option>
            <option value="Bread & Bakery">Bread & Bakery</option>
            <option value="Beverages">Beverages</option>
            <option value="Snacks">Snacks</option>
            <option value="Others">Others</option>
          </select>
        </div>
      </div>
      <!-- Product description -->
      <div class="row mb-3">
        <label for="description" class="col-md-3 col-form-label">Product description</label>
        <div class="col-md-9 col-xxl-8">
          <div class="d-flex justify-content-around align-items-center border border-bottom-0 rounded-top bg-light">
            <i class="bi bi-type-bold fs-3"></i>
            <i class="bi bi-type-italic fs-3"></i>
            <i class="bi bi-list-ul fs-3"></i>
            <i class="bi bi-link-45deg fs-3"></i>
          </div>
          <textarea class="form-control border-top-0 rounded-0 rounded-bottom" id="description" name="description" rows="3"></textarea>
        </div>
      </div>
      <!-- Nutritional info -->
      <div class="row mb-3">
        <label for="nutritionalInfo" class="col-md-3 col-form-label">Nutritional info</label>
        <div class="col-md-9 col-xxl-8">
          <div class="d-flex justify-content-around align-items-center border border-bottom-0 rounded-top bg-light">
            <i class="bi bi-type-bold fs-3"></i>
            <i class="bi bi-type-italic fs-3"></i>
            <i class="bi bi-list-ul fs-3"></i>
            <i class="bi bi-link-45deg fs-3"></i>
          </div>
          <textarea class="form-control border-top-0 rounded-0 rounded-bottom" id="nutritionalInfo" name="nutritionalInfo" rows="3"></textarea>
        </div>
      </div>

      <!-- Product weight -->
      <div class="row mb-3">
        <label for="weight" class="col-md-3 col-form-label">Product weight</label>
        <div class="col-md-9 col-xxl-8">
          <input type="text" class="form-control" id="weight" value="<?php echo $weight_edit; ?>" name="weight">
        </div>
      </div>
      <!-- Product price -->
      <div class="row mb-3">
        <label for="price" class="col-md-3 col-form-label">Product price</label>
        <div class="col-md-9 col-xxl-8">
          <input type="number" min="0" step="0.01" pattern="^\d*(\.\d{0,2})?$" class="form-control" id="price" value="<?php echo $price_edit; ?>" name="price">
        </div>
      </div>

      <!-- Diet -->
      <!-- <fieldset class="row mb-3">
          <legend class="col-form-label col-md-3 pt-0">Diet</legend>
          <div class="col-md-9 col-xxl-8">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="diet[]" value='vegan'>
              <label class="form-check-label" for="vegan">Vegan
              </label>              
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="diet[]" value='vegeterain'>
              <label class="form-check-label" for="vegeterain">
                Vegeterain
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="diet[]" value='halal'>
              <label class="form-check-label" for="halal">
                Halal
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="diet[]" value='kosher'>
              <label class="form-check-label" for="kosher">
                Kosher
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="diet[]" value='gluten'>
              <label class="form-check-label" for="gluten">
                Gluten free
              </label>
            </div>
          </div>
        </fieldset> -->
      <!-- Save buttons -->
      <div class="row">
        <div class="col-4 col-md-3 offset-4 offset-md-6">
          <input type="submit" name="submit" class="btn btn-primary w-100" value="Save">
        </div>
      </div>
    </form>
    <?php

    if (isset($_POST['submit'])) {

      if (isset($_GET['update']) && isset($_GET['id'])) {
        $id_val = $_GET['id'];
      } else {
        $id_val = rand(5, 10);
      }

      $result = null;
      $image_val = $_POST['productImg'];
      $Aisle_val = $_POST['Aisle'];
      $brand_val = $_POST["brand"];
      $name_val = $_POST["title"];
      $weight_val = $_POST["weight"];
      $description_val = $_POST["description"];
      $price_val = $_POST["price"];
      $type_val = $_POST["type"];
      $storagetype_val = 'Shelf';
      $nutritionalInfo_val = $_POST["nutritionalInfo"];


      $doc = new DOMDocument();
      $doc->preserveWhiteSpace = false;
      $doc->formatOutput = true;
      $id_matched = false;
      if (isset($_GET['update']) && isset($_GET['id'])) {
        if ($_GET['update'] = true) {
          $doc->load(__DIR__ . "/../../data/products.xml");
          $record = $doc->getElementsByTagName('product');
          foreach ($record as $person) {
            $person_id = $person->getElementsByTagName('id')->item(0)->nodeValue;
            if ($person_id == $_GET['id']) {
              $id_matched = true;
              $person->parentNode->removeChild($person);
              break;
            }
          }
          if ($id_matched == true) {
            $doc->save(__DIR__ . "/../../data/products.xml");
          }
        }
      }

      if ($xml = file_get_contents(__DIR__ . "/../../data/products.xml")) {
        $doc->loadXML($xml, LIBXML_NOBLANKS);

        $root = $doc->getElementsByTagName('products')->item(0);
        $b = $doc->createElement("product");

        $root->insertBefore($b, $root->firstChild);

        $id = $doc->createElement("id");
        $b->appendChild($id);
        $idText = $doc->createTextNode($id_val);
        $id->appendChild($idText);

        $image = $doc->createElement("image");
        $b->appendChild($image);
        $imageText = $doc->createTextNode($image_val);
        $image->appendChild($imageText);

        $Aisle = $doc->createElement("Aisle");
        $b->appendChild($Aisle);
        $AisleText = $doc->createTextNode($Aisle_val);
        $Aisle->appendChild($AisleText);

        $brand = $doc->createElement("brand");
        $b->appendChild($brand);
        $brandText = $doc->createTextNode($brand_val);
        $brand->appendChild($brandText);

        $name = $doc->createElement("name");
        $b->appendChild($name);
        $nameText = $doc->createTextNode($name_val);
        $name->appendChild($nameText);

        $weight = $doc->createElement("weight");
        $b->appendChild($weight);
        $weightText = $doc->createTextNode($weight_val);
        $weight->appendChild($weightText);


        $description = $doc->createElement("description");
        $b->appendChild($description);
        $descriptionText = $doc->createTextNode($description_val);
        $description->appendChild($descriptionText);

        $nutritionalInfo = $doc->createElement("nutritionalInfo");
        $b->appendChild($nutritionalInfo);
        $nutritionalInfoText = $doc->createTextNode($nutritionalInfo_val);
        $nutritionalInfo->appendChild($nutritionalInfoText);

        $price = $doc->createElement("price");
        $b->appendChild($price);
        $priceText = $doc->createTextNode($price_val);
        $price->appendChild($priceText);

        $type = $doc->createElement("type");
        $b->appendChild($type);
        $typeText = $doc->createTextNode($type_val);
        $type->appendChild($typeText);

        $storagetype = $doc->createElement("storagetype");
        $b->appendChild($storagetype);
        $storagetypeText = $doc->createTextNode($storagetype_val);
        $storagetype->appendChild($storagetypeText);
      }
      $doc->save(__DIR__ . "/../../data/products.xml");
      //$result='<div class="alert alert-success">Save Successful! I will be in touch</div>';
      if (isset($_GET['update']) && isset($_GET['id'])) {
    ?>
        <script type="text/javascript">
          window.location = "http://localhost/products/index.php";
        </script>
    <?php
      }
      echo '<div class="col-sm-10 col-sm-offset-2"><div class="alert alert-success">Save Successful! I will be in touch</div></div>';
    }

    ?>
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
<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#blah')
          .attr('src', e.target.result)
          .width(200)
          .height(200);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }

  function changeImage() {
    var img = document.getElementById("blah");
    img.src = "https://dummyimage.com/200x200";
    $("#productImg").val(null);
    return false;
  }
</script>

</html>