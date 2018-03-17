<?php

  $id = $_GET['id'];

  $conn =  mysqli_connect('localhost', 'root', '', '462_schedule_project');

  if(!$conn){
    die ("Connection failed:  " .mysqli_connect_error());
  }

    $sql = "UPDATE prerequest SET prerequest.Status = 'Approve' where prerequest.ID=$id";

    if (mysqli_query($conn, $sql)) {
      $sql = "DELETE FROM final_shift USING final_shift, prerequest
      WHERE final_shift.Shift_ID = prerequest.Shift_ID AND final_shift.userName = prerequest.userName";
      if (mysqli_query($conn, $sql)) {

        mysqli_close($conn);
        header('Location:http://localhost/462Project/manager_approval.html.php');
        exit;
      } else {
        echo "Error removing record...";
      }
      exit;
    } else {
      echo "Error updating record";
    }


?>
