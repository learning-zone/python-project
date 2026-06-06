<?php
 session_start();
 $_SESSION['name']="";
 unset($_SESSION['name']);
 session_destroy();
 $ms="Logged Out!!!!";
 header("location:../index.php?ms=$ms");
?>