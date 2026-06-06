<?php
session_start();
include("../connection.php");
$r1=$_POST['radiobutton'];
if($r1==1)
{
header("location:viewsalaryslip.php");
}
if($r1==2)
{
header("location:viewsalreports.php");
}
if($r1==3)
{
header("location:viewbanktransfer.php");
}
if($r1==4)
{
header("location:viewindcash.php");
}
if($r1==5)
{
header("location:viewindcheque.php");
}
if($r1==6)
{
header("location:viewconsalvoucher.php");
}
if($r1==7)
{
header("location:viewconsal.php");
}
if($r1==8)
{
header("location:viewconsaldetailed.php");
}
?>