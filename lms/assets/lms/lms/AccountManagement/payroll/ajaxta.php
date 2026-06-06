<?php
include("../connection.php");
$q=$_GET["q"];
$p=$_GET["p"];
$q1=mysql_query("select * from emp_details1 where vemp_id='".$q."'");
$r=mysql_fetch_object($q1);
$t1=$r->pesi;
$ta=$p*($t1/100);
//$ta1=number_format($ta,2);
echo "<input name=txtesi type=text value='$ta' readonly/>";
?>