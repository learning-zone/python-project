<?php
session_start();
include("../db1.php");
if(strtoupper($_REQUEST[Types]) == "ADD")
{
    $vendorname=$_POST['vendorname'];
	
	$address=$_POST['address'];
	$contactperson=$_POST['contactperson'];
	$phone=$_POST['phone'];
	$fax=$_POST['fax'];
	$email=$_POST['email'];
	$suppliersfor=$_POST['suppliersfor'];
	$sql="insert into vendormaster_assets (name,contact_person,phone,fax,address,email,suppliers_for,status) values ('".addslashes($vendorname)."','".addslashes($address)."','".addslashes($contactperson)."','$phone','$fax','".addslashes($email)."','".addslashes($suppliersfor)."',1)";
	execute($sql);
	$msg="Vendor details inserted..";
	//$act=1;
	

	
}
elseif(strtoupper($_REQUEST[Types]) == "MOD")
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
		
		$sql = "Update vendormaster_assets set name='".addslashes($name)."',contact_person='".addslashes($contact_person)."',phone='$phone',fax='$fax',address='".addslashes($address)."',email='$email',suppliers_for='".addslashes($suppliers_for)."' where id=$value";
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
		
		$sql="update vendormaster_assets set status=0 where id=$value";
		execute($sql);
	}
	$msg="Deleted..";
	$act=2;
}
header("Location:VendorMaster.php?act=$act&msg=$msg");
?>


