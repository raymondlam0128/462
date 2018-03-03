<?php
  session_start();
  include 'initiate_db.php';

  if(isset($_POST['login_submit'])){
    $manager_first_name = $_POST['manger_first_name'];
    $manager_last_name = $_POST['$manager_last_name']
    $employee_first_name = $_POST['employee_first_name'];
    $employee_last_name = $_POST['employee_last_name'];
    $startDate = $_POST['Start_date'];
    $endDate = $_POST['End_date'];

    $query = "INSERT INTO prerequest (MFName, MLName, EFName, ELName, StartDate, EndDate)
    VALUES ('".$manager_first_name."', '".$manager_last_name."', '".$employee_first_name."', '".$employee_last_name."',  '".$startDate."','".$endDate"')";
    $stmt = $db->prepare($query);
    $stmt->execute();
    header('Location:http://localhost/462Project/employee_homepage.html.php');
  }
?>
