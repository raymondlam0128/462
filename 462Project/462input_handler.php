<?php
  session_start();
  include 'initiate_db.php';
  //Activated when Login button is pressed on index.html.php
  if(isset($_POST['login_submit'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    //Query to check if User/Pass combo is in Employee table
    $query = "SELECT COUNT(*), username, password, fname, lname FROM (SELECT username, password, fname, lname FROM employees WHERE username = '".$username."' && password = '".$password."') AS x";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    //Query to check if User/Pass combo is in Manager table
    $manquery = "SELECT COUNT(*), username, password, fname, lname FROM (SELECT username, password, fname, lname FROM managers WHERE username = '".$username."' && password = '".$password."') AS x";
    $manstmt = $db->prepare($manquery);
    $manstmt->execute();
    $manresult = $manstmt->fetchAll();
    /*
    Loop checks query results to determine if user in the Employee table, if
    not checks results of Manager table, redirecting to appropriate homepage.
    If in neither table, user is redirected to login screen.
    */
    foreach ($result as $row){
      if($row['COUNT(*)'] > 0){
        $_SESSION['cur_user'] = $username;
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];
        header('Location:http://localhost/462Project/employee_homepage.html.php');
      }else{
        foreach($manresult as $manrow){
          if($manrow['COUNT(*)'] > 0){
            $_SESSION['cur_user'] = $username;
            $_SESSION['fname'] = $manrow['fname'];
            $_SESSION['lname'] = $manrow['lname'];
            header('Location:http://localhost/462Project/manager_homepage.html.php');
          }else{
            header('Location:http://localhost/462Project/index.html.php');
          }
        }
      }
    }
  }

  //Activated when "Create New Employee Account" is pressed on index.html.php
  if(isset($_POST['create_employee_submit'])){
	  $_SESSION['new_employee_username']=$_POST['new_employee_username'];
	  $_SESSION['new_employee_password']=$_POST['new_employee_password'];
    $_SESSION['new_employee_fname']=$_POST['new_employee_fname'];
	  $_SESSION['new_employee_lname']=$_POST['new_employee_lname'];
    $_SESSION['new_employee_pin']=$_POST['new_employee_pin'];
	  $_SESSION['new_employee_email']=$_POST['new_employee_email'];
    $_SESSION['new_employee_phone']=$_POST['new_employee_phone'];
    /*
    Query determines if username provided is already in database, if
    so currently submitted values are stored in $_SESSION to be displayed on
    create_new_employee.html.php
    */
    $checkquery = "SELECT COUNT(*) FROM (SELECT username FROM employees WHERE username = '".$_SESSION['new_employee_username']."' AND company_pin = '".$_SESSION['new_employee_pin']."') AS x";
    $checkstmt = $db->prepare($checkquery);
    $checkstmt->execute();
    $checkresult = $checkstmt->fetchAll();

    foreach ($checkresult as $checkrow) {
      if($checkrow['COUNT(*)'] < 1){
        /*
        Query determines if PIN provided matches an existing manager's personal
        PIN. If PIN doesn match currently submitted values are stored in
        $_SESSION to be displayed on create_new_employee.html.php
        */
        $query = "SELECT COUNT(*) FROM (SELECT idcompany FROM company WHERE idcompany = '".$_SESSION['new_employee_pin']."') AS x";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach($result as $row){
          if($row['COUNT(*)'] > 0){
            $query = "INSERT INTO employees VALUES ('".$_SESSION['new_employee_username']."', '".$_SESSION['new_employee_password']."', '".$_SESSION['new_employee_fname']."', '".$_SESSION['new_employee_lname']."', '".$_SESSION['new_employee_pin']."', '".$_SESSION['new_employee_email']."', '".$_SESSION['new_employee_phone']."')";
    	      $stmt = $db->prepare($query);
    	      $stmt->execute();
            $_SESSION['new_employee_username']=null;
            $_SESSION['new_employee_password']=null;
            $_SESSION['new_employee_fname']=null;
            $_SESSION['new_employee_lname']=null;
            $_SESSION['new_employee_pin']=null;
            $_SESSION['new_employee_email']=null;
            $_SESSION['new_employee_phone']=null;
            $_SESSION['employeeCreateErrorMsg']=null;
    	      header('Location:http://localhost/462Project/index.html.php');
          }else{
            $_SESSION['employeeCreateErrorMsg']="Your PIN must be valid!";
            header('Location:http://localhost/462Project/create_new_employee.html.php');
          }
        }
      }else{
        $_SESSION['employeeCreateErrorMsg']="Your Username must be unique!";
        header('Location:http://localhost/462Project/create_new_employee.html.php');
      }
    }
  }

  if(isset($_POST['create_company_submit'])){
	  $_SESSION['new_company_title']=$_POST['new_company_title'];
    $_SESSION['new_company_pin']=$_POST['new_company_pin'];
	  $_SESSION['new_owner_username']=$_POST['new_owner_username'];
    $_SESSION['new_owner_password']=$_POST['new_owner_password'];
    $_SESSION['new_owner_fname']=$_POST['new_owner_fname'];
    $_SESSION['new_owner_lname']=$_POST['new_owner_lname'];
    $_SESSION['new_owner_fullname']=$_POST['new_owner_fname'] . " " . $_POST['new_owner_lname'];
	  $_SESSION['new_owner_email']=$_POST['new_owner_email'];
    $_SESSION['new_owner_phone']=$_POST['new_owner_phone'];
    /*
    Query determines if company name provided is already in database, if
    so currently an error message is stored in $_SESSION to be displayed on
    create_new_company.html.php
    */
    $checkquery = "SELECT COUNT(*) FROM (SELECT name FROM company WHERE name = '".$_SESSION['new_company_title']."') AS x";
    $checkstmt = $db->prepare($checkquery);
    $checkstmt->execute();
    $checkresult = $checkstmt->fetchAll();

    foreach ($checkresult as $checkrow) {
      if($checkrow['COUNT(*)'] < 1){
        /*
        Query determines if PIN provided already exists. If PIN isn't unique an error message is stored in
        $_SESSION to be displayed on create_new_company.html.php
        */
        $query = "SELECT COUNT(*) FROM (SELECT idcompany FROM company WHERE idcompany = '".$_SESSION['new_company_pin']."') AS x";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach($result as $row){
          if($row['COUNT(*)'] > 0){
            $_SESSION['companyCreateErrorMsg']="Your company PIN must be unique!";
            header('Location:http://localhost/462Project/create_new_company.html.php');
          }else{
            $query = "INSERT INTO company VALUES ('".$_SESSION['new_company_pin']."', '".$_SESSION['new_company_title']."', '".$_SESSION['new_owner_fullname']."')";
            $stmt = $db->prepare($query);
            $stmt->execute();

            $query = "INSERT INTO owners VALUES ('".$_SESSION['new_owner_username']."', '".$_SESSION['new_owner_password']."', '".$_SESSION['new_owner_fname']."', '".$_SESSION['new_owner_lname']."', '".$_SESSION['new_owner_email']."', '".$_SESSION['new_owner_phone']."', '".$_SESSION['new_company_pin']."')";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $_SESSION['companyCreateErrorMsg']=null;
            $_SESSION['new_company_title']=null;
            $_SESSION['new_company_pin']=null;
            $_SESSION['new_owner_username']=null;
            $_SESSION['new_owner_password']=null;
            $_SESSION['new_owner_fname']=null;
            $_SESSION['new_owner_lname']=null;
            $_SESSION['new_owner_pin']=null;
            $_SESSION['new_owner_email']=null;
            $_SESSION['new_owner_phone']=null;
            header('Location:http://localhost/462Project/index.html.php');
          }
        }
      }else{
        $_SESSION['companyCreateErrorMsg']="Your company name must be unique!";
        header('Location:http://localhost/462Project/create_new_company.html.php');
      }
    }
  }
?>
