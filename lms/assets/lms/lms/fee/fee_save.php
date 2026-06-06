<?php
include("../db.php");
echo "$course====$sem====$stud_id<br>";
$date1 = "2009-05-06";
while(list (,$value) = each($sid))
{
	$fee_id = $value;

	$var = "act_amt".$value;
	$act_amt = $$var;

	$var1 = "paid_amt".$value;
	$paid_amt = $$var1;

	$var2 = "bal_amt".$value;
	$bal_amt = $$var2;
	//if($paid_amt!=0)

	   $var1 = "insert into stud_fee_".$course."_".$sem."(course_id,sem_id,stud_id,rec_num,rec_date,fee_id,act_amt,paid_amt,bal_amt)";
	   $var1.=" values('$course','$sem','$stud_id','4321','$date1','$fee_id','$act_amt' ,'$paid_amt','$bal_amt')";
	   echo "$var1===<br>";
	   $res1 = execute($var1) or die(mysql_error());
	   //header("Location:modify_stud_det.php");

}
?>