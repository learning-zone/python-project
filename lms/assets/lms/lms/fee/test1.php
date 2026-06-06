<?php
include("../db.php");
$course = '1';
$sem = '1';
$adm_id = '1';
$stud_id='000001';

if($sem==1 || $sem==2)
{
	$yr=1;
}
if($sem==3 || $sem==4)
{
	$yr=2;
}
$res = execute("select id,fee_name,amount from fee_head where course_id='$course' and year_id='$yr' and admission_type='$adm_id' order by id");
$num = rowcount($res);
for($i=1;$i<=$num;$i++)
{
	$row = fetcharray($res);
	echo "$row[id]===$row[fee_name]===$row[amount]<br>";
}
?>