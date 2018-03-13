<?php




  $db = new mysqli('localhost', 'root', '', '462_schedule_project');
echo "database";
  if(isset($_GET["id"]))  {

echo"got id";
      $row_sr=$_GET["id"];

    ##  $sqli="UPDATE prerequest SET Status = 'Approved' WHERE ID = '$row_sr'";


    mysqli_query($db,"UPDATE users SET Status = 'Approve' WHERE ID = $row_sr")  ;

    mysqli_close($db);

    header("http://localhost/462Project/manager_homepage.html.php");


}

echo"comlete"
?>
