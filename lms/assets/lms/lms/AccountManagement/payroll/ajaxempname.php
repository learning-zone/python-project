<?php
include("../connection.php");
$q=$_GET["q"];
$qryy=mysql_query("select * from emp_details where iId_emp=\"$q\"");
$res=mysql_fetch_object($qryy);
echo "<input type=text name=txtname value='$res->vemp_name' readonly=true/>";
if($res->vemp_jtype==1)
{
echo "<input type=text name=txthour readonly=false/>";
}
?>