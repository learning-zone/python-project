<?php
session_start();
include("../db1.php");


//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";

$term=1;

if($_POST)
{
	$temp=$_POST['id'];
	$comments=$_POST['comment'];
}
//$temp="3_282";

	$token=split('_', "$temp");
	$id=$token[0];
	$subject=$token[1];

	//echo "<br>Temp :".$temp;
	//echo "<br>Student ID :".$id;
	//echo "<br>Subject :".$subject;

if($_POST['id'])
{
	
	$tablename='grade_m_'.$subject.'_'.$term;
	
	$comments=mysql_real_escape_string($comments);
	
	$sqlUpdate="UPDATE `$tablename` SET `comments` = '$comments'  WHERE `id` = '$id'";
	 //echo "<br>".$sqlUpdate;
	$resultUpdate = execute($sqlUpdate);
	
	//exit;
}
?>