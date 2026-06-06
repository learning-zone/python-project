<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
include("../db.php");
$id=$_POST['id'];
$a=$_POST['type'];
//echo $id;
$insname=$_POST['txteins'];
$btn=$_POST['b1'];
$tin=$_POST['txttin'];
$cst=$_POST['txtcst'];
$reg=$_POST['txtsta'];
$orr=$_POST['comboorg'];
$in=$_POST['in'];
if($btn=="Update")
{
execute("update ac_institution set vinstitution=\"$insname\",iIdx_organization='$orr',vtin='$tin',vcst='$cst',vreg='$reg'  where iIdx_institution=\"$id\" ");
execute("update ac_opbal set vins=\"$insname\" where vins=\"$in\"");
execute("update ac_usermapping set vins=\"$insname\" where vins=\"$in\"");
execute("update ac_user_details set vins=\"$insname\" where vins=\"$in\"");
execute("update ac_login set vins=\"$insname\" where vins=\"$in\"");
echo "<script>alert('Data Updated successfully');window.location.href='viewinstitutions.php';</script>";
}
if($btn=="Delete")
{
execute("delete from ac_institution where iIdx_institution=\"$id\"");
execute("delete from ac_opbal where vins=\"$insname\"");
execute("delete from ac_usermapping where vins=\"$insname\"");
execute("delete from ac_user_details where vins=\"$insname\"");
execute("delete from ac_login where vins=\"$insname\"");
execute("delete from ac_voucher where iIdx_institution=\"$id\"");
echo "<script>alert('Data Deleted successfully');window.location.href='viewinstitutions.php';</script>";
}
?>