<?php
session_start();
require("../db1.php");

if(strtoupper($_REQUEST[Types]) == "ADD")
{
	$bankname=$_POST['bankname'];
	$bankstname=$_POST['bankstname'];
	$address=$_POST['address'];
	$telno=$_POST['telno'];
	$accno=$_POST['accno'];
	$sql="insert into bank_details (bank_name,bank_st_name,bank_address,telephone,acc_no) values ('".addslashes($bankname)."','".addslashes($bankstname)."','".addslashes($address)."','$telno','$accno')";
	execute($sql);
	$msg="Bank details inserted..";
	$act=1;
}
elseif(strtoupper($_REQUEST[Types]) == "MOD")
{
	$mid=$_POST['mid'];
	while( list(,$value) = each($mid))
	{
		$bank_name=$_POST['bName'.$value];
		$bank_st_name=$_POST['bstName'.$value];
		$bank_add=$_POST['badd'.$value];
		$bank_tel=$_POST['btel'.$value];
		$accno=$_POST['accno'.$value];
		$sql = "Update bank_details set bank_name='".addslashes($bank_name)."',bank_st_name='".addslashes($bank_st_name)."',bank_address='".addslashes($bank_add)."',telephone='$bank_tel',acc_no='$accno' where id=$value";
		execute($sql);
	}
	$msg="Bank details updated ..";
	$act=2;
}
elseif(strtoupper($_REQUEST['Types']) == "DEL")
{
	$mid=$_POST['mid'];
	while( list(,$value) = each($mid))
	{
		
		$sql="update bank_details set status=0 where id=$value";
		execute($sql);
	}
	$msg="Bank details deleted..";
	$act=2;
}
header("Location: bank_det.php?act=$act&msg=$msg");
?>