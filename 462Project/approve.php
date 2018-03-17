<?php

  $id = $_GET['id'];

  $conn =  mysqli_connect('localhost', 'root', '', '462_schedule_project');

  if(!$conn){
    die ("Connection failed:  " .mysqli_connect_error());
  }

    $sql = "UPDATE prerequest SET prerequest.Status = 'Approve' where prerequest.ID=$id";
    if (mysqli_query($conn, $sql)) {
      mysqli_close($conn);

      header('Location:http://localhost/462Project/manager_homepage.html.php');
      exit;
    } else {
      echo "Error deleting record";
    }
?>
