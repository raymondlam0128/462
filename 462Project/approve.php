<?php

echo "got it";
  $db = new mysqli('localhost', 'root', '', '462_schedule_project');
if(!$db){
  echo"fuck";
}
else{
echo "got database";
}
    if(isset($_GET["ID"]))  {
      echo "fuck if";
      $row_sr=$_GET["ID"];
      $sql="UPDATE prerequest SET Status = 'Approved' WHERE ID = '$row_sr'";
      $result=mysqli_query($sql);
      mysqli_query($db ,$result);
      if($result==1){
        header("http://localhost/462Project/manager_homepage.html.php");
      }
  }else{
    header("http://localhost/462Project/manager_homepage.html.php");
  }


?>
