<?php
session_start();
require("../db1.php");
$Types = $_REQUEST['Types'];
$Add=$_REQUEST['Add'];
$assetsubgroupname = $_REQUEST['assetsubgroupname'];
//$assetcode = $_REQUEST['assetcode'];
$asset_sub_group_id = $_REQUEST['asset_sub_group_id'];
if($Add)
{
if(strlen($assetsubgroupname))

{

$sql=execute("select * from asset_sub_group where asset_subgroup_name='$assetsubgroupname'") ;

if(rowcount($sql)==1)

{

	$msg="Duplicate Entry !!";
	header("Location:AssetSubGroupMaster.php?msg=$msg");
	//echo "<a href='AssetSubGroupMaster.php'>Back to Asset Group Form</a>";


}

$sql="insert into asset_sub_group(asset_subgroup_name,asset_group_id,status) values('$assetsubgroupname','$asset_sub_group_id','1')";

$result=execute($sql);
$msg="Added Successfully!";
header("Location:AssetSubGroupMaster.php?msg=$msg");
$aid=fetchInsertId();

execute("insert into asset_master_counter values($aid,0)");
$msg="Added Successfully!";
header("Location:AssetSubGroupMaster.php?msg=$msg");

//exit;

}

else

{

$msg="Error!!! Please enter valid Asset Group Name!!!";
header("Location:AssetSubGroupMaster.php");
//print("<a href=AssetSubGroupMaster.php>Back to Asset Sub Group Master</a>");

}
}

?>

