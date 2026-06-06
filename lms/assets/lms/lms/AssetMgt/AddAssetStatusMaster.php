<?php

	session_start();

	include("../db1.php");

	$id = $_POST['id'];

$condition = $_POST['condition'];

$addconditions = $_POST['addconditions'];

	$sql1=execute("select * from assetstatusmaster where conditions='$condition'")or die(error_description());

		if(rowcount($sql1)!=0)

		{
			$msg= "Duplicate Asset Status Found! Cannot Save Details";		

		}

		if($condition=='')

		{

			$msg="Please Enter The Asset Status Master..";

			header("Location:AssetStatusMaster.php");


		}
	$sql="insert into assetstatusmaster(conditions,status) values('$condition',1)";

	execute($sql);

	$msg="Data Inserted Successfuly..!";

	header("Location:AssetStatusMaster.php?msg=$msg");

//header("Location:AssetStatusMaster.php");

?>

