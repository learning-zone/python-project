<?php
session_start();

include("../db1.php");


/*echo "<pre>";
print_r($_GET);
print_r($_SESSION);
echo "</pre>";*/

if($_SESSION)
{
	$term=$_SESSION['term'];
	$subject=$_SESSION['subject'];
}



if($_POST['id'])
{
	
	$tablename='grade_m_'.$subject.'_'.$term;
	
	$id=mysql_escape_string($_POST['id']);
	
	$grace=$_POST['grace'];

	$graceID=mysql_fetch_array(mysql_query("SELECT `id` FROM `grade_grace` WHERE `letter`='$grace' AND `status`=1"));
	
	$sqlUpdate="UPDATE `$tablename` SET `category1` = '$graceID[id]'  WHERE `student_id` = '$id'";
	 //echo "<br>".$sqlUpdate;
	 $resultUpdate = mysql_query($sqlUpdate);
}
?>