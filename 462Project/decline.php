<?php

$id = isset($_GET['id']);

$db = new mysqli('localhost', 'root', '', '462_schedule_project');

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "UPDATE FROM prerequest SET Status = 'Decline' WHERE ID = $id";

if (mysqli_query($db, $sql)) {
    mysqli_close($db);
    header('http://localhost/462Project/manager_homepage.html.php');
    exit;
} else {
    echo "http://localhost/462Project/manager_homepage.html.php";
}


?>
