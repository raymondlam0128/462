<!DOCTYPE html>
<?php session_start();
$fname =  $_SESSION['fname'];
$lname =  $_SESSION['lname'];

if(isset($_POST['request_submit'])){

  $manager_first_name = $_POST['manager_first_name'];
  $manager_last_name = $_POST['manager_last_name'];

  $employee_first_name = $_POST['employee_first_name'];
  $employee_last_name = $_POST['employee_last_name'];
  $startDate = $_POST['Start_date'];
  $endDate = $_POST['End_date'];

  $db = new mysqli('localhost', 'root', '', '462_schedule_project');


  $query = "INSERT INTO prerequest (MFName,MLName,EFName,ELName,StartDate,EndDate, Status) VALUES (?,?,?,?,?,?,?)";
  $stmt = $db->prepare($query);

//  if(mysqli_connect_erro()){
  //  echo "Error: could not connect to database.";
//  }
  $stmt->bind_param('sssssss',

  $manager_first_name,
  $manager_last_name ,
  $employee_first_name,
  $employee_last_name ,
  $startDate ,
  $endDate,
  $Status = "Pending");
  $stmt->execute();
  header('Location:http://localhost/462Project/employee_homepage.html.php');
}

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
      <meta name="viewport" content="width=device-width, initial-scale=1">
      body {font-family: Arial, Helvetica, sans-serif;}

      /* Full-width input fields */
      input[type=text], [type = date] {
          width: 100%;
          padding: 12px 20px;
          margin: 8px 0;
          display: inline-block;
          border: 1px solid #ccc;
          box-sizing: border-box;
      }

      /* Set a style for all buttons */
      button {
          background-color: #33adff;
          color: black;
          padding: 14px 20px;
          margin: 8px 0;
          border: none;
          cursor: pointer;
          width: 50%;
      }

      button:hover {
          opacity: 0.8;
      }
      .cancelbtn {
          width: auto;
          padding: 10px 18px;
          background-color: #f44336;
      }

      /* Center the image and position the close button */
      .imgcontainer {
          text-align: center;
          margin: 24px 0 12px 0;
          position: relative;
      }


      .container {
          padding: 16px;
      }

      /* The Modal (background) */
      .modal {
          display: none; /* Hidden by default */
          position: fixed; /* Stay in place */
          z-index: 1; /* Sit on top */
          left: 0;
          top: 0;
          width: 100%; /* Full width */
          height: 100%; /* Full height */
          overflow: auto; /* Enable scroll if needed */
          background-color: rgb(0,0,0); /* Fallback color */
          background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
          padding-top: 60px;
      }

      /* Modal Content/Box */
      .modal-content {
          background-color: #fefefe;
          margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
          border: 1px solid #888;
          width: 80%; /* Could be more or less, depending on screen size */
      }

      .close:hover,
      .close:focus {
          color: red;
          cursor: pointer;
      }

      /* Add Zoom Animation */
      .animate {
          -webkit-animation: animatezoom 0.6s;
          animation: animatezoom 0.6s
      }

      @-webkit-keyframes animatezoom {
          from {-webkit-transform: scale(0)}
          to {-webkit-transform: scale(1)}
      }

      @keyframes animatezoom {
          from {transform: scale(0)}
          to {transform: scale(1)}
      }

      /* Change styles for cancel button on extra small screens */
      @media screen and (max-width: 300px) {
          .cancelbtn {
             width: 100%;
          }
      }

    </style>
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
        <th>Status</th>
      </tr>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "462_schedule_project");
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT EFName, ELName, StartDate, EndDate, Status FROM prerequest
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
            <td><label for="First_name"><b>First name </b></label></td>
            <td><input type="text" placeholder="Enter first name" name="employee_first_name" required></td>
          </tr>
          <tr>
            <td><label for="Last_name"><b>Last name  </b></label></td>
            <td><input type="text" placeholder="Enter last name" name="employee_last_name" required></td>
          </tr>
          <tr>
            <td><label for="Start_date"><b>Start date   </b></label></td>
            <td><input type="date" placeholder="mm/dd/yyyy" name="Start_date" required></td>
          </tr>
          <tr>
            <td><label for="End_date"><b>End date   </b></label></td>
            <td><input type="date" placeholder="mm/dd/yyyy" name="End_date" required></td>
          </tr>
        </table>
          <button type="submit" name ="request_submit">Submit</button>
        </div>
        <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      </form>
    </div>

    <a href="http://localhost/462Project/index.html.php">Logout</a>
  </body>
</html>
