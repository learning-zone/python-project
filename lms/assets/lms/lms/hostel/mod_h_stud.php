<?php
session_start();
require("../db.php");
$hostel = $_POST['hostel'];
$block = $_POST['block'];
$room = $_POST['room'];
$blood = $_POST['blood'];
$padd = $_POST['padd'];
$pphone = $_POST['pphone'];
$lgname = $_POST['lgname'];
$lgrelation = $_POST['lgrelation'];
$lgadd = $_POST['lgadd'];
$lgphone = $_POST['lgphone'];
;
$college = $_POST['college'];
$empname =$_POST['empname'];
$empdept =$_POST['empdept'];
$adate = $_POST['adate'];
$bdate = $_POST['bdate'];

$s_id = $_POST['s_id'];
$query=execute("select a.id,b.s_id from student_m a,h_stud_m b where a.id=b.s_id");
$row=fetcharray($query);
$sql="update h_stud_m set h_id='$hostel',lg_name='$lgname',relation='$lgrelation',lg_add='$lgadd',phone='$lgphone',
      room_no='$room',emp_n='$empname',dept='$empdept',j_date='$adate',bid='$block',domain='$college',archive='N',l_date='$bdate',
	  p_add='$padd',p_phone='$pphone',blood='$blood' where s_id='$s_id'";

//echo $sql; 
//$res=execute($sql) or die(mysql_error());
execute($sql) or die("UPDATE QUERY $sql " . mysql_error());
?>

  <DIV ALIGN="CENTER">
  Student Detail is successfully modified to the Hostel Database!!
  <br>
 <a href="doSearch2.php"><u>Back</u></a>
  </DIV>