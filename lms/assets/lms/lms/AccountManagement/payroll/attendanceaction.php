<?php
session_start();
include("../connection.php");
$type=$_SESSION['type'];
$btn=$_POST['S1'];
if($type=='a')
{
$ins=$_POST['comboin'];
}
else
{
$ins=$_SESSION['ior'];
}
$dt=isset($_REQUEST["dateatt"]) ? $_REQUEST["dateatt"] : "";
$de=$_POST['cmbdep'];
$q5=mysql_query("select count(*) from emp_attendance where att_date='".$dt."' and att_department='".$de."' ");
$num=mysql_fetch_row($q5);
if($num[0]>0)
{
header("location:addattendance2.php?dt=$dt&de=$de&inn1=$ins&btn=$btn");
}
else
{
$q4=mysql_query("select * from emp_details1 where iIdx_institution='$ins' and iIdx_department='$de' ");
while($num=mysql_fetch_assoc($q4))
{
mysql_query("insert into emp_attendance(att_date,iIdx_organization,att_shift,att_department,att_empid,att_status,ihalf,itt) values('".$dt."','".$ins."','1','".$de."','$num[vemp_id]','P','0','0')");
header("location:addattendance2.php?dt=$dt&de=$de&inn1=$ins&btn=$btn");
}
}
?>