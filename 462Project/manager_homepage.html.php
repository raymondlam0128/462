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
        <th>Status </th>
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
    $buttonName2 = "Decline";

    $sql = "SELECT prerequest.ID,
                   prerequest.EFName,
                   prerequest.ELName,
                   prerequest.StartDate,
                   prerequest.EndDate,
                   prerequest.Status

    FROM prerequest
    WHERE MFName = '$mfname' AND MLName = '$mlname' AND Status = 'Pending' ";



    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($ID, $EFName, $ELName, $StartDate, $EndDate, $Status);

    if($stmt->num_rows > 0){
    while($stmt->fetch()){
        echo "<tr>\n";
        echo "<td >".$ID."</td>";
        echo "<td >".$EFName."</td>";
        echo "<td >".$ELName."</td>";
        echo "<td >".$StartDate."</td>";
        echo "<td >".$EndDate."</td>";
        echo "<td >".$Status."</td>";
        echo "<td><a href='Approve.php?id=".$ID."'>$buttonName1</a>";
        echo "<a href='Decline.php?id=".$ID."'>$buttonName2</a></td>";

        echo "</tr>\n";
      }
    }
    else{
      echo "<td colspan = 7><center><h2> There is no request!!!!</h2></center> </td>";
    }
    ?>
    <a href="http://localhost/462Project/index.html.php">Logout</a>

  </body>
</html>
