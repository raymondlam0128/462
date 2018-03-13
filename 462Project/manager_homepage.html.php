<!DOCTYPE html>
<?php session_start(); ?>
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
    Hello <?php echo $_SESSION['fname'] ?> <?php echo $_SESSION['lname']; ?>.  Welcome to the manager homepage.
    <br>

    <table style = "width:50%"  >
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Start date off</th>
        <th>End date off</th>
        <th>Action</th>
      </tr>
    <?php

    $mfname = $_SESSION['fname'];
    $mlname = $_SESSION['lname'];
    $conn = new mysqli("localhost", "root", "", "462_schedule_project");
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $buttonName1 = "Accept";
    $buttonname2 = "Decline";

    $sql = "SELECT (ID,
                   EFName,
                   ELName,
                   StartDate,
                   EndDate,
                   Status)

    FROM prerequest
    WHERE MFName = '$mfname' AND MLName = '$mlname' ";



    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($ID, $EFName, $ELName, $StartDate, $EndDate, $Status);


    while($stmt->fetch()){
        echo "<tr>\n";
        echo "<td >".$ID."</td>";
        echo "<td >".$EFName."</td>";
        echo "<td >".$ELName."</td>";
        echo "<td >".$StartDate."</td>";
        echo "<td >".$EndDate."</td>";
        echo "<td >".$Status."</td>";
        echo "<form action='' method = 'post'>";
        echo "<td><button type='submit' name ='update_submit' >$buttonName1</button>";
        echo "<button type='submit' name ='update2_submit' >$buttonName2</button></td>";
        echo "</form>";
        echo "</tr>\n";
      }

      if(isset($_POST['update_submit'])){
        $query = "UPDATE prerequest SET prerequest.Status = 'Accpect' where prerequest.ID='$s'";
        $stmt = $link->prepare($query);
        $stmt->execute();
      }
      else if(isset($_POST['update2_submit'])){
        $query = "UPDATE prerequest SET prerequest.Status = 'Decline' where prerequest.ID='$s'";
        $stmt = $link->prepare($query);
        $stmt->execute();
       }


    ?>

  </body>
</html>
