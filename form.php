<!-- Form Validation -->
<?php
session_start();
$username =  $_SESSION['user'];
$conn = new mysqli('localhost', 'root', '', 'project_rti_portal');
$query = "SELECT * FROM users WHERE username='".$username."'"; 
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$name = $row['name'];

    if(isset($_POST['SubmitButton'])){
      // Personal Details
      $age = $_POST['age'];
      $sex = $_POST['Sex'];
      $bpl= $_POST['BPL'];
      $language = $_POST['Language'];

      // Contact Details
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      
      // Residential Address
      $address = $_POST['address'];
      $state = $_POST['state'];
      $district = $_POST['district'];
      $pincode = $_POST['pinCode'];

      // Request Text
      $dept = $_POST['dept'];
      $request = $_POST['request'];
      
      $conn = new mysqli('localhost', 'root', '', 'project_rti_portal');
      if($conn->connect_error){
        echo "$conn->connect_error";
        die("Connection Failed : ".$conn->connect_error);
      }

      else{
          $statement = $conn->prepare("Insert into complaint (username, name, age, sex, bpl, language, email, phone, street, state, district, pin_code, dept, request) Values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
          $statement->bind_param("ssssssssssssss", $username, $name, $age, $sex, $bpl, $language, $email, $phone, $address, $state, $district, $pincode, $dept, $request);
          $execval = $statement->execute();
          $statement->close();
          $conn->close();

          header("Location: Index.html");
        }
    }

    if(isset($_POST['logout'])) {
      unset($_SESSION['user']);
      header("Location: Index.html");
    }
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>

    <!--External CSS-->
    <link rel="stylesheet" href="index.css">

    <!-- Javascript File -->
    <script src="form.js" type="text/javascript"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- Font Awesome Icon-->
    <script src="https://kit.fontawesome.com/03801c7b15.js" crossorigin="anonymous"></script>

    <style>
      .placeicon{
          font-family: Arial, FontAwesome;
      }
    </style>
</head>

<body style="background-color: #f1faee">
    <!--Nav Bar-->
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <span class="navbar-brand mb-0 h1">
        <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.wvba.com%2Fimages%2FInfo-I-Logo.png&f=1&nofb=1" width="30" height="25" class="d-inline-block align-top" loading="lazy">
         RTI</span>
        
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-center">
            <li class="nav-item">
              <a class="nav-link" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.html">Objectives</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.html">Statistics</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">Form <b><span class="sr-only">(current)</span></b></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#footer">Contact Us</a>
            </li>
          </ul>

          <form class="d-flex ms-lg-5 justify-content-center" method="post">
            <button class="btn btn-outline-danger" type="submit" name="logout">Logout</button>
          </form>

        </div>
    </div>
  </nav>


  <form class="container col-lg-8 col-md-10 col-sm-12" method="post">
    <div class="h1 py-4 text-center">Online RTI Application</div>

    <!-- Personal Details -->
    <div class="col-12 mx-auto border border-primary rounded-3 bg-primary text-dark bg-opacity-10 m-2 p-2">
      <div class="h3 ms-4 my-2">Personal Details</div>
      
      <div class="row row-cols-4 mb-3">
        <!-- User ID -->
        <div class="col-lg-2 col-md-2 col-sm-4 d-flex flex-row-reverse">
            <label for="UserID" class="col-form-label">Username: </label>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <input type="text" id="UserID" name="userID" class="form-control placeicon" value="<?php echo $_SESSION['user']?>" disabled>
        </div>
    

        <!-- Name -->
        <div class="col-lg-2 col-md-2 col-sm-4 d-flex flex-row-reverse">
            <label for="Name" class="col-form-label">Name: </label>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <input type="text" class="form-control" id="Name" name="name" value="<?php echo $name?>" disabled>
        </div>
      </div>

      <div class="row row-cols-4 my-2 align-items-center">
        <!-- Age -->
        <div class="col-lg-2 col-md-2 col-sm-4 d-flex flex-row-reverse">
            <label for="Age" class="col-form-label">Age: </label>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <input type="number" class="form-control" id="Age" name="age" required>
        </div>


        <!-- Sex -->
        <div class="col-lg-3 col-md-3 col-sm-4 d-flex flex-row-reverse">
            <label for="Sex" class="form-label">Sex: </label>
        </div>
        <div class="col-auto">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="Sex" id="inlineRadio1" value="Male"  onclick="required('validationSex')" required>
              <label class="form-check-label" for="inlineRadio1">Male</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="Sex" id="inlineRadio2" value="Female"  onclick="required('validationSex')" required>
              <label class="form-check-label" for="inlineRadio2">Female</label>
            </div>
        </div>
      </div>

      <div class="row row-cols-4 my-2 align-items-center">
        <!-- BPL -->
        <div class="col-lg-2 col-md-2 col-sm-4 d-flex flex-row-reverse">
            <label for="BPL" class="form-label">Are you BPL: </label>
        </div>
        <div class="col-lg-3 col-md-5 col-sm-6">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="BPL" id="inlineRadio1" value="Yes"  onclick="required('validationSex')" required>
              <label class="form-check-label" for="inlineRadio1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="BPL" id="inlineRadio2" value="No"  onclick="required('validationSex')" required>
              <label class="form-check-label" for="inlineRadio2">No</label>
            </div>
        </div>

        <!-- Language -->
        <div class="col-lg-2 col-md-2 col-sm-4 d-flex flex-row-reverse">
          <label for="Language" class="col-form-label">Language: </label>
        </div>
        <div class="col-lg-3 col-md-5 col-sm-6">
          <select class="form-select" id="Language" name="Language" required>
            <option selected disabled value="">(Please select a choice)</option>
            <option>English</option>
            <option>Hindi</option>
            <option>Tamil</option>
            <option>Bengali</option>
          </select>
        </div>
      </div>

    </div>

    <!-- Contact Details -->
    <div class="col-12 mx-auto border border-warning rounded-3 bg-warning text-dark bg-opacity-10 m-2 p-2 mt-3">
    <div class="h3 ms-4 my-2">Contact Details</div>

    <!-- EMail -->
      <div class="row row-cols-2 my-3">
        <div class="col-lg-2 col-md-2 col-sm-4 d-flex flex-row-reverse">
          <label for="Email" class="col-form-label">Email: </label>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-7">
          <input type="email" class="form-control placeicon notranslate" id="Email" name="email" placeholder="&#xf0e0" required>
        </div>
      </div>

      <!-- Phone -->
      <div class="row row-cols-2 my-3">
        <div class="col-lg-2 col-md-2 col-sm-4 d-flex flex-row-reverse">
          <label for="phone" class="col-form-label">Mobile Number: </label>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-7">
          <input type="number" class="form-control placeicon notranslate" id="phone" name="phone" placeholder="&#xf879" required>
        </div>
      </div>

    </div>
    

    <!-- Residential Address -->
    <div class="col-12 mx-auto border border-success bg-success text-dark bg-opacity-10 rounded-3 m-2 p-2 mt-3">
      <div class="h3 ms-4 my-2">Residential Address</div>

      <!-- Address Line -->
      <div class="row row-cols-2 my-3">
        <div class="col-lg-2 col-md-2 col-sm-4 d-flex flex-row-reverse">
          <label for="Address" class="col-form-label">Address:</label>
        </div>
        <div class="col-lg-8 col-md-7 col-sm-7">
          <input type="text" id="Address" class="form-control" name="address" required>
        </div>
      </div>

      <!-- State -->
      <div class="row row-cols-4 my-3">
        <div class="col-lg-2 col-md-2 col-sm-4 d-flex flex-row-reverse">
          <label for="State" class="col-form-label">State: </label>
        </div>
        <div class="col-lg-3 col-md-5 col-sm-7">
          <select class="form-select" id="State" name="state" required>
            <option selected disabled value="">(Please select a state)</option>
            <option>Maharashtra</option>
            <option>Delhi</option>
            <option>Uttar Pradesh</option>
            <option>Madhya Pradesh</option>
            <option>Tamil Nadu</option>
            <option>Assam</option>
          </select>
        </div>

        <!-- District -->
        <div class="col-lg-2 col-md-2 col-sm-4 d-flex flex-row-reverse">
          <label for="District" class="col-form-label">District: </label>
        </div>
        <div class="col-lg-3 col-md-5 col-sm-7">
          <select class="form-select" id="District" name="district" required>
            <option selected disabled value="">(Please select a district)</option>
            <option>Mumbai</option>
            <option>Nagpur</option>
            <option>Nashik</option>
            <option>Kolhapur</option>
            <option>Jalgaon</option>
            <option>Aurangabad</option>
          </select>
        </div>
      </div>

      <!-- Pin Code -->
      <div class="row row-cols-2 my-3">
        <div class="col-lg-2 col-md-2 col-sm-4 d-flex flex-row-reverse">
          <label for="Pin Code" class="col-form-label">Pin Code: </label>
        </div>
        <div class="col-lg-3 col-md-5 col-sm-7">
          <input type="number" class="form-control" id="Pin Code" name="pinCode" required>
        </div>
      </div>

    </div>
    

    <!-- Application Details -->
    <div class="col-12 mx-auto border border-dark rounded-3 bg-dark text-dark bg-opacity-10 m-2 p-2 mt-3">
      <div class="h3 ms-4 my-2">Application Form</div>

      <!-- Department -->
      <div class="row row-cols-2 my-3">
        <div class="col-lg-2 col-md-2 col-sm-4 d-flex flex-row-reverse">
          <label for="Department" class="col-form-label">Department: </label>
        </div>
        <div class="col-lg-5 col-md-7 col-sm-7">
          <select class="form-select" id="Departement" name="dept" required>
            <option selected disabled value="">(Please select a dept)</option>
            <option>Department of Atomic Energy</option>
            <option>Department of Defence</option>
            <option>Department of Education</option>
            <option>Department of Health and Family Affairs </option>
            <option>Department of Legal Affairs</option>
            <option>Department of Space</option>
          </select>
        </div>
      </div>

      <!-- Text Area -->
      <div class="row row-cols-2 mt-3">
        <div class="col-lg-2 col-md-2 col-sm-4 d-flex flex-row-reverse">
          <label for="About" class="col-form-label">Request Text:</label>
        </div>
        <div class="col-lg-8 col-md-7 col-sm-7">
          <textarea class="form-control" id="About" rows="4" name="request" required></textarea>
        </div>
      </div>

      <!-- Supporting Doc -->
      <div class="mx-5 mb-3 col-6">
        <label for="formFile" class="col-form-label">Upload Supporting Documents : </label>
        <input class="col-lg-5 col-md-auto form-control" type="file" id="formFile">
      </div>
    </div>
  </div>


    <div class="col-12 text-center">
      <input id="checkbox" class="my-3" type="checkbox" required/>
      <label for="checkbox"> I agree to these <a href="#">Terms and Conditions</a>.</label><br>
      <button class="btn btn-primary mb-5" type="submit" name="SubmitButton">Submit RTI Request</button>
    </div>
  </form>

  <footer id="footer">
      <div class="container">
        <div class="text-center s1">
          <h1 >RTI Portal</h1>
          <p>now you can challenge corruption</p>
          <br>
        </div>

        <div class="row justify-content-around mb-5">
          <p class="col-md-3 col-sm-6 m-3">For any queries, Contact Below<br>
            <a href="mailto:helprtionline-dopt@nic.in" class="link"><i class="fas fa-envelope query me-2"></i>helprtionline-dopt@nic.in<br></a>
            <i class="fas fa-phone-alt query me-2"></i>Toll Free No: 011-2462 2461
            <a id="google_translate_element" class="mt-1 ps-3"></a>
          </p>

          <p class="col-md-3 col-sm-6 text-center mb-5 m-3">Follow us for more updates
            <br><a href="https://twitter.com/rtiindia"><i class="fab fa-twitter fa-2x p-2"></i></a>
                <a href="https://facebook.com/rtiindia.org/"> <i class="fab fa-facebook fa-2x p-2"></i></a>
                <a href="#"> <i class="fab fa-instagram fa-2x p-2"></i></a>
          </p>

          <p class="col-md-3 col-sm-6 text-center pt-3">
            <a class="link mb-3" href="#">FAQ</a><br>
            <a class="link mb-3" href="https://india.gov.in" target="_blank" rel="noopener noreferrer">National Portal of India</a><br>
            <a class="link" href="https://mhrd.ap.gov.in/MHRD/login.do" target="_blank" rel="noopener noreferrer">MHRD</a>
          </p>
      </div>
    </footer>

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
