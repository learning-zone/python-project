<?php
include_once("../db.php");
$accno=$_POST['accno'];
$media=$_POST['media'];
$cardno=$_POST['cardno'];
$IDay=$_POST['IDay'];
$IMon=$_POST['IMon'];
$IYear=$_POST['IYear'];
$DDay=$_POST['IDay'];
$DMon=$_POST['IMon'];
$DYear=$_POST['IYear'];
$remark=$_POST['remark'];
$m_id=$_POST['m_id'];

	$ret_date = date("Y-m-d");
	$sql = "UPDATE lib_circulation_m SET status=1,returned='Yes',ret_to='$user',return_date='$ret_date' WHERE acc_id='$accno' and media_type='$media'";
	$res1 = execute($sql);

	if($media==7)
	{
			$var3="update lib_magazine set status=0 where magazine_no='$accno'";
			$res3=execute($var3) or die(mysql_error());
	}
	if($media==8)
	{
			$var4="update lib_question_paper_det set flag=0 where id='$accno'";
			$res4=execute($var4) or die(mysql_error());
	}	
		//header("Location:media2.php?Action=return&flag=1");
		echo "<META HTTP-EQUIV='Refresh' Content='0;URL=media2.php?Action=return&msg=2'>";
?>