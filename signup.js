function myFunction() {
    var x = document.getElementById("validationPassword");

    if (x.type === "password") {
        x.type = "text";
    } 
    else {
        x.type = "password";
    }
  }
