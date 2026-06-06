<?php
	session_start();
	include("../db1.php");
	$StudID=$_REQUEST['StudID'];
	$a_sts=$_REQUEST['a_sts'];
	$branch=$_REQUEST['branch'];
	$class_section_id=$_REQUEST['class_section_id'];
	$sem=$_REQUEST['sem'];
	$acdates=date('Y-m-d');
	//$fname=$_POST['fname'];
	if($a_sts=='F')
	{
		mysql_query("update student_m set archive='N' where id='$StudID'");
		mysql_query("update archive_student_date set activated_date='$acdates' where student_id='$StudID'");
	}
	else
	{
		mysql_query("insert into student_m (select * from archive_student where id='$StudID')");
		mysql_query("delete from archive_student where id='$StudID'");
		mysql_query("update student_m set archive='N' where id='$StudID'");
	}
header("Location: SearchArchive.php?a_sts=$a_sts&class_section_id=$class_section_id&branch=$branch&sem=$sem");
?>
	