<!DOCTYPE html>
<?php session_start();

if(isset)

?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Employee Homepage</title>

    <style>
      table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
      }
    </style>
  </head>
  <body>

    Hello <?php echo $_SESSION['fname'] ?> <?php echo $_SESSION['lname']; ?>.  Welcome to the employee homepage.
    <br>


    <table style = "width:50%"  >
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Start date off</th>
        <th>End date off</th>
        <th>Status</th>
      </tr>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "462_schedule_project");
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT EFName, ELName, StartDate, EndDate, Status FROM prerequest
    WHERE EFName = '".$_SESSION['fname']."' AND ELName = '".$_SESSION['lname']."'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
          <td> <?php echo  $row["EFName"] ?> </td>
          <td> <?php echo  $row["ELName"] ?> </td>
          <td> <?php echo  $row["StartDate"] ?> </td>
          <td> <?php echo  $row["EndDate"] ?> </td>
          <td> <?php echo  $row["Status"] ?> </td>
        </tr>
        <br>
        <?php
      }
      } else {
      ?>
      <tr>
        <td colspan="5"><center> <?php echo "There is no request!!!" ?> </center></td>
      <tr>
        <?php
      }

    ?>
  </table>
    <br>
    <a href="http://localhost/462Project/index.html.php">Logout</a>
  </body>
</html>
