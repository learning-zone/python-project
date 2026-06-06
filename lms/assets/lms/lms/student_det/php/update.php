<?php
session_start();
include("../../db1.php");

//print_r($_SESSION);

function add_row(){
	global $newId;
	
	$sql = 	"INSERT INTO customers(customerNumber,customerName,contactLastName,contactFirstName,phone,city,state,postalCode)
			VALUES ('".$_GET["c0"]."',
					'".addslashes($_GET["c1"])."',
					'".addslashes($_GET["c2"])."',
					'".$_GET["c3"]."',
					'".$_GET["c4"]."',
					'".$_GET["c5"]."',
					'".$_GET["c6"]."',
					'".$_GET["c7"]."')";
	$res = mysql_query($sql);
	//set value to use in response
	$newId = mysql_insert_id();
	return "insert";	
}

function update_row(){
	
	 $tablename='grade_m_'.$_SESSION['subject'].'_'.$_SESSION['term'];
   	 
		$sql = 	"UPDATE $tablename SET  
				 comments = '".addslashes($_GET["c2"])."'

			WHERE id=".$_GET["gr_id"];

	    $res = mysql_query($sql);
	
	return "update";	
}

function delete_row(){
	
	
	$d_sql = "DELETE FROM customers WHERE customerNumber=".$_GET["gr_id"];
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