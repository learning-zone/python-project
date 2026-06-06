<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
include("../db.php");
$id=$_POST['id'];
$a=$_POST['type'];
$orgname=$_POST['txteorg'];
$orgdesc=$_POST['txtedesc'];
$btn=$_POST['b1'];
$ob=$_POST['txtopbal'];
$tin=$_POST['txttin'];
$cst=$_POST['txtcst'];
$reg=$_POST['txtsta'];
//echo $id;
//echo $id.$orgname.$orgdesc.$a.$btn;;
if($btn=="Update")
{
execute("update ac_organization set vorgname=\"$orgname\",vorgdescription=\"$orgdesc\",vtin='$tin',vcst='$cst',vreg='$reg' where iIdx_organization=\"$id\"");
//$msg="Data Updated Successfully";
echo "<script>alert('Data Updated successfully');window.location.href='vieworganizations.php';</script>";
}
if($btn=="Delete")
{
execute("delete from ac_organization where iIdx_organization=\"$id\"");
execute("delete from ac_institution where iIdx_organization=\"$id\"");
execute("delete from ac_usermapping where iIdx_organization=\"$id\"");
execute("delete from ac_user_details where iorg=\"$id\"");
//$msg="Data Deleted Successfully";
echo "<script>alert('Data Deleted Successfully');window.location.href='vieworganizations.php';</script>";
}
?>