<?php
session_start();
$dat=$_POST['atdate'];
$sh=$_POST['shiftid'];
$dep=$_POST['deptid'];
header("location:addattendance1.php?date=$dat&shift=$sh&dept=$dep");
?>	