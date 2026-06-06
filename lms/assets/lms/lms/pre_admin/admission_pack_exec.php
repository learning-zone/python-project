<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>"; 
 
session_start();
require_once("../db.php");

$adate=$_POST['adate'];
$bdate=$_POST['bdate'];
$app_no=$_POST['app_no'];
$enquiry=$_POST['enquiry'];
$courier=$_POST['courier'];
$reg_code=$_POST['reg_code'];
$consignment=$_POST['consignment'];


 $date1=explode('/',$adate);
 $handover_date="$date1[2]-$date1[1]-$date1[0]";
 
 $date2=explode('/',$bdate);
 $send_date="$date2[2]-$date2[1]-$date2[0]";
	

	$sqlInsert="INSERT INTO `student_m_adminpack`(`reg_code`, `app_no`, `enquiry`, `handover_date`, `courier`, `consignment`, `send_date`, `inserted_date`, `inserted_time`) VALUES ('$reg_code', '$app_no', '$enquiry', '$handover_date', '$courier', '$consignment', '$send_date', CURDATE(), CURTIME())";
	
	//echo $sqlInsert;
	//echo "<br>";
	$result=execute($sqlInsert) or die(mysql_error());
	
	$id=fetcharray(execute("SELECT MAX(id) FROM `student_m_adminpack` WHERE status=1 LIMIT 1"));
	
	$reg_code=fetcharray(execute("SELECT `reg_code` FROM `student_m_adminpack` WHERE status=1 AND id='$id[0]' LIMIT 1"));
	
	$sqlUpdate="UPDATE `student_m_online` SET `adminpack`='Y' WHERE id='$reg_code[0]'";
	//echo $sqlUpdate;
	
	$resultUpdate=execute($sqlUpdate) or die(mysql_error());
	
	
		$msg="Sucessfully Added";	
		echo "<META http-equiv='refresh' content='1;URL=admission_pack.php?msg=$msg' target='_parent'>";
?>