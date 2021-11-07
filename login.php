<!-- Log In Page -->

<?php
session_start();
$alertMessage = "";

if(isset($_POST['SubmitButton'])){
    $username = $_POST['validationUsername'];
    $password = $_POST['validationPassword'];
    $_SESSION['user'] = $username;

    $conn = mysqli_connect("localhost", "root", "", "project_rti_portal");
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='".$username."'");  
    $count = mysqli_num_rows($query); 
    
    if($count==0)  {
        $alertMessage = "This username is not registered..! Create a new account";
    } 

    else {
        $query = mysqli_query($conn, "SELECT * FROM users WHERE username='".$username."' and password='".$password."'");  
        $count = mysqli_num_rows($query);

        if ($count==0){
          $alertMessage = "Incorrect Password..! Please try again";
        }
        else{
          header("Location: Form.php");
        }    
    }     
} 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn - RTI Portal</title>
    <link rel="icon" href="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.wvba.com%2Fimages%2FInfo-I-Logo.png&f=1&nofb=1" type="image/png" width="30" height="25">

    <!-- Javascript File -->
    <script src="signup.js" type="text/javascript"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- Font Awesome Icon-->
    <script src="https://kit.fontawesome.com/03801c7b15.js" crossorigin="anonymous"></script>

</head>

<body>
<form class="container col-lg-5 col-md-8 col-sm-11" method="post" style="background-color: #D4F2D2;">
    <div class="h1 py-4 text-center">Log In</div>

    <!-- Username -->
    <div class="row row-cols-2 mb-3">
      <div class="col-4 d-flex flex-row-reverse">
        <label for="validationUsername" class="col-form-label">Username: </label>
      </div>
      <div class="col-5">
        <input type="text" id="validationUsername" name="validationUsername" class="form-control placeicon notranslate" minlength="5" maxlength="12" placeholder="&#xf007;" required>
      </div>
    </div>

    <!-- Password -->
    <div class="row row-cols-2 my-3">
      <div class="col-4 d-flex flex-row-reverse">
        <label for="validationPassword" class="col-form-label">Password: </label>
      </div>
      <div class="col-5">
        <input type="password" id="validationPassword" name="validationPassword" class="form-control placeicon notranslate" minlength="7" maxlength="12" placeholder="&#xf023;" required>
        <div><input class="col-2" type="checkbox" onclick="myFunction()">Show Password</div>
      </div>
    </div>


    <div class="col-12 text-center">
    <p class="text-danger fw-bold"> <?php echo $alertMessage?></p>
      <button class="btn btn-primary mb-2" type="submit" name="SubmitButton" >Submit</button>
      <p class="text-muted pb-4">Forgot Password? <a href="#"> Reset</a><br>
                            Don't have an account? <a href="signup.php"> Sign Up</a></p>
    </div>
  </form>

    <div class="container col-lg-4 col-md-8 col-sm-10 footer p-3">
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
