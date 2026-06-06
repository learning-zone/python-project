<?php
session_start();
include("../../db1.php");

//print_r($_REQUEST);

function add_row(){
	global $newId;
	
	$sql = 	"INSERT INTO student_m_ec(fname,lname,relation,countryCode,home_phone,cell_phone,work_phone,email,note,inserted_date)
			VALUES ('".$_GET["c1"]."',
					'".addslashes($_GET["c2"])."',
					'".addslashes($_GET["c3"])."',
					'".$_GET["c4"]."',
					'".$_GET["c5"]."',
					'".$_GET["c6"]."',
					'".$_GET["c7"]."',
					'".$_GET["c8"]."',
					'".addslashes($_GET["c9"])."',
					CURDATE())";
	$res = mysql_query($sql);
	//set value to use in response
	$newId = mysql_insert_id();
	return "insert";	
}

function update_row(){
	   	 
		$sql = 	"UPDATE `student_m_ec` SET  
				 `fname` = '".addslashes($_GET["c1"])."',
				 `lname` = '".addslashes($_GET["c2"])."',
				 `relation` = '".$_GET["c3"]."',
				 `countryCode` = '".$_GET["c4"]."',
				 `home_phone` = '".$_GET["c5"]."',
				 `cell_phone` = '".$_GET["c6"]."',
				 `work_phone` = '".$_GET["c7"]."',
				 `email` = '".$_GET["c8"]."',
				 `note` = '".addslashes($_GET["c9"])."'

			WHERE id=".$_GET["gr_id"];

			//echo "<BR>".$sql;
	    //$res = mysql_query($sql) or die(mysql_error());
			$res = mysql_query($sql);
	
	return "update";	
}

function delete_row(){
	
	
	$d_sql = "UPDATE student_m_ec SET `status`=0 WHERE id=".$_GET["gr_id"];
	$resDel = mysql_query($d_sql);
	return "delete";	
}


header("Content-type: text/xml");

echo('<?xml version="1.0" encoding="iso-8859-1"?>'); 

$mode = $_GET["!nativeeditor_status"]; //get request mode
$rowId = $_GET["gr_id"]; //id or row which was updated 
$newId = $_GET["gr_id"]; //will be used for insert operation


switch($mode){
	case "inserted":
		//row adding request
		$action = add_row();
	break;
	case "deleted":
		//row deleting request
		$action = delete_row();
	break;
	default:
		//row updating request
		$action = update_row();
	break;
}


//output update results
echo "<data>";
echo "<action type='".$action."' sid='".$rowId."' tid='".$newId."'/>";
echo "</data>";

?>