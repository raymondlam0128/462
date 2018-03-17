
<?php
  session_start();

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

<!DOCTYPE html>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
input[type=text], [type = date] {
    width: 50%;
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
    width: 50%; /* Full width */
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

<h1> <center> <i>Request days Form </i></center></h1>


  <form class="modal-content animate" action="" method = "post">
    <div class="container">

      <label for = "mangerfirstname"> <b>Manager first name </b> </label>
      <input type = "text" placeholder = "Enter manager first name" name = "manager_first_name" required>
      <br>

      <label for = "mangerlastname"> <b>Manager last name </b> </label>
      <input type = "text" placeholder = "Enter manager last name" name = "manager_last_name" required>
      <br>

      <label for="First_name"><b>First name </b></label>
      <input type="text" placeholder="Enter first name" name="employee_first_name" required>
	     <br>

      <label for="Last_name"><b>Last name  </b></label>
      <input type="text" placeholder="Enter last name" name="employee_last_name" required>
	     <br>

      <label for="Start_date"><b>Start date   </b></label>
      <input type="date" placeholder="mm/dd/yyyy" name="Start_date" required>
	<br>
    <label for="End_date"><b>End date   </b></label>
      <input type="date" placeholder="mm/dd/yyyy" name="End_date" required>
	<br>
      <button type="submit" name ="request_submit" >Submit</button>
    </div>
  </form>

</body>
</html>
