<?php
session_start();
include("../db1.php");

if(strtoupper($_REQUEST[Types]) == "MOD")
{
	$mid=$_POST['mid'];
	while( list(,$value) = each($mid))
	{
		$name=$_POST['vname'.$value];
		$contact_person=$_POST['vcontact_person'.$value];
		$phone=$_POST['vphone'.$value];
		$fax=$_POST['vfax'.$value];
		$address=$_POST['vaddress'.$value];
		$email=$_POST['vemail'.$value];
		$suppliers_for=$_POST['vsuppliers_for'.$value];
		
		$sql = "Update individual_asset_details set unitprice='".addslashes($name)."',current_value='".addslashes($contact_person)."',billno='$phone',item_description='$fax',quantity='".addslashes($address)."',date_of_purchase='$email',vendor='".addslashes($suppliers_for)."' where id=$value";
		execute($sql);
	}
	$msg="Updated ..";
	$act=2;
}
elseif(strtoupper($_REQUEST['Types']) == "DEL")
{
	$mid=$_POST['mid'];
	while( list(,$value) = each($mid))
	{
		
		$sql="update individual_asset_details set status=0 where id=$value";
		execute($sql);
	}
	$msg="Deleted..";
	$act=2;
}
header("Location:OldAssets.php?act=$act&msg=$msg");
?>


