<!DOCTYPE html>
<html>
<?php session_start(); ?>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
    <link rel="stylesheet" href="stylesheets/styles.css">
    <title>Create New Company</title>
  </head>
  <body>
    <?php if(isset($_SESSION['companyCreateErrorMsg'])){ //Displays when 462input_handler.php detects an incorrect PIN was entered ?>
      <main class="main-content">
        <div class="content-box">
          <span class="title-text">Placeholder Scheduling Solutions</span>
          <br>
          <span class="create-text">Enroll New Company</span>
          <form action="/462Project/462input_handler.php" method="post">
            Company Name:<br>
            <input type="text" name="new_company_title" value="<?php echo $_SESSION['new_company_title'] ?>"><br>
            Company PIN:<br>
            <input type="text" name="new_company_pin" value="<?php echo $_SESSION['new_company_pin'] ?>"><br>
            Owner Username:<br>
            <input type="text" name="new_owner_username" value="<?php echo $_SESSION['new_owner_username'] ?>"><br>
            Owner Password:<br>
            <input type="text" name="new_owner_password" value="<?php echo $_SESSION['new_owner_password'] ?>"><br>
            Owner First Name:<br>
            <input type="text" name="new_owner_fname" value="<?php echo $_SESSION['new_owner_fname'] ?>"><br>
            Owner Last Name:<br>
            <input type="text" name="new_owner_lname" value="<?php echo $_SESSION['new_owner_lname'] ?>"><br>
            Owner Email:<br>
            <input type="text" name="new_owner_email" value="<?php echo $_SESSION['new_owner_email'] ?>"><br>
            Owner Phone Number:<br>
            <input type="text" name="new_owner_phone" value="<?php echo $_SESSION['new_owner_phone'] ?>"><br><br>
            <input type="submit" name="create_company_submit" value="Submit">
          </form>
        </div>
      </main>
    <?php
      echo '<script type="text/javascript">
              alert("'.$_SESSION['companyCreateErrorMsg'].'");
            </script>';
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
    }else{
    ?>
    <!-- Default screen displayed. -->
    <main class="main-content">
      <div class="content-box">
        <span class="title-text">Placeholder Scheduling Solutions</span>
        <br>
        <span class="create-text">Create New Company</span>
        <form action="/462Project/462input_handler.php" method="post">
          Company Name:<br>
          <input type="text" name="new_company_title"><br>
          Company PIN:<br>
          <input type="text" name="new_company_pin"><br>
          Owner Username:<br>
          <input type="text" name="new_owner_username"><br>
          Owner Password:<br>
          <input type="text" name="new_owner_password"><br>
          Owner First Name:<br>
          <input type="text" name="new_owner_fname"><br>
          Owner Last Name:<br>
          <input type="text" name="new_owner_lname"><br>
          Owner Email:<br>
          <input type="text" name="new_owner_email"><br>
          Owner Phone Number:<br>
          <input type="text" name="new_owner_phone"><br><br>
          <input type="submit" name="create_company_submit" value="Submit">
        </form>
      </div>
    </main>
  <?php } ?>
  </body>
</html>
