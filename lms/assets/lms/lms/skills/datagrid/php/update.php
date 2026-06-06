<?php

error_reporting(E_ALL ^ E_NOTICE);

require_once('../common/config.php');

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>"; */

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
	$sql = 	"UPDATE customers SET  customerNumber='".$_GET["c0"]."',
				customerName = '".addslashes($_GET["c1"])."',
				contactLastName = '".addslashes($_GET["c2"])."',
				contactFirstName = '".$_GET["c3"]."',
				phone =	'".$_GET["c4"]."',
				city = '".$_GET["c5"]."',
				state =	'".$_GET["c6"]."',
				postalCode =	'".$_GET["c7"]."' 
			WHERE customerNumber=".$_GET["gr_id"];
	 
	 
	//echo "<data>".$sql."</data>";
	$res = mysql_query($sql);
	
	return "update";	
}

function delete_row(){

	$d_sql = "DELETE FROM customers WHERE customerNumber=".$_GET["gr_id"];
	$resDel = mysql_query($d_sql);
	return "delete";	
}


//include XML Header (as response will be in xml format)
header("Content-type: text/xml");
//encoding may differ in your case
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