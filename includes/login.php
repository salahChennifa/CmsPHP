<?php
include "db.php";
session_start();
if (isset($_POST['login'])){
     $username = $_POST['username_login'];
     $password = $_POST['password_login'];
    $username =  mysqli_real_escape_string($conn, $username);
    $password =  mysqli_real_escape_string($conn, $password);

    $qeury = "SELECT * FROM users WHERE username = '{$username}' AND user_password = '{$password}' ";
    $result = mysqli_query($conn, $qeury);
    if (!$result){
        die("Error : ".mysqli_error($conn));
    }
    while ($row = mysqli_fetch_assoc($result)){
        $db_id = $row['user_id'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_password = $row['user_password'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
        $db_username = $row['username'];
    }

    if ($db_username === $username && $db_user_password === $password){
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['role'] = $db_user_role;
        header("Location: ../admin");
       // header("Location: ../index.php");
    }else {
        header("Location: ../index.php");
    }
}

?>