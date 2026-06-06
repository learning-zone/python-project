<?php
session_start();
	include("../db1.php");

$sql=mysql_query("select * from stud_sibling a,student_m b where a.stud=b.id and a.status=1 order by a.family_code");
while($r=mysql_fetch_array($sql))
{
	$sqlsr=mysql_query("select * from stud_sibling a,student_m b where a.stud=b.id and per_address!='' and a.status=1 and a.stud='$r[stud]' and a.family_code='$r[family_code]' order by a.family_code");
while($r32=mysql_fetch_array($sqlsr))
{	
	$sqlsyy=$r32[per_address];
}
echo "<br>UPDATE student_m SET per_address='$sqlsyy' WHERE per_address='' and id='$r[stud]'";
 //mysql_query("UPDATE student_m SET per_address='$r32[per_address]' WHERE per_address='' and id='$r[stud]'");
}
?>


 	 	