<?php
session_start();
include("../connection.php");
$type=$_SESSION['type'];
if($type=='a')
{
$org=$_POST['comboin'];
}
else
{
$org=$_SESSION['ior'];
}

$job=$_POST['txtjob'];
mysql_query("insert into emp_job(iIdx_institution,vjob) values('".$org."','".$job."')");
echo "<script>alert('Data added successfully');window.location.href='adddesignation.php';</script>";
?>	