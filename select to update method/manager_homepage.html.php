
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
        echo "</tr>\n";
      }

      $stmt->data_seek(0);
?>
      <td style="vertical-align:top; border:1px solid black;">
       <!-- FORM to enter game statistics for a particular player -->
       <form action="process.php" method="post">
         <table>
           <tr>
             <td style="text-align: right; background: lightblue;">Name (Last, First)</td>
<!--            <td><input type="text" name="name" value="" size="50" maxlength="500"/></td>  -->
             <td><select name="name_ID" required>
               <option value="" selected disabled hidden>Choose to make a decision </option>

               <?php
                 while($stmt->fetch()){
                   echo "<option value=\"$s\">".$b.','.$a."</option>";
                 }
               ?>

            </select></td>
          </tr>
            <tr>
              <td><button type="submit" name ="update_submit" >ac</button></td>

            </tr>

            <tr>
              <td><button type="submit" name ="update2_submit" >dc</button></td>
            </tr>

        </form>
      </td>
    </tr>
    </table>
    </table>
  </body>
</html>
