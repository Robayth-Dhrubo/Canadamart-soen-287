var quantityField = document.getElementById("quantity");

if (document.body.contains(document.getElementById("cart-summary"))) {
  // This is the Cart page
  alert("cart page");
  var itemCount, subtotal = 0, currentQty = 0;

  // The number of items
  itemCount = document.querySelectorAll('#item-container>.row').length;
  document.getElementById("item-count").innerHTML = itemCount;
  updateTotal();
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

// Illegal input
function changeQty() {
  quantity = quantityField.value;
  if (quantity < 0) {
    quantity = 0;
    quantityField.value = quantity;
    alert("Are you stupid?");
  }
};

// Calculate gst, qst and total
function updateTotal() {
  let gst, qst;
  gst = subtotal * 0.05;
  qst = subtotal * 0.09975;
  document.getElementById("gst").innerHTML = Math.round(gst * 100) / 100;
  document.getElementById("qst").innerHTML = Math.round(qst * 100) / 100;
  document.getElementById("total").innerHTML = Math.round((subtotal + gst + qst) * 100) / 100;
}

// Get a cookie value by its name
function getCookie(name) {
  return (document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)')?.pop() || '');
}

// Set cookies
function setCookie(name, value) {
  document.cookie = name + "=" + value;
}

// Enable tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl);
})

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