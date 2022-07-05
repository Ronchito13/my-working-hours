<?php
   include 'config/config.php';
   session_start();
      
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select u_id, u_name, u_email from management_users where u_email = '$user_check'");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['u_email'];
   $u_name = $row['u_name'];
   $u_id = $row['u_id'];          
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }
?>