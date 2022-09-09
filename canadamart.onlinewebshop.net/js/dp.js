var items, quantities, quantity, itemIndex;
var quantityField = document.getElementById("quantity");

if (document.cookie) {
  if (getCookie("items").length > 2) {
    // Item(s) exist
    items = JSON.parse(getCookie("items"));
    quantities = JSON.parse(getCookie("quantities"));
    itemIndex = items.indexOf(productID);
    if (itemIndex > -1) {
      // Current item found in the array
      quantity = quantities[itemIndex];
    } else {
      // Current item NOT found in the array
      quantity = 0;
    }
  } else {
    // No item exists
    items = [];
    quantities = [];
    quantity = 0;
  }
} else {
  // No item exists
  items = [];
  quantities = [];
  quantity = 0;
}

// Set the quantity value
quantityField.value = quantity;

// Increase quantity
document.getElementById("increase-btn").onclick = function () {
  quantity++;
  quantityField.value = quantity;
};

// Decrease quantity
document.getElementById("decrease-btn").onclick = function () {
  if (quantity >= 0 && quantity < 1) {
    alert("You can't have a negative quantity");
    return;
  } else {
    quantity--;
    quantityField.value = quantity;
  }
};

// Manual input
function changeQty() {
  quantity = parseInt(quantityField.value);
  if (quantity < 0) {
    quantity = 0;
    quantityField.value = quantity;
    alert("Are you stupid?");
  }
};

// Add to cart
document.getElementById("add-to-cart").onclick = function () {
  if (quantity > 0) {
    if (itemIndex > -1) {
      // item was in the cookie
      quantities[itemIndex] = quantity;
      setCookie("quantities", JSON.stringify(quantities));
    } else {
      items.push(productID);
      quantities.push(quantity);
      setCookie("items", JSON.stringify(items));
      setCookie("quantities", JSON.stringify(quantities));
    }
    let toastEl = document.querySelector(".toast");
    new bootstrap.Toast(toastEl).show();
  } else {
    alert("Minimum quantity is 1 for this item");
  }
};

// Get a cookie value by its name
function getCookie(name) {
  return (document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)')?.pop() || '');
}

// Set cookies
function setCookie(name, value) {
  document.cookie = name + "=" + value + ";path=/";
}

// Show details using Ajax
document.getElementById("details").onclick = function () {
  document.querySelector(".tab-content .show").scrollIntoView();
  new bootstrap.Tab(document.querySelector('#nav-tab a:nth-child(2)')).show();

  let isLoaded = false;
  if (!isLoaded) {
    // Asynchronus loading from server
    let sectionDescription = document.getElementById("description");
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        sectionDescription.innerHTML = this.responseText;
        isLoaded = true;
      }
    };
    xhttp.open("GET", currentDirectory + "description.txt", true);
    xhttp.send();
  };
}