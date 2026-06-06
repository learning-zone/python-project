<?php
session_start();
include("db1.php");
$q=$_GET["q"];
$_SESSION['sem']=$q;

?>
