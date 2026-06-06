<?php
session_start();
require("../db1.php");
$Types = $_REQUEST['Types'];
$assetgroup_name = $_POST['assetgroup_name'];
$asset_abbr=$_POST['asset_abbr'];
$Add=$_POST['Add'];
$id = $_POST['id'];
$assetgroupname=$_POST['assetgroupname'];
$assetabr=$_POST['assetabr'];
$Types = $_REQUEST['Types'];
$msubgroup="$accountgroups";
if($Add)
{
	if(strlen($assetgroup_name))
	{

		$sql1=execute("select * from asset_group where assetgroupname='$assetgroup_name'");
		if(rowcount($sql1)!=0)
		{

			$msg="Duplicate Asset Group  Found! Cannot Save Details";
			 header("Location:AssetGroup.php?msg=$msg");

		}	

		$sql="insert into asset_group(assetgroupname,abbrevation,status) values('$assetgroup_name','$asset_abbr','1')";

		$result=execute($sql);	
		 $msg="Added Successfully!"; 
		 header("Location:AssetGroup.php?msg=$msg");

	}		
	else

	{

		$msg="Error!!! Please enter valid Asset Group Name!!";
		 header("Location:AssetGroup.php?msg=$msg");

		

	}

}

?>

