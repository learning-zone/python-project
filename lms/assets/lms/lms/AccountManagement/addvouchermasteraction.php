<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
include("../db.php");
$vtype=$_POST['txtvtype'];
execute("insert into ac_vouchermaster(vvouchertype,iparentid) values(\"$vtype\",\"0\")");
$msg="Data Saved Successfully";
header("location:addvouchermaster.php?msg=$msg");
?>