<?php

session_start();

include("../db.php");

$flag = $_POST['flag'];

$college = $_POST['college'];

$Types = $_REQUEST['Types'];

$dept = $_POST['dept'];

$location = $_POST['location'];

$group = $_POST['group'];

$subgroup = $_POST['subgroup'];

$agroup = $_POST['agroup'];

$bropt = $_POST['bropt'];

$purchase_value = $_POST['purchase_value'];

$depreciated_value = $_POST['depreciated_value'];

$billno = $_POST['billno'];

$descript = $_POST['descript'];

$qtyies = $_POST['qtyies'];

$PurDay = $_POST['PurDay'];

$PurMonth = $_POST['PurMonth'];

$PurYear = $_POST['PurYear'];

$vendor = $_POST['vendor'];

$AddDetails = $_POST['AddDetails'];

$sql=execute("select * from individual_asset_details_temp");

for($i=0;$i<rowcount($sql);$i++)

{

	$Flag=0;

	$r=fetcharray($sql,$i);

	$sql1="select * from individual_asset_details where asset_id=$r[asset_id] ";

	$sql1.=" and dept_id=$r[dept_id] and location_id=$r[location_id] and item_code='$r[asset_code]'";

	$rs1=execute($sql1);

	if(rowcount($rs1)!=0)

	{

		$Flag=1;

		echo "<font color=red><b>Cannot Save Details of Asset $r[asset_code] !! Duplicate Entry</b></font><br>";

		echo "<font color=red><b>Asset Number $r[asset_code]  Has been entered !! Please Check Again !!</b></font><br>";

	}
	if($Types == "Add")
        {

	if($Flag==0)

	{

		$sql2="insert into individual_asset_details(asset_id,item_code,";

		$sql2.=" unitprice,location_id,dept_id,date_of_purchase,current_value,asset_status_id,";

		$sql2.=" status,condition,AssetStatus,vendor) ";

		$sql2.=" values($r[asset_id],'$r[asset_code]',$r[purchase_value],$location,$dept,";

		$sql2.=" '$r[purchase_date]',$r[depreciated_value],4,'false','Working','Old',$r[vendor_id])";

		execute($sql2) or die(error_description());

		echo "<b>Asset Details of $r[asset_code] Successfully Saved !!</b></font><br>";
		//$msg="Asset Details of $r[asset_code] Successfully Saved !!";
		//header("Location:OldAssets.php?msg=$msg");

	}
		}

}