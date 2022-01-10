<?php
$db["host"] = 'localhost';
$db["user"] ="root";
$db["password"] ="";
$db["db"] ="cms";
$conn = mysqli_connect($db["host"], $db["user"], $db["password"], $db["db"]);
if (!$conn){
    die('Error : Not connect to the database cms');
}


?>