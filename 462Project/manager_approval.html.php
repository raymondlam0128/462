<!DOCTYPE html>

<?php  session_start(); ?>


<html>
  <head>
    <meta charset="utf-8">
    <title>Manager Approval page</title>

    <style>
      table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
      }
    </style>

  </head>
  <body>

    <table style = "width:50%"  >
      <tr>
        <th>Shift_ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Start date off</th>
        <th>End date off</th>
        <th>Reason</th>
        <th>Status </th>
        <th  colspan="2">Action</th>
      </tr>
    <?php

    $mfname = $_SESSION['fname'];
    $mlname = $_SESSION['lname'];
    $conn = new mysqli("localhost", "root", "", "462_schedule_project");
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $buttonName1 = "Accept";
    $buttonName2 = "Decline";

    $sql = "SELECT prerequest.ID,
                   prerequest.Shift_ID,
                   prerequest.EFName,
                   prerequest.ELName,
                   prerequest.StartDate,
                   prerequest.EndDate,
                   prerequest.Reason,
                   prerequest.Status

    FROM prerequest
    WHERE MFName = '$mfname' AND MLName = '$mlname' AND Status = 'Pending' ";



    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($ID, $shift_ID, $EFName, $ELName, $StartDate, $EndDate, $Reason, $Status);

    if($stmt->num_rows > 0){
    while($stmt->fetch()){
        echo "<tr>";
        echo "<td >".$shift_ID."</td>";
        echo "<td >".$EFName."</td>";
        echo "<td >".$ELName."</td>";
        echo "<td >".$StartDate."</td>";
        echo "<td >".$EndDate."</td>";
        echo "<td >".$Reason."</td>";
        echo "<td >".$Status."</td>";
        echo "<td><a href='Approve.php?id=".$ID."'>$buttonName1</a></td>";
        echo "<td><a href='Decline.php?id=".$ID."'>$buttonName2</a></td>";

        echo "</tr>";
      }
    }
    else{
      echo "<td colspan = 8><center><h2> There is no request!!!!</h2></center> </td>";
    }
    ?>

    <a href="http://localhost/462Project/manager_homepage.html.php">Manager homepage</a>
  </body>
</html>
