<?php
   include 'config/config.php';
   session_start();
      
   $user_check = $_SESSION['login_user'];
   
<<<<<<< HEAD
   $ses_sql = mysqli_query($db,"select u_id, u_name, u_start_date, u_company_name, u_email from management_users where u_email = '$user_check'");
=======
   $ses_sql = mysqli_query($db,"select u_id, u_name, u_email from management_users where u_email = '$user_check'");
>>>>>>> 9bf346e7a8b424d718571d5bcbfa74a13e6e3269
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['u_email'];
   $u_name = $row['u_name'];
<<<<<<< HEAD
   $u_start_date = $row['u_start_date'];
   $u_company_name = $row['u_company_name'];
=======
>>>>>>> 9bf346e7a8b424d718571d5bcbfa74a13e6e3269
   $u_id = $row['u_id'];          
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }
?>