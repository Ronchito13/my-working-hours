<?php

   include 'functions/config/config.php';
   session_start();
    $error = "";   
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $u_email = mysqli_real_escape_string($db,$_POST['inputEmail']);      
      
      $sql = "SELECT id,u_pass FROM management_users WHERE u_email = '$u_email'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);       
      
      $count = mysqli_num_rows($result);
      		
      if($count == 1) {   

        $u_pass = $row['u_pass'];            
        $to = $u_email;
        $subject = "Reset email of admin";
        
        $message = "
        <html>
        <head>
        <title>Reset email of admin</title>
        </head>
        <body>
        <p>This email contains Your details:</p>
        <table border='1'>
        <tr>
        <th>Email</th>
        <th>Password</th>
        </tr>
        <tr>
        <td>" . $u_email . "</td>
        <td>". $u_pass ."</td>
        </tr>
        </table>
        </body>
        </html>
        ";
        
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        // More headers        
        $headers .= 'Cc: rony.a@algo-services.com' . "\r\n";
        
        mail($to,$subject,$message,$headers);
         
        } else {
          $error = "You do not exist in our system";          
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

  <title>SB Admin 2 - Forgot Password</title>

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
              <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                    <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
                  </div>
                  <form action="" method="POST" class="user">
                    <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="inputEmail" name="inputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <input type="submit" onclick="return checkFormResetValidation()" value="Reset Password" class="btn btn-primary btn-user btn-block">                    
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="login.php">Remember Password ? <br/> Login here</a>
                  </div>
                  <p class="errMsgOfReset" id="errMsgOfReset"><?php echo $error ?></p>  
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
<script src="js/call.js"></script>

<!-- Close Invalid Message  -->
<script>
let errMsgOfReset = document.getElementById("errMsgOfReset"); 
if(errMsgOfReset.innerText == "You do not exist in our system") {
    setTimeout(()=>{
      errMsgOfReset.innerText = "";        
    },5000);
}
</script>

</body>

</html>
