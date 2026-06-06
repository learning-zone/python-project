<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";
session_start();
include("../db.php");
if($_POST)
{
	
    $dob=$_POST['adate'];
	$email=$_POST['email'];
	$mobile=$_POST['mobile'];
    $parent_name=$_POST['parent_name'];	
	$description=$_POST['description'];
	$student_name=$_POST['student_name'];
	
}
if($_GET)
{
	$Type=$_REQUEST['Type'];
}

if(trim($Type) == "Add")
{

			$newd=$dob;
			$dateArray=explode('/',$newd);
			$acq_yy=$dateArray[2];
			$acq_mm=$dateArray[1];
			$acq_dd=$dateArray[0];
			$dob="$acq_yy-$acq_mm-$acq_dd";
      //echo "Inside ADD";
     $sql="INSERT INTO `student_m_appointment` (`student_name`, `parent_name`, `dob`, `mobile`, `email`, `description`, `inserted_date`, `inserted_time`) VALUES ('$student_name', '$parent_name', '$dob', '$mobile', '$email', '".addslashes($description)."',CURDATE(),CURTIME())";
	 // echo $sql;
	 $result=execute($sql) or die(mysql_error());
    
			$msg='Records Saved Successfully';
			echo "<META HTTP-EQUIV='Refresh' Content='1; URL=appointment.php?msg=$msg'>";
	 	
}
?>