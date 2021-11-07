<!-- Sign Up Page -->

<?php
  $alertMessage = "";

  if(isset($_POST['SubmitButton'])){
    $name = $_POST['validationName'];
    $username = $_POST['validationUsername'];
    $password = $_POST['validationPassword'];
    $email = $_POST['validationEmail'];
    $country = $_POST['validationCountry'];
    
    $conn = new mysqli('localhost', 'root', '', 'project_rti_portal');
    if($conn->connect_error){
      echo "$conn->connect_error";
      die("Connection Failed : ".$conn->connect_error);
    }

    else{
      // Username Validation
      $query = mysqli_query($conn, "SELECT * FROM users WHERE username='".$username."'");  
      $count = mysqli_num_rows($query); 
      
      if($count!=0)  {  
        $alertMessage = "Username already exists..! Please enter another username";
      }
      else{ 
        // Password validation
        if(!preg_match("#[0-9]+#", $password)) {
          $alertMessage = "Password must contain atleast one number!";
        }
        elseif(!preg_match("#[A-Z]+#", $password)) {
          $alertMessage = "Password must contain atleast one Capital Letter!";
        }
        elseif(!preg_match("#[a-z]+#", $password)) {
          $alertMessage = "Password must contain atleast one Small Letter"; 
        }
        elseif(!preg_match("'/[\'^£$%&*()}{@#~?><>,|=_+¬-]/'", $password)) {
          $alertMessage = "Password must contain atleast one special character";
        }

        // Correct Credentials
        else{
          $statement = $conn->prepare("Insert into users(name, username, password, email, country) Values(?, ?, ?, ?, ?)");
          $statement->bind_param("sssss", $name, $username, $password, $email, $country);
          $execval = $statement->execute();
          $statement->close();
          $conn->close();

          header("Location: login.php");
        }
      }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <title>Sign Up - RTI Portal</title>
    <link rel="icon" href="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.wvba.com%2Fimages%2FInfo-I-Logo.png&f=1&nofb=1" type="image/png" width="30" height="25">

    <!-- External CSS File -->
    <link type="stylesheet" href="signup.css">
  
    <!-- Javascript File -->
    <script src="SignUp.js" type="text/javascript"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- Font Awesome Icon-->
    <script src="https://kit.fontawesome.com/03801c7b15.js" crossorigin="anonymous"></script>
  
</head>

<body>
  <form class="container col-lg-5 col-md-8 col-sm-11 mt-4" style="background-color: #D4F2D2;" method="post">
    <div class="h1 py-4 text-center">Sign Up</div>

    <!-- Name -->
    <div class="row row-cols-2 my-3">
      <div class="col-3 d-flex flex-row-reverse">
        <label for="validationName" class="col-form-label">Name: </label>
      </div>
      <div class="col-6">
        <input type="text" class="form-control" id="validationName" name="validationName" required
              oninvalid="setCustomValidity(\'Please enter alphabets only\'\)">
      </div>
    </div>

    <!-- User ID -->
    <div class="row row-cols-2 mb-3">
      <div class="col-3 d-flex flex-row-reverse">
        <label for="validationUsername" class="col-form-label">Username: </label>
      </div>
      <div class="col-4">
        <input type="text" id="validationUsername" name="validationUsername" class="form-control placeicon notranslate" aria-describedby="usernameHelpInline" minlength="5" maxlength="12" placeholder="&#xf007;" required>
      </div>
      <div class="col-auto">
        <span id="usernameHelpInline" class="form-text"><i class="fas fa-info-circle pe-2"></i>Must be 5-12 characters long</span>
      </div>
    </div>

    <!-- Password -->
    <div class="row row-cols-2 my-3">
      <div class="col-3 d-flex flex-row-reverse">
        <label for="validationPassword" class="col-form-label">Password: </label>
      </div>
      <div class="col-4">
        <input type="password" id="validationPassword" name="validationPassword" class="form-control placeicon notranslate" aria-describedby="passwordHelpInline" minlength="7" maxlength="12" placeholder="&#xf023;" required />
        <div><input class="col-2" type="checkbox" onclick="myFunction()">Show Password</div>
      </div>
      <div class="col-auto">
        <span id="passwordHelpInline" class="form-text"><i class="fas fa-info-circle pe-2"></i>Must be 7-12 characters long</span>
      </div>
    </div>

    <!-- Email ID -->
    <div class="row row-cols-2 my-3">
      <div class="col-3 d-flex flex-row-reverse">
        <label for="validationEmail" class="col-form-label">Email: </label>
      </div>
      <div class="col-6">
        <i class="glyphicon glyphicon-user"></i>
        <input type="email" class="form-control placeicon" id="validationEmail" name="validationEmail"> <!--placeholder="&#xf0e0" -->
      </div>
    </div>

    <!-- Country -->
    <div class="row row-cols-2 my-3">
      <div class="col-3 d-flex flex-row-reverse">
        <label for="validationCountry" class="col-form-label">Country: </label>
      </div>
      <div class="col-auto">
        <select class="form-select" id="validationCountry" name="validationCountry" required>
          <option selected disabled value="">(Please select a country)</option>
          <option>India</option>
          <option>Russia</option>
          <option>United States of America</option>
          <option>United Kingdom</option>
        </select>
      </div>
    </div>

    <!-- Language -->
    <div class="row row-cols-2 my-3">
      <div class="col-3 d-flex flex-row-reverse">
        <label for="validationLanguage" class="form-label">Language: </label>
      </div>
      <div class="col-auto">
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="validationLanguage" id="inlineCheckbox1" value="English" required>
          <label class="form-check-label" for="inlineCheckbox1">English</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="validationLanguage" id="inlineCheckbox2" value="Non-English" required>
          <label class="form-check-label" for="inlineCheckbox2">Hindi</label>
        </div>
      </div>
    </div>


    <div class="col-12 text-center">
      <p class="text-danger fw-bold"> <?php echo $alertMessage?></p>
      <button class="btn btn-primary mb-2" type="submit" name="SubmitButton" onclick="required(CheckPassword())">Submit</button>
      <p class="text-muted pb-4">Already have an account? <a href="login.php">Login</a></p>
    </div>
  </form>

    <div class="container col-lg-4 col-md-8 col-sm-12 footer p-3 mb-4">
      <div class="text-center s1">
        <h1 >RTI Portal</h1>
        <p>now you can challenge corruption</p>
      </div>
    </div>

    <!-- Scripts for JQuery, Popper and Bootstrap -->
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" 
              integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" 
              integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>

    <!-- Google Translate API -->
    <script type="text/javascript">// <![CDATA[
      function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'en' , includedLanguages : 'en,hi,ta,gu,bn,mr'}, 'google_translate_element');
      }
      // ]]></script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>

    
</body>
</html>
