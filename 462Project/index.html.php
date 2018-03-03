<!DOCTYPE html>
<?php
  session_start();
  $_SESSION['user'] = "";
  $_SESSION['fname'] = "";
  $_SESSION['lname'] = "";
?>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
    <link rel="stylesheet" href="stylesheets/styles.css">
    <title>Login</title>
  </head>
  <body>
    <main class="main-content">
      <div class="content-box">
        <span class="title-text">Placeholder Scheduling Solutions</span>
        <form action="/462Project/462input_handler.php" method="post">
          Username:<br>
          <input type="text" name="username"><br>
          Password:<br>
          <input type="password" name="password" ><br><br>
          <input type="submit" name="login_submit" value="Submit">
        </form>
        <br>
        <button class="link-button" onclick="window.location.href='/462Project/create_new_employee.html.php'">Enroll New Employee</button>
        <button class="link-button" onclick="window.location.href='/462Project/create_new_company.html.php'">Enroll New Company</button>
      </div>
    </main>
  </body>
</html>
