// The number of items
var itemCount = document.querySelectorAll('#item-container>.row').length;
document.getElementById("item-count").innerHTML = itemCount;

if (getCookie("items").length > 2) {
  fillInDt();
}

// Fill the inputs and other elements with saved data
function fillInDt() {
  for (let i = 0; i < getCookie("items").length; i++) {
    let itemNumber = JSON.parse(getCookie("quantities"))[i];
    let quantity = sessionStorage.getItem(itemNumber)[0];
    let price = parseFloat(sessionStorage.getItem(itemNumber).substring(2,));
    document.getElementById("ci-" + itemNumber + "-q").value = quantity;
    document.getElementById("ci-" + itemNumber + "-p").innerHTML = price;
    subtotal += price;
  }
  document.getElementById("subtotal").innerHTML = Math.round(subtotal * 100) / 100;;
  updateTotal();
}

// Increase quantity
function increaseQty(el) {
  let itemNumber = el.split("-")[1];
  let quantityField = document.getElementById("ci-" + itemNumber + "-q");
  let quantity = quantityField.value;
  quantity++;
  quantityField.value = quantity;
  let updatedPrice = parseFloat(document.getElementById("ci-" + itemNumber + "-p").innerHTML) + priceList[itemNumber - 1];
  updatedPrice = document.getElementById("ci-" + itemNumber + "-p").innerHTML = Math.round(updatedPrice * 100) / 100;
  sessionStorage.setItem(itemNumber, [quantity, updatedPrice]);
  subtotal += priceList[itemNumber - 1];
  document.getElementById("subtotal").innerHTML = Math.round(subtotal * 100) / 100;
  updateTotal();
}

// Decrease quantity
function decreaseQty(el) {
  let itemNumber = el.split("-")[1];
  let quantityField = document.getElementById("ci-" + itemNumber + "-q");
  let quantity = quantityField.value;
  let updatedPrice = 0;
  if (quantity >= 0 && quantity < 1) {
    alert("You can't have a negative quantity");
    return;
  } else {
    quantity--;
    quantityField.value = quantity;
    sessionStorage.setItem(itemNumber, quantity);
    updatedPrice = parseFloat(document.getElementById("ci-" + itemNumber + "-p").innerHTML) - priceList[itemNumber - 1];
  }
  document.getElementById("ci-" + itemNumber + "-p").innerHTML = Math.round(updatedPrice * 100) / 100;
  sessionStorage.setItem(itemNumber, [quantity, updatedPrice]);
  subtotal -= priceList[itemNumber - 1];
  document.getElementById("subtotal").innerHTML = Math.round(subtotal * 100) / 100;
  updateTotal();
}

// Get current quantity
function getCurrentQty(el) {
  let itemNumber = el.split("-")[1];
  currentQty = document.getElementById("ci-" + itemNumber + "-q").value;
}

// Illegal input
function changeQty(el) {
  let itemNumber = el.split("-")[1];
  let quantityField = document.getElementById("ci-" + itemNumber + "-q");
  let quantity = quantityField.value;
  if (quantity < 0) {
    quantity = 0;
    quantityField.value = quantity;
    alert("Are you stupid?");
  }
  let changedVal = priceList[itemNumber - 1] * quantity;
  document.getElementById("ci-" + itemNumber + "-p").innerHTML = Math.round(changedVal * 100) / 100;
  subtotal -= currentQty * priceList[itemNumber - 1];
  subtotal += Math.round(changedVal * 100) / 100;
  sessionStorage.setItem(itemNumber, [quantity, changedVal]);
  document.getElementById("subtotal").innerHTML = Math.round(subtotal * 100) / 100;
  updateTotal();
}

// Delete item
function deleteItm(el) {
  let itemNumber = el.split("-")[1];
  let quantityField = document.getElementById("ci-" + itemNumber + "-q");
  let quantity = quantityField.value;
  subtotal -= quantity * priceList[itemNumber - 1];
  document.getElementById("subtotal").innerHTML = Math.round(subtotal * 100) / 100;
  updateTotal();
  itemCount--;
  document.getElementById("item-count").innerHTML = itemCount;
  document.getElementById("ci-" + itemNumber).remove();
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
  document.cookie = name + "=" + value;
}