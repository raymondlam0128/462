<!DOCTYPE html>
<?php session_start();
$fname =  $_SESSION['fname'];
$lname =  $_SESSION['lname'];

if(isset($_POST['request_submit'])){

  $manager_first_name = $_POST['manager_first_name'];
  $manager_last_name = $_POST['manager_last_name'];
  $startDate = $_POST['Start_date'];
  $endDate = $_POST['End_date'];
  $reason = $_POST['reason'];

  $db = new mysqli('localhost', 'root', '', '462_schedule_project');


  $query = "INSERT INTO prerequest (MFName,MLName,EFName,ELName,StartDate,EndDate, Reason, Status) VALUES (?,?,?,?,?,?,?,?)";
  $stmt = $db->prepare($query);

//  if(mysqli_connect_erro()){
  //  echo "Error: could not connect to database.";
//  }
  $stmt->bind_param('ssssssss',

  $manager_first_name,
  $manager_last_name ,
  $fname,
  $lname,
  $startDate ,
  $endDate,
  $reason,
  $Status = "Pending");
  $stmt->execute();
  header('Location:http://localhost/462Project/employee_homepage.html.php');
}

?>

<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="stylesheets/request.css">

    <title>Employee Homepage</title>

  </head>
  <body>
    Hello <?php echo $fname ?> <?php echo $lname; ?>.  Welcome to the employee homepage.
    <br>


    <table style = "width:50%" >
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Start date off</th>
        <th>End date off</th>
        <th>Reason</th>
        <th>Status</th>
      </tr>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "462_schedule_project");
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT EFName, ELName, StartDate, EndDate, Reason, Status FROM prerequest
    WHERE EFName = '".$fname."' AND ELName = '".$lname."'";

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
          <td> <?php echo  $row["Reason"] ?> </td>
          <td> <?php echo  $row["Status"] ?> </td>
        </tr>
        <br>
        <?php
      }
      } else {
      ?>
      <tr>
        <td colspan="6"><center> <?php echo "There is no request!!!" ?> </center></td>
      <tr>
        <?php
      }

    ?>
    <a href="http://localhost/462Project/index.html.php">Logout</a>

  </table>
    <br>
    <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Request day off</button>
    <div id="id01" class="modal">
      <form class="modal-content animate" action="" method = "post">
        <div class="container">
          <table style = "width:80%" border="0">
          <tr>
            <td><label for = "mangerfirstname"> <b>Manager first name </b> </label></td>
            <td><input type = "text" placeholder = "Enter manager first name" name = "manager_first_name" required></td>
          </tr>

          <tr>
            <td><label for = "mangerlastname"> <b>Manager last name </b> </label></td>
            <td><input type = "text" placeholder = "Enter manager last name" name = "manager_last_name" required></td>
          </tr>
          <tr>
            <td><label for="Start_date"><b>Start date   </b></label></td>
            <td><input type="date" placeholder="mm/dd/yyyy" name="Start_date" required></td>
          </tr>
          <tr>
            <td><label for="End_date"><b>End date   </b></label></td>
            <td><input type="date" placeholder="mm/dd/yyyy" name="End_date" required></td>
          </tr>
          <tr>
            <td><label for="Reason"><b>Reason  </b></label></td>
            <td><input type="text" placeholder="Enter a reason to be off" name="reason" required></td>
          </tr>
        </table>
          <button type="submit" name ="request_submit">Submit</button>
        </div>
        <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      </form>
    </div>

  </body>
</html>
