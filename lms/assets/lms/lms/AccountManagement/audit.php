<?php
session_start();
 include("../db.php");
 $ins=$_REQUEST['ins'];
 $id=$_REQUEST['id'];
 $dt1=$_REQUEST['dt1'];
// $id=$_POST['ch1'];
// echo $ins.$dt1.$id;
 $name=$_REQUEST['name'];
 $qry=execute("select * from ac_voucher where vvoucherno=\"$id\"");
 $obj=mysql_fetch_object($qry);
 if($obj->istatus==1)
 {
 execute("update ac_voucher set istatus=0 where vvoucherno=\"$id\"");
  header("location:viewdaybook1.php?dt1=$dt1&ins=$ins");
 }
 else
 {
 execute("update ac_voucher set istatus=1 where vvoucherno=\"$id\"");
  header("location:viewdaybook1.php?dt1=$dt1&ins=$ins");
 }
?>