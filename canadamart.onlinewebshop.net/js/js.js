var itemCount = JSON.parse(getCookie("items"));
document.getElementById("ci-count").innerHTML = itemCount.length;

// Get a cookie value by its name
function getCookie(name) {
  return (document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)')?.pop() || '');
}