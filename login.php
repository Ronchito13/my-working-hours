<?php
   include 'functions/config/config.php';
   session_start();
   $error = "";   
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $u_email = mysqli_real_escape_string($db,$_POST['inputEmail']);
      $u_pass = mysqli_real_escape_string($db,$_POST['inputPassword']); 
      
      $sql = "SELECT u_email FROM management_users WHERE u_email = '$u_email' and u_pass = '$u_pass'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      // $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {         
         $_SESSION['login_user'] = $u_email;           
         header("location: index.php");
        } else {
         $error = "Your Login Name or Password is invalid";
         }
   }
   
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container loginBanner">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0" style="height: 460px;">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                  </div>
                  <form action="" method="post" class="user">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="inputEmail" name="inputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                      
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="inputPassword" name="inputPassword" placeholder="Password">
                                        
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <input type="submit" onclick="return checkFormLoginValidation()" id="form-shuk123" value="Login" class="btn btn-primary btn-user btn-block">                    
                    
</form>
                   <div class="text-center">                    
                    <p class="errMsgOfLogin" id="errMsgOfLogin"><?php echo $error ?></p>
                  </div>                   
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="errMsg" class="errMsg"></div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Adding the call JS -->
<script src="js/validation.js"></script>

<!-- Close Invalid Message  -->
<script>
let errMsgOfLogin = document.getElementById("errMsgOfLogin"); 
if(errMsgOfLogin.innerText == "your login name or password is invalid") {
    setTimeout(()=>{
        errMsgOfLogin.innerText = "";        
    },5000);
}
</script>

</body>

</html>
