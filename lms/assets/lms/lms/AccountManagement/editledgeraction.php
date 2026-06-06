<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
include("../db.php");
$id=$_POST['id'];
$ledger=$_POST['txtledger'];
$grp=$_POST['combogp'];
$type=$_POST['combodc'];
$code=$_POST['txtlcode'];
$ldesc=$_POST['txtldesc'];
$lcontact=$_POST['txtlcontact'];
$ldesig=$_POST['txtldesig'];
$lmobile=$_POST['txtlmobile'];
$btn=$_POST['b1'];
$in=$_POST['cmbin'];
//echo $id;
//echo $id."<br>".$ledger."<br>".$grp."<br>".$type."<br>".$code."<br>".$ldesc."<br>".$lcontact."<br>".$ldesig."<br>".$laddress."<br>".$lmail."<br>".$lmobile."<br>".$ob."<br>".$btn;
if($type=='By')
{
$type=0;
}
if($type=='To')
{
$type=1;
}
$sql=execute("select iIdx_grp from ac_allgroup where vgroupname=\"$grp\"");
$obj=mysql_fetch_object($sql);
$idd=$obj->iIdx_grp;
//echo $idd;
if($btn=="Update")
{
execute("update ac_ledger set vledger=\"$ledger\",iIdx_group=\"$idd\",vcode=\"$code\",vdescription=\"$ldesc\",vcontactperson=\"$lcontact\",vdesignation=\"$ldesig\",imobile=\"$lmobile\",itype=\"$type\",vins=\"$in\" where iIdx_ledger=\"$id\"");
//execute("update ac_voucher set acc=\"$ledger\"");
execute("");
echo "<script>alert('Data Updated successfully');window.location.href='viewledgers.php';</script>";
}
if($btn=="Delete")
{
execute("delete from ac_ledger where iIdx_ledger=\"$id\"");
execute("delete from ac_opbal where Vledger=\"$ledger\"");
echo "<script>alert('Data Deleted successfully');window.location.href='viewledgers.php';</script>";
}
if($btn=="Exit")
{
header("location:viewledgers.php");
}
?>