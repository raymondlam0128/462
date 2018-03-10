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
    $conn = mysqli_connect("localhost", "root", "", "462_schedule_project");
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT ID, MFName, MLName,EFName, ELName, StartDate, EndDate, Status FROM prerequest
    WHERE MFName = '".$_SESSION['fname']."' AND MLName = '".$_SESSION['lname']."' AND Status = 'Pending'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
          <td><?php echo  $row["ID"] ?> </td>
          <td> <?php echo  $row["EFName"] ?> </td>
          <td> <?php echo  $row["ELName"] ?> </td>
          <td> <?php echo  $row["StartDate"] ?> </td>
          <td> <?php echo  $row["EndDate"] ?> </td>
          <td><a href='approve.php?Service_ID="'.$row["ID"].'"'>Approve</a>
              <a href='decline.php?Service_ID="'.$row["ID"].'"'>Decline</a></td>
        </tr>
        <br>
        <?php
        }
      } else {
      ?>
        <tr>
          <td colspan="5 "> <center> <b><h3><?php echo "There is no requests" ?></h3></b> </center></td>
        </tr>
      <?php
      }

    ?>
    <a href="http://localhost/462Project/index.html.php">Logout</a>
  </body>
</html>
