<?php  

  include 'config/config.php';
   

   // Insert Things

  if(isset($_POST['case'])){

    $case = $_POST['case'];

    switch ($case) {

      // Post - Insert Hours

      case "insert_hours":
  
        $hin = $_POST['hin'];
        $hout = $_POST['hout'];
        $hdate = $_POST['hdate'];
        $huser = $_POST['huser'];  
        $company_name = $_POST['u_company_name'];  
        
        
        $pieces = explode("-", $hdate);
        $year = $pieces[0];
        $month = $pieces[1];
        $month = ltrim($month, '0');
        $day = $pieces[2];

        // Check if the month of the date already exist

        $sql = "SELECT h_date FROM management_hours WHERE h_date = '$hdate' AND h_user = '$huser' AND h_company_name = '$company_name' ";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

      if($count == 1) {         
        echo "Sorry, date already exist!"; 
        break;
        } 
        
        $sql = "INSERT INTO management_hours (h_in, h_out, h_date, monthOfHours, yearOfHours, h_user, h_company_name) VALUES ('$hin','$hout','$hdate','$month','$year','$huser', '$company_name')";
          if (mysqli_query($db, $sql)) {
            $last_id = $db->insert_id;            
            $thisWorkday = array($last_id,$hdate, $hin, $hout, $huser);
            echo json_encode($thisWorkday);                      
            } else {
              echo "Sorry, error occured"; 
            }
  
      break;

      case "get_all_companies":  
               
        $huser = $_POST['huser'];         

        // Check if the company already exist

        $sql = "SELECT * FROM management_companies WHERE management_companies.theuserid = '$huser'";                
        $result = $db->query($sql);        
        $allCompanies = array();
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            $theRow = array($row["company_id"] , $row["company_name"], $row["company_start_date"]);          
            array_push($allCompanies,$theRow);          
          }
          echo json_encode($allCompanies);
        } else {
          echo "0 results";
        }
  
      break;


      



      


      case "add_new_company":
  
        $cname = $_POST['company_name'];
        $cdate = $_POST['company_start_date'];        
        $huser = $_POST['huser'];         

        // Check if the company already exist

        $sql = "SELECT company_name FROM management_companies WHERE management_companies.company_name = '$cname' AND management_companies.theuserid = '$huser'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

      if($count == 1) {         
        echo "Sorry, this company already exist!"; 
        break;
        } 

        $addsql = "INSERT INTO management_companies (company_name, company_start_date, theuserid) VALUES ('$cname','$cdate','$huser');" ;
          if (mysqli_query($db, $addsql)) {
            $updatesql = "UPDATE management_users SET management_users.u_company_name ='$cname', management_users.u_start_date ='$cdate' WHERE management_users.u_id = '$huser';";
            if(mysqli_query($db, $updatesql)) {              
              $thisCompany = array($cname, $cdate, $huser);
              echo json_encode($thisCompany);
            } else {
              echo "Sorry, error occured when update"; 
            }                                  
            } else {
              echo "Sorry, error occured when insert"; 
            }
  
      break;


      case "update_company":
  
        $cname = $_POST['company_name'];        
        $huser = $_POST['huser'];         

        // Check if the company already exist

        $sql = "UPDATE management_users INNER JOIN management_companies ON management_users.u_id = management_companies.theuserid SET management_users.u_company_name ='$cname', management_users.u_start_date = management_companies.company_start_date WHERE management_companies.company_name ='$cname' AND management_users.u_id = '$huser';";
          if (mysqli_query($db, $sql)) {
              $thisCompany = array($cname, $huser);
              echo json_encode($thisCompany);
            } else {
              echo "Sorry, error occured when insert"; 
            }
  
      break;

      case "update_company_start_date":
  
        $cname = $_POST['company_name'];        
        $huser = $_POST['huser'];       
        $cdate = $_POST['company_start_date'];       
        

        // Check if the company already exist

        $sql = "UPDATE management_users INNER JOIN management_companies ON management_users.u_id = management_companies.theuserid SET management_companies.company_start_date ='$cdate', management_users.u_start_date = '$cdate' WHERE management_companies.company_name ='$cname' AND management_users.u_company_name ='$cname' AND management_users.u_id = '$huser';";
          if (mysqli_query($db, $sql)) {
              $thisCompany = array($cname, $huser);
              echo json_encode($thisCompany);
            } else {
              echo "Sorry, error occured when insert"; 
            }
  
      break;

      case "insert_sick_days":  
        
        $hdate = $_POST['sdate'];
        $huser = $_POST['huser'];  
        $cname = $_POST['company_name'];  
        
        $pieces = explode("-", $hdate);
        $year = $pieces[0];
        $month = $pieces[1];
        $month = ltrim($month, '0');
        $day = $pieces[2];

        // Check if the month of the date already exist

        $sql = "SELECT h_date FROM management_hours WHERE h_date = '$hdate' AND h_user = '$huser' AND h_company_name = '$cname';";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

      if($count == 1) {         
        echo "Sorry, date already used for this company!"; 
        break;
        } 
        
        $sql = "INSERT INTO management_hours (h_in, h_out, h_date, h_free_days, h_sick_days, monthOfHours, yearOfHours, h_user, h_company_name) VALUES ('0','0','$hdate','0','1','$month','$year','$huser', '$cname')";
          if (mysqli_query($db, $sql)) {
            $last_id = $db->insert_id;            
            $thisWorkday = array($last_id, $hdate, "Sick", "Day", $huser);
            echo json_encode($thisWorkday);                      
            } else {
              echo "Sorry, error occured"; 
            }
  
      break;


      case "insert_free_days":  
        
        $hdate = $_POST['sdate'];
        $huser = $_POST['huser'];  
        $cname = $_POST['company_name'];  
        
        $pieces = explode("-", $hdate);
        $year = $pieces[0];
        $month = $pieces[1];
        $month = ltrim($month, '0');
        $day = $pieces[2];

        // Check if the month of the date already exist

        $sql = "SELECT h_date FROM management_hours WHERE h_date = '$hdate' AND h_user = '$huser' AND h_company_name = '$cname';";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

      if($count == 1) {         
        echo "Sorry, date already used for this company!"; 
        break;
        } 
        
        $sql = "INSERT INTO management_hours (h_in, h_out, h_date, h_free_days, h_sick_days, monthOfHours, yearOfHours, h_user, h_company_name) VALUES ('9','9','$hdate','1','0','$month','$year','$huser', '$cname')";
          if (mysqli_query($db, $sql)) {
            $last_id = $db->insert_id;            
            $thisWorkday = array($last_id, $hdate, "Free", "Day", $huser);
            echo json_encode($thisWorkday);                      
            } else {
              echo "Sorry, error occured"; 
            }
  
      break;

      

          // Post - Delete Hours
  
      case "delete_hours":              

        $h_id = $_POST['h_id'];
        $cname = $_POST['company_name'];      

        $sql = "DELETE FROM management_hours WHERE h_id = '$h_id' AND h_company_name = '$cname'";

        if ($db->query($sql) === TRUE) {
          echo "Record deleted successfully";
        } else {
          echo "Error deleting record: " . $conn->error;
        }

      break;

        // Post - Update Hours
        
  
      case "update_hours":

        
        $hid = $_POST['hid'];
        $hin = $_POST['hin'];
        $hout = $_POST['hout'];      
        $cname = $_POST['company_name'];      
        

        // Check if the month of the date already exist
        $sql = "UPDATE management_hours SET h_in='$hin', h_out='$hout' WHERE h_id = '$hid' AND h_company_name = '$cname'";    

        if (mysqli_query($db, $sql)) {
          unset($thisWorkdayUpdate);          
          $thisWorkdayUpdate = array($hid, $hin, $hout);
          echo json_encode($thisWorkdayUpdate); 
          reset($thisWorkdayUpdate);                     
          } else {
          echo "Error Updated Record: " . $conn->error;
        } 

      break;

        // Default Value  
  
      default:
      echo "sorry, request not found!";
      break;
    }

  }

  
   // Get Hours

   if(isset($_GET['getInfo'])){

  $getInfo = $_GET['getInfo'];
  
   switch ($getInfo) {
    case "get_hours":

      $u_id = $_GET["uid"];
      $chosenMonth = $_GET["chosenMonth"];
      $chosenYear = $_GET["chosenYear"];
      $companyName = $_GET["companyName"];
      
      $sql = "SELECT * FROM management_hours WHERE h_user = '$u_id' AND monthOfHours = '$chosenMonth' AND yearOfHours = '$chosenYear' AND h_company_name = '$companyName' ORDER BY h_date ASC";
      $result = $db->query($sql);
      unset($allHours);
      $allHours = array();
      if ($result->num_rows > 0) {
        // output data of each row        
        while($row = $result->fetch_assoc()) {
          $theRow = array($row["h_id"] , $row["h_date"], $row["h_in"], $row["h_out"], $row["h_user"]);          
          array_push($allHours,$theRow);          
        }
        echo json_encode($allHours);
      } else {
        echo "0 results";
      }

      break;
      
      
      case "get_how_many_sick_days_i_have":  
               
        $huser = $_GET['uid'];
        $cname = $_GET['companyName'];        
        
        $sql = "SELECT * FROM management_hours WHERE management_hours.h_sick_days = '1' AND management_hours.h_user = '$huser' AND management_hours.h_company_name = '$cname'";                        
        $result = $db->query($sql);        
        $num_rows = mysqli_num_rows($result);
        echo $num_rows;
        
      break;


      case "get_how_many_free_days_i_have":  
               
        $huser = $_GET['uid'];
        $cname = $_GET['companyName'];        
        
        $sql = "SELECT * FROM management_hours WHERE management_hours.h_free_days = '1' AND management_hours.h_user = '$huser' AND management_hours.h_company_name = '$cname'";                        
        $result = $db->query($sql);        
        $num_rows = mysqli_num_rows($result);
        echo $num_rows;
        
      break;


      





    default:
    echo "sorry, request not found!";
    break;
    
   }  
  }

   
   

   

   
   
?>