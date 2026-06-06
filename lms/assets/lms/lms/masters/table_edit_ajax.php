<?php
session_start();
include("../db1.php");

	$user_name = $_SESSION['user'];
	$Type = $_REQUEST['Type'];
	$tab_id = $_REQUEST['tab_id'];
	
if($_POST['id'])
{
	$id=mysql_escape_string($_POST['id']);
    $firstname=mysql_escape_string($_POST['firstname']);
	$status=mysql_escape_string($_POST['status']);
	
	$sql = "UPDATE `student_m_field` SET `display_name` = '$firstname', `status`='$status' WHERE id='$id'";
	$result = execute($sql) or die(mysql_error());
		
}


?>