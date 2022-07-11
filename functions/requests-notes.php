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
<<<<<<< HEAD
        $cname = $_POST['company_name'];
        
        $sql = "INSERT INTO management_notes (n_icon, n_desc, n_user_id, n_company_name) VALUES ('$nicon','$ndesc','$nuser', '$cname')";
          if (mysqli_query($db, $sql)) {
            $last_id = $db->insert_id;            
            $thisNote = array($last_id,$nicon, $ndesc, $nuser, date("Y-m-d"), $cname);
=======
        $users = array("1","2","3","4","5","6");
        $spread_users = implode(' ', $users);
        
        

        $sql = "SELECT n_desc FROM management_notes WHERE n_desc = '$ndesc'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        if($count == 1) {         
        echo "Sorry, someone already wrote the same message!"; 
        break;
        } 
        
        $sql = "INSERT INTO management_notes (n_icon, n_desc, n_note_loader, n_all_users) VALUES ('$nicon','$ndesc','$nuser', '$spread_users')";
          if (mysqli_query($db, $sql)) {
            $last_id = $db->insert_id;            
            $thisNote = array($last_id,$nicon, $ndesc, $nuser, date("Y-m-d"), $spread_users);
>>>>>>> 9bf346e7a8b424d718571d5bcbfa74a13e6e3269
            echo json_encode($thisNote);                      
            } else {
              echo "Sorry, error occured"; 
            }
  
      break;

          // Post - Delete Notes
  
      case "delete_notes":              

        $n_id = $_POST['n_id'];
<<<<<<< HEAD
        $n_user = $_POST['n_user'];        

        $sql = "DELETE FROM management_notes WHERE n_id = '$n_id'";
=======
        $n_user = $_POST['n_user'];
        $allusers = $_POST['n_all_users'];        
        $users_separated = str_replace($n_user, '', $allusers);

        $sql = "UPDATE management_notes SET n_all_users='$users_separated' WHERE n_id = '$n_id'";
>>>>>>> 9bf346e7a8b424d718571d5bcbfa74a13e6e3269

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
<<<<<<< HEAD
      $cname = $_GET["company_name"];      
      
      $sql = "SELECT * FROM management_notes WHERE management_notes.n_company_name = '$cname' AND management_notes.n_user_id = '$u_id' ORDER BY n_date DESC";
      $result = $db->query($sql);      
      $allNotes = array();
      if ($result->num_rows > 0) {        
        while($row = $result->fetch_assoc()) {           
          $theRow = array($row["n_id"] , $row["n_icon"], $row["n_desc"], $row["n_user_id"], $row["n_company_name"] ,$row["n_date"]);          
          array_push($allNotes,$theRow);               
=======
      
      $sql = "SELECT * FROM management_notes ORDER BY n_date ASC ";
      $result = $db->query($sql);      
      $allNotes = array();
      if ($result->num_rows > 0) {        
        while($row = $result->fetch_assoc()) { 
          if(strpos($row["n_all_users"], $u_id) !== false){                     
          $theRow = array($row["n_id"] , $row["n_icon"], $row["n_desc"], $row["n_note_loader"], $row["n_all_users"] ,$row["n_date"]);          
          array_push($allNotes,$theRow);          
        }
>>>>>>> 9bf346e7a8b424d718571d5bcbfa74a13e6e3269
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