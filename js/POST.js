// zaladuj zawartosc strony 
function loadDoc(sub_id, cat_id = 1) {
  var xhttp = new XMLHttpRequest();
  messsage = "sub_id=".concat(sub_id.toString(),"&cat_id=",cat_id.toString());
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
	
      document.getElementById("container").innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "content.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(messsage);
}
// zaloguj się
// opsługa przyciku w nagłówku
function SigInbutton() {
  var xhttp = new XMLHttpRequest();
  var name = "";
  var email = "";
  var pass = "";
  messsage = "name=".concat(name,"&email=",email,"&pass=",pass);
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
	
      document.getElementById("container").innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "register.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(messsage);
}
// Zejestru się na stronie
function SigIn() {
  var xhttp = new XMLHttpRequest();
  var name = document.forms["sigIn"]["name"].value;
  var email = document.forms["sigIn"]["email"].value;
  var pass = document.forms["sigIn"]["pass"].value;
  messsage = "name=".concat(name,"&email=",email,"&pass=",pass);
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
	
      document.getElementById("container").innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "register.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(messsage);
}