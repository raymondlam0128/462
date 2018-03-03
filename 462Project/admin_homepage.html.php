<!DOCTYPE html>
<?php session_start(); ?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin Homepage</title>
  </head>
  <body>
    Hello <?php echo $_SESSION['fname'] ?> <?php echo $_SESSION['lname']; ?>.  Welcome to the admin homepage.
    <br>
    <a href="http://localhost/462Project/index.html.php">Logout</a>
  </body>
</html>
