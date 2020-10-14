var timer = 0;
function set_interval() {
  timer = setInterval("auto_logout()", 10000);
}

function reset_interval() {
  if (timer != 0) {
    clearInterval(timer);
    timer = 0;
    timer = setInterval("auto_logout()", 10000);
  }
}

function auto_logout() {
  window.location = window.location.origin + "/MeTube/index.php/Login/logout";
  alert("You have been logged out due to inactivity");
}