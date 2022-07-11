<?php

  include 'config/config.php';
   

   // Insert Things

  if(isset($_POST['case'])){

    $case = $_POST['case'];

    switch ($case) {

      // Post - Insert Notes

      case "insert_notes":
  
        $ndesc = $_POST['ndesc'];
        $nicon = $_POST['nicon'];                        
        $nuser = $_POST['nuser'];
        $cname = $_POST['company_name'];
        
        $sql = "INSERT INTO management_notes (n_icon, n_desc, n_user_id, n_company_name) VALUES ('$nicon','$ndesc','$nuser', '$cname')";
          if (mysqli_query($db, $sql)) {
            $last_id = $db->insert_id;            
            $thisNote = array($last_id,$nicon, $ndesc, $nuser, date("Y-m-d"), $cname);
            echo json_encode($thisNote);                      
            } else {
              echo "Sorry, error occured"; 
            }
  
      break;

          // Post - Delete Notes
  
      case "delete_notes":              

        $n_id = $_POST['n_id'];
        $n_user = $_POST['n_user'];        

        $sql = "DELETE FROM management_notes WHERE n_id = '$n_id'";

        if ($db->query($sql) === TRUE) {
          echo "Note deleted successfully";
        } else {
          echo "Error deleting record: " . $conn->error;
        }

      break;        

        // Default Value  
  
      default:
      echo "sorry, request not found!";
      break;
    }

  }

  
   // Get Notes

   if(isset($_GET['getInfo'])){
   $getInfo = $_GET['getInfo']; 
   switch ($getInfo) {

    case "get_notes":

      $u_id = $_GET["uid"];      
      $cname = $_GET["company_name"];      
      
      $sql = "SELECT * FROM management_notes WHERE management_notes.n_company_name = '$cname' AND management_notes.n_user_id = '$u_id' ORDER BY n_date DESC";
      $result = $db->query($sql);      
      $allNotes = array();
      if ($result->num_rows > 0) {        
        while($row = $result->fetch_assoc()) {           
          $theRow = array($row["n_id"] , $row["n_icon"], $row["n_desc"], $row["n_user_id"], $row["n_company_name"] ,$row["n_date"]);          
          array_push($allNotes,$theRow);               
        }
        echo json_encode($allNotes);
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