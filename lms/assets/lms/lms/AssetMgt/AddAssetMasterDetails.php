<?php
session_start();
require("../db1.php");
$asset_name = $_GET['asset_name'];
$Add=$_POST['Add'];
$group=$_POST['group'];
$assetgroup = $_GET['assetgroup'];
$subgroup = $_GET['subgroup'];
$Types = $_REQUEST['Types'];

if(strlen($asset_name))
{

	//echo ("select * from asset_master where asset_name='$asset_name'");

	$sql1=execute("select * from asset_master where asset_name='$asset_name'");

	if(rowcount($sql1)!=0)

{

	$msg="Duplicate Asset Name!! Cannot Save Details";

	header("Location:AssetMaster.php?msg=$msg");

	

}
$sql="insert into asset_master(asset_group_id,asset_name,status) values($subgroup,'$asset_name','1')";

$result=execute($sql);

$msg="Inserted Successfully!";

header("Location:AssetMaster.php?msg=$msg");
}

else
{

$msg="Error!!! Please enter valid Asset Group Name!!";
		 header("Location:AssetMaster.php?msg=$msg");

//exit;

}




?>















