<!DOCTYPE html>
<html>
<?php session_start(); ?>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
    <link rel="stylesheet" href="stylesheets/styles.css">
    <title>Create New Employee</title>
  </head>
  <body>
    <?php if(isset($_SESSION['employeeCreateErrorMsg'])){ //Displays when 462input_handler.php detects an incorrect PIN was entered ?>
      <main class="main-content">
        <div class="content-box">
          <span class="title-text">Placeholder Scheduling Solutions</span>
          <br>
          <span class="create-text">Enroll New Employee</span>
          <form action="/462Project/462input_handler.php" method="post">
            Username:<br>
            <input type="text" name="new_employee_username" value="<?php echo $_SESSION['new_employee_username'] ?>"><br>
            Password:<br>
            <input type="text" name="new_employee_password" value="<?php echo $_SESSION['new_employee_password'] ?>" ><br>
            First Name:<br>
            <input type="text" name="new_employee_fname" value="<?php echo $_SESSION['new_employee_fname'] ?>"><br>
            Last Name:<br>
            <input type="text" name="new_employee_lname" value="<?php echo $_SESSION['new_employee_lname'] ?>"><br>
            Company PIN:<br>
            <input type="text" name="new_employee_pin" value="<?php echo $_SESSION['new_employee_pin'] ?>"><br>
            Email:<br>
            <input type="text" name="new_employee_email" value="<?php echo $_SESSION['new_employee_email'] ?>"><br>
            Phone Number:<br>
            <input type="text" name="new_employee_phone" value="<?php echo $_SESSION['new_employee_phone'] ?>"><br><br>
            <input type="submit" name="create_employee_submit" value="Submit">
          </form>
        </div>
      </main>
    <?php
      echo '<script type="text/javascript">
              alert("'.$_SESSION['employeeCreateErrorMsg'].'");
            </script>';
      $_SESSION['new_employee_username']=null;
      $_SESSION['new_employee_password']=null;
      $_SESSION['new_employee_fname']=null;
      $_SESSION['new_employee_lname']=null;
      $_SESSION['new_employee_pin']=null;
      $_SESSION['new_employee_email']=null;
      $_SESSION['new_employee_phone']=null;
      $_SESSION['employeeCreateErrorMsg']=null;
    }else{
    ?>
    <!-- Default screen displayed. -->
    <main class="main-content">
      <div class="content-box">
        <span class="title-text">Placeholder Scheduling Solutions</span>
        <br>
        <span class="create-text">Create New Employee</span>
        <form action="/462Project/462input_handler.php" method="post">
          Username:<br>
          <input type="text" name="new_employee_username"><br>
          Password:<br>
          <input type="text" name="new_employee_password"><br>
          First Name:<br>
          <input type="text" name="new_employee_fname"><br>
          Last Name:<br>
          <input type="text" name="new_employee_lname"><br>
          Company PIN:<br>
          <input type="text" name="new_employee_pin"><br>
          Email:<br>
          <input type="text" name="new_employee_email"><br>
          Phone Number:<br>
          <input type="text" name="new_employee_phone"><br><br>
          <input type="submit" name="create_employee_submit" value="Submit">
        </form>
      </div>
    </main>
  <?php } ?>
  </body>
</html>
