<?php

$link= new mysqli('localhost', 'root', '', '462_schedule_project');


 $id = $_POST['name_ID'];
if(isset($_POST['update_submit']))
 {

    $query = "UPDATE prerequest SET prerequest.Status = 'Accpect' where prerequest.ID='$id'";
    $stmt = $link->prepare($query);
    $stmt->execute();
   }
else if(isset($_POST['update2_submit']))
 {

$query = "UPDATE prerequest SET prerequest.Status = 'Decline' where prerequest.ID='$id'";
$stmt = $link->prepare($query);
$stmt->execute();
 }

require('manager_homepage.html.php');


?>
