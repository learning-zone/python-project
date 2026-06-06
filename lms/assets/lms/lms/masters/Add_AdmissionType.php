<?php
session_start();
include("../db1.php");
$AdmissionType=$_GET['AdmissionType'];
$short_name=$_GET['short_name'];
if(strlen($AdmissionType))
{

$sql1=execute("select * from admission where name='$AdmissionType' or short_name='$short_name'");

if(rowcount($sql1)==1)
{
	
}

	$sqlstr="Insert Into admission(name,short_name) Values ('$AdmissionType','$short_name')";
	execute($sqlstr);

	
	header("Location: add_admission_type.php");
	 	exit;
 }else{
 	
 }


?>