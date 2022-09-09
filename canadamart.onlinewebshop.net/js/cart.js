// The number of items
var itemCount = document.querySelectorAll('#item-container>.row').length;
document.getElementById("item-count").innerHTML = itemCount;

// Variables
var subtotal = 0;
var currentQty = 0;

var items = JSON.parse(getCookie("items"));
var quantities = JSON.parse(getCookie("quantities"));

// Fill the inputs and other elements with saved data
if (getCookie("items").length > 2) {
  for (let i = 0; i < items.length; i++) {
    let itemNumber = items[i];
    let quantity = quantities[i];
    let cost = parseFloat(priceList[i]) * quantity;
    document.getElementById("ci-" + itemNumber + "-q").value = quantity;
    document.getElementById("ci-" + itemNumber + "-p").innerHTML = Math.round(cost * 100) / 100;
    subtotal += cost;
  }
  document.getElementById("subtotal").innerHTML = Math.round(subtotal * 100) / 100;
  updateCartSummary();
}

function updateCartSummary() {
  let gst, qst;
  gst = subtotal * 0.05;
  qst = subtotal * 0.09975;
  document.getElementById("gst").innerHTML = Math.round(gst * 100) / 100;
  document.getElementById("qst").innerHTML = Math.round(qst * 100) / 100;
  document.getElementById("total").innerHTML = Math.round((subtotal + gst + qst) * 100) / 100;
}

// Increase quantity
function increaseQty(el) {
  let productID = parseInt(el.split("-")[1]);
  let itemIndex = items.indexOf(productID);
  let quantityField = document.getElementById("ci-" + productID + "-q");
  let quantity = quantityField.value;
  quantity++;
  quantityField.value = quantity;
  quantities[itemIndex] = quantity;
  setCookie("quantities", JSON.stringify(quantities));
  let itemPrice = priceList[itemIndex];
  let updatedPrice = parseFloat(document.getElementById("ci-" + productID + "-p").innerHTML) + itemPrice;
  document.getElementById("ci-" + productID + "-p").innerHTML = Math.round(updatedPrice * 100) / 100;
  subtotal += itemPrice;
  document.getElementById("subtotal").innerHTML = Math.round(subtotal * 100) / 100;
  updateCartSummary();
}

// Decrease quantity
function decreaseQty(el) {
  let productID = parseInt(el.split("-")[1]);
  let itemIndex = items.indexOf(productID);
  let quantityField = document.getElementById("ci-" + productID + "-q");
  let quantity = quantityField.value;
  if (quantity >= 0 && quantity < 1) {
    alert("You can't have a negative quantity");
    return;
  } else {
    quantity--;
    quantityField.value = quantity;
    quantities[itemIndex] = quantity;
    setCookie("quantities", JSON.stringify(quantities));
    let itemPrice = priceList[itemIndex];
    let updatedPrice = parseFloat(document.getElementById("ci-" + productID + "-p").innerHTML) - itemPrice;
    document.getElementById("ci-" + productID + "-p").innerHTML = Math.round(updatedPrice * 100) / 100;
    subtotal -= itemPrice;
    document.getElementById("subtotal").innerHTML = Math.round(subtotal * 100) / 100;
    updateCartSummary();
  }
}

// Get current quantity
function getCurrentQty(el) {
  let itemNumber = el.split("-")[1];
  currentQty = document.getElementById("ci-" + itemNumber + "-q").value;
}

// Manual input
function changeQty(el) {
  let productID = parseInt(el.split("-")[1]);
  let itemIndex = items.indexOf(productID);
  let quantityField = document.getElementById("ci-" + productID + "-q");
  let quantity = quantityField.value;
  if (quantity < 0) {
    quantity = 0;
    quantityField.value = quantity;
    alert("Are you stupid?");
  }
  quantities[itemIndex] = quantity;
  setCookie("quantities", JSON.stringify(quantities));
  let changedVal = priceList[itemIndex] * quantity;
  document.getElementById("ci-" + productID + "-p").innerHTML = Math.round(changedVal * 100) / 100;
  subtotal -= currentQty * priceList[itemIndex];
  subtotal += Math.round(changedVal * 100) / 100;
  document.getElementById("subtotal").innerHTML = Math.round(subtotal * 100) / 100;
  updateCartSummary();
}

// Delete item
function deleteItm(el) {
  let productID = parseInt(el.split("-")[1]);
  let itemIndex = items.indexOf(productID);
  let quantityField = document.getElementById("ci-" + productID + "-q");
  let quantity = quantityField.value;
  subtotal -= quantity * priceList[itemIndex];
  document.getElementById("subtotal").innerHTML = Math.round(subtotal * 100) / 100;
  updateCartSummary();
  itemCount--;
  document.getElementById("item-count").innerHTML = itemCount;
  document.getElementById("ci-" + productID).remove();
  quantities.splice(itemIndex, 1);
  items.splice(itemIndex, 1);
  priceList.splice(itemIndex, 1);
  setCookie("quantities", JSON.stringify(quantities));
  setCookie("items", JSON.stringify(items));
  if (itemCount == 0) {
    var emptyMsg = document.createElement("div");
    var node = document.createTextNode("(Your cart is empty. Buy something now and pay us extra.)");
    emptyMsg.appendChild(node);
    emptyMsg.classList.add("text-muted");
    document.getElementById("item-container").appendChild(emptyMsg);
    alert("If you don't wanna buy anything, why have you wasted our server resources?");
  }
}

// Get a cookie value by its name
function getCookie(name) {
  return (document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)')?.pop() || '');
}

// Set cookies
function setCookie(name, value) {
  document.cookie = name + "=" + value + ";path=/";
}

// Enable tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl);
})