<?php
session_start();
include("../connection.php");
$q=$_GET["q"];
$dt=$_GET["r"];
$de=$_GET["t"];
$id=$_GET["u"];
$ins=$_GET["v"];
$s=$_GET['s'];
//$q4=mysql_query("select count(*) from emp_attendance where att_date='".$dt."'  and att_empid='".$id."' and iIdx_institution='$ins'");
//$num=mysql_fetch_row($q4);
/*if($num[0]>0)
{*/
mysql_query("update emp_attendance set ihalf='$q',itt='1' where att_date='".$dt."' and att_empid='".$id."' and iIdx_organization='$ins' and att_department='$de'");
/*}
else
{
mysql_query("insert into emp_attendance(att_date,iIdx_organization,att_shift,att_department,att_empid,att_status) values('".$dt."','".$ins."','".$sh."','".$de."','".$id."','".$q."')");*/
//}
?>