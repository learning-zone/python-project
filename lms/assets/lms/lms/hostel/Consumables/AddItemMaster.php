<?php
session_start();
include("../../db.php");
$item_name = $_GET['item_name'];
$quantity_type = $_GET['quantity_type'];
$stock = $_GET['stock'];
$click = $_GET['click'];
if(isset($click))
{
	if($item_name=='' && $stock=='')
	{
		die ("<p align=\"Left\"><b>Error!!! Please enter Item Name and Units before clicking Item Master!!!</b></p><a href=ItemMaster.php>Click Here To Go Back</a>");
	}
	else if($item_name=='' || $stock=='')
	{
		die ("<p align=\"Left\"><b>Error!!! Please enter Item Name and Units before clicking Item Master!!!</b></p><a href=ItemMaster.php>Click Here To Go Back</a>");
	}
	else
	{
		$query  = "INSERT INTO h_item_master(item_name,quantity_type,stock) ";
		$query .= "VALUES('$item_name','$quantity_type', '$stock')";
		$sql=execute($query) or die(error_description());
		echo $query;
		header("Location:ItemMaster.php");
	}
}
?>