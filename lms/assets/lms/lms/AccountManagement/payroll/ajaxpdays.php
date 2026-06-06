<?php
session_start();
include("../connection.php");
$mon=$_GET["p"];
$id=$_GET["q"];
$qq1=mysql_query("select count(*) from emp_attendance where month(att_date)='$mon' and att_empid='$id' and att_status='P' and itt=1 and ihalf=0");
$cnt=mysql_fetch_row($qq1);
$qq2=mysql_query("select count(*) from emp_attendance where month(att_date)='$mon' and att_empid='$id' and att_status='P' and itt=1 and ihalf=1");
$cnt1=mysql_fetch_row($qq2);
$qq3=mysql_query("select count(*) from emp_attendance where month(att_date)='$mon' and att_empid='$id' and att_status='A' and itt=1 and ihalf=1");
$cnt2=mysql_fetch_row($qq3);
$ad=($cn1[0]+$cnt2[0])/2;
$pd=$cnt[0]+$ad;
echo "<input name=txtpdays type=text value='$pd' readonly/>";
?>