<?php 
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
include("../db.php");
$uname=$_POST['tname'];
$opass=$_POST['t2'];
$npass=$_POST['t3'];
$cnpass=$_POST['t4'];
//echo $uname.$opass;
$qry=execute("select * from ac_login where vusername=\"$uname\" and vpassword=password(\"$opass\")");
$obj=mysql_fetch_object($qry);
$num=rowcount($qry);
if($num==0)
{
 $msg3="Incorrect Password";
 header("location:changepassword.php?msg3=$msg3");
}
else
{
execute("update ac_login set vpassword=password(\"$cnpass\") where vusername=\"$uname\"");
 $msg4="Password Changed";
 header("location:changepassword.php?msg4=$msg4");
}
?>