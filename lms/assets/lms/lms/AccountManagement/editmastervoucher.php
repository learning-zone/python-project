<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
include("../db.php");
$id=$_POST['id'];
include("../db.php");
$gname=$_POST['txtvtype'];
$btn=$_POST['b1'];
if($btn=="Update")
{
execute("update ac_vouchermaster set vvouchertype='$gname' where iIdx_vouchermaster='$id'");
echo "<script>alert('Data Updated successfully');window.location.href='viewvouchermaster.php';</script>";
}
if($btn=="Delete")
{
execute("delete from ac_vouchermaster where iIdx_vouchermaster='$id'");
echo "<script>alert('Data Deleted successfully');window.location.href='viewvouchermaster.php';</script>";
}
?>