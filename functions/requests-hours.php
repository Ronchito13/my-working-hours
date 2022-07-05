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
        
        $pieces = explode("-", $hdate);
        $year = $pieces[0];
        $month = $pieces[1];
        $month = ltrim($month, '0');
        $day = $pieces[2];

        // Check if the month of the date already exist

        $sql = "SELECT h_date FROM management_hours WHERE h_date = '$hdate' AND h_user = '$huser' ";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

      if($count == 1) {         
        echo "Sorry, date already exist!"; 
        break;
        } 
        
        $sql = "INSERT INTO management_hours (h_in, h_out, h_date, monthOfHours, yearOfHours, h_user) VALUES ('$hin','$hout','$hdate','$month','$year','$huser')";
          if (mysqli_query($db, $sql)) {
            $last_id = $db->insert_id;            
            $thisWorkday = array($last_id,$hdate, $hin, $hout, $huser);
            echo json_encode($thisWorkday);                      
            } else {
              echo "Sorry, error occured"; 
            }
  
      break;

          // Post - Delete Hours
  
      case "delete_hours":              

        $h_id = $_POST['h_id'];

        $sql = "DELETE FROM management_hours WHERE h_id = '$h_id'";

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
        

        // Check if the month of the date already exist
        $sql = "UPDATE management_hours SET h_in='$hin', h_out='$hout' WHERE h_id = '$hid'";    

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
      
      $sql = "SELECT * FROM management_hours WHERE h_user = '$u_id' AND monthOfHours = '$chosenMonth' AND yearOfHours = '$chosenYear' ORDER BY h_date ASC";
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

    default:
    echo "sorry, request not found!";
    break;
    
   }  
  }

   
   

   

   
   
?>