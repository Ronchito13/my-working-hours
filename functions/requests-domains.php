<?php

  include 'config/config.php';
   

   // Insert Things

  if(isset($_POST['case'])){

    $case = $_POST['case'];

    switch ($case) {

      // Post - Insert Domains

      case "insert_domains":
  
        $dname = $_POST["dname"];
        $durl = $_POST["durl"];
        $dprice = $_POST["dprice"];
        $dsupplier = $_POST["dsupplier"];
        $dserver = $_POST["dserver"];
        $dpurpose = $_POST["dpurpose"];
        $dexpirydate = $_POST["dexpirydate"];
        $drenew = $_POST["drenew"];
        $dprotected = $_POST["dprotected"];

        $sql = "SELECT d_url FROM management_domains WHERE d_url = '$durl'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

      if($count == 1) {         
        echo "Domain already exist in system!"; 
        break;
        } 
        
        $sql = "INSERT INTO management_domains (d_name, d_url, d_price, d_supplier, d_server, d_purpose, d_expiryDate, d_renew, d_protected ) VALUES ('$dname','$durl','$dprice','$dsupplier','$dserver','$dpurpose', '$dexpirydate', '$drenew', '$dprotected' )";
          if (mysqli_query($db, $sql)) {
            $last_id = $db->insert_id;            
            $thisDomain = array($last_id,$dname, $durl, $dprice, $dsupplier, $dserver, $dpurpose, $dexpirydate, $drenew, $dprotected);
            echo json_encode($thisDomain);                      
            } else {
              echo "Sorry, error occured"; 
            }
  
      break;

          // Post - Delete Domains
  
      case "delete_domains":              

        $d_id = $_POST['d_id'];

        $sql = "DELETE FROM management_domains WHERE d_id = '$d_id'";

        if ($db->query($sql) === TRUE) {
          echo "Domain remove successfully";
        } else {
          echo "Error deleting record: " . $conn->error;
        }

      break;

        // Post - Update Domains
        
  
      case "update_domains":

        
        $did = $_POST['did']; 
        $dimp = $_POST['dimp']; 
        $dipa = $_POST['dipa']; 
        $dsup = $_POST['dsup']; 
        $dser = $_POST['dser']; 
        $dexp = $_POST['dexp']; 
        $drenew = $_POST['drenew']; 
        $dprotected = $_POST['dprotected'];

        // Check if the month of the date already exist
        $sql = "UPDATE management_domains SET d_price='$dipa', d_purpose='$dimp', d_supplier='$dsup', d_server='$dser', d_expiryDate='$dexp', d_renew='$drenew', d_protected='$dprotected' WHERE d_id = '$did'";    

        if (mysqli_query($db, $sql)) {          
          $thisDomainUpdate = array($did, $dimp, $dipa, $dsup, $dser, $dexp, $drenew, $dprotected);
          echo json_encode($thisDomainUpdate);           
          } else {         
          echo "error occured when update the domain!";
        } 

      break;

        // Default Value  
  
      default:
      echo "sorry, request not found!";
      break;
    }

  }

  
   // Get Domains

   if(isset($_GET['getInfo'])){
   $getInfo = $_GET['getInfo']; 
   switch ($getInfo) {

    case "get_domains":
            
      $sql = "SELECT * FROM management_domains";
      $result = $db->query($sql);      
      $allDomains = array();
      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $theRow = array($row["d_id"] , $row["d_name"], $row["d_url"], $row["d_price"], $row["d_supplier"], $row["d_server"], $row["d_purpose"], $row["d_expiryDate"], $row["d_renew"], $row["d_protected"]);          
          array_push($allDomains,$theRow);          
        }
        echo json_encode($allDomains);
      } else {
        echo "0 results";
      }

      break;   
      
      case "get_boxes":
            
        $sql = "SELECT * FROM management_domains";
        $result = $db->query($sql);
        $date = strtotime(date("2021-01-14 H:i:s"));
        $datePlusOneMonth = date($date , strtotime("+1 month", $date));
        $howManyDomains = $result->num_rows;
        $howMuchWePay = 0;
        $howManyExpireSoon = 0;
        $howManyServers = 3;
        $howManyActiveBrands = 3;
        $howManyGeneralBlogs = 20;        
        $expireDate;        
              
        $allBoxs = array();
        
        
          // output data of each row
        while($row = $result->fetch_assoc()) {
           $howMuchWePay += $row["d_price"];          
           $expireDate = strtotime($row["d_expiryDate"]);  

           if($expireDate >= $datePlusOneMonth){
            $howManyExpireSoon += 1; 
           } else {
            $howManyExpireSoon += 0;
           } 

            

        }

        array_push($allBoxs, $howMuchWePay);
        array_push($allBoxs, $howManyDomains);        
        array_push($allBoxs, $howManyExpireSoon);
        array_push($allBoxs, $howManyServers);
        array_push($allBoxs, $howManyActiveBrands);
        array_push($allBoxs, $howManyGeneralBlogs);

              



        echo json_encode($allBoxs);
        

  
        break;  

    default:
    echo "sorry, request not found!";
    break;
    
   }  
  }

   
   

   

   
   
?>