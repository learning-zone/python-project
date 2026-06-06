<?php
session_start();
include("../connection.php");
$dept=$_POST['txtdepartment'];
$ins=$_SESSION['ins'];
 if($ins=="")
 {
 $ins=$_POST['comboin'];
 }
 else
 {
  $qq=mysql_query("select * from ac_institution where vinstitution='".$ins."'");
	  $obj=mysql_fetch_object($qq);
	  $ins=$obj->iIdx_institution;
 }
mysql_query("insert into emp_department(iIdx_institution,vdepartmentname) values('".$ins."','".$dept."')");
echo "<script>alert('Data added successfully');window.location.href='viewdepartments.php';</script>";
?>	