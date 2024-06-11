function logoutDet() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "logoutcred.php", true);

  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
      // Optional: Perform any actions upon successful logout
      console.log("Logout successful");
      location.href="Login.php";
    }
  };

  xmlhttp.send();
}