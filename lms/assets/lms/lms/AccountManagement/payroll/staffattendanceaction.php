<?php
include("../connection.php");
$date=isset($_REQUEST["dateatt"]) ? $_REQUEST["dateatt"] : "";
$shift=$_POST['comboshift'];
$jtype=$_POST['jtype'];
$empid=$_POST['comboid'];
$empname=$_POST['txtname'];
$thours=$_POST['txthour'];
$status=$_POST['ratt'];
mysql_query("insert into emp_attendance(att_date,att_shift,att_jtype,att_empid,att_empname,att_thours,att_status) values('".$date."','".$shift."','".$jtype."','".$empid."','".$empname."','".$thours."','".$status."')");
echo "<script>alert('Data added successfully');window.location.href='staffattendance.php';</script>";
?>