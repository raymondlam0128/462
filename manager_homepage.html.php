
<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page

if(!isset($_SESSION['manager_first_name']) || empty($_SESSION['manager_first_name'])){
  header("location: Request_day_off.html.php");
  exit;
}
if(!isset($_SESSION['manager_last_name']) || empty($_SESSION['manager_last_name'])){
  header("location: Request_day_off.html.php");
  exit;
}

?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Manager Homepage</title>

    <style>
      table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
      }
    </style>

  </head>
  <body>
    Hello
    Welcome to the manager homepage.

    <table style = "width:50%">
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Start date off</th>
        <th>End date off</th>
        <th>Action</th>
      </tr>
    <?php
    $link = new mysqli("localhost", "root", "", "462_schedule_project");
    if (!$link) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $n = $_SESSION['manager_last_name'];
    $l = $_SESSION['manager_first_name'];

    $sql = "SELECT prerequest.EFName,
                    prerequest.ELName,
                    prerequest.StartDate,
                    prerequest.EndDate,
                    prerequest.Status,
                    prerequest.ID
    FROM prerequest
    WHERE prerequest.MLName ='$n' AND prerequest.MFName= '$l'";
        $buttonName1 = "ac";
          $buttonName2= "de";
        $stmt = $link->prepare($sql);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($a,$b,$c,$d,$e,$s);
        while($stmt->fetch()){
        echo "<tr>\n";
        echo "<td  style=\"vertical-align:top; border:1px solid black;\">".$s."</td>";
        echo "<td  style=\"vertical-align:top; border:1px solid black;\">".$a."</td>";
        echo "<td  style=\"vertical-align:top; border:1px solid black;\">".$b."</td>";
        echo "<td  style=\"vertical-align:top; border:1px solid black;\">".$c."</td>";
        echo "<td  style=\"vertical-align:top; border:1px solid black;\">".$d."</td>";
        echo "<td  style=\"vertical-align:top; border:1px solid black;\">".$e."</td>";
        echo "<form action='' method = 'post'>";
        echo "<td><button type='submit' name ='update_submit' >$buttonName1</button></td>";
        echo "<td><button type='submit' name ='update2_submit' >$buttonName2</button></td>";
        echo "</form>";


        echo "</tr>\n";
      }




        if(isset($_POST['update_submit']))
            {

                     $query = "UPDATE prerequest SET prerequest.Status = 'Accpect' where prerequest.ID='$s'";
                     $stmt = $link->prepare($query);
                     $stmt->execute();
            }
        else if(isset($_POST['update2_submit']))
        {
          $query = "UPDATE prerequest SET prerequest.Status = 'Decline' where prerequest.ID='$s'";
          $stmt = $link->prepare($query);
          $stmt->execute();
        }
        




      ?>
    </table>

  </body>
</html>
