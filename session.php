<?php
   include_once('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   $connection = getConnection();
   $sql = select($connection,"select username from users where username = '$user_check' ");
   
   $row = mysqli_fetch_array($sql);
   closeConnection($connection);
   $user_name = $row['username'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
?>