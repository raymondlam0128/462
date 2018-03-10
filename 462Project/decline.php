<?php

$db = new mysqli('localhost', 'root', '', '462_schedule_project');

  if(isset($_GET["ID"]))  {

    $row_sr=$_GET["ID"];
    $sql="UPDATE prerequest SET Status = 'Decline' WHERE ID = '$row_sr'";
    $result=mysqli_query($sql);
    mysqli_query($db ,$result);
    if($result==1){
      header("http://localhost/462Project/manager_homepage.html.php");
    }
  }else{
  header("http://localhost/462Project/manager_homepage.html.php");
}


?>
