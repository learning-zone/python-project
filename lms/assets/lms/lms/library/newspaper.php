<?php
require_once("../db.php");
if($_GET)
{
	$actn=$_REQUEST['actn'];
}
if($_POST)
{
	$magazine_sub_no=$_POST['magazine_sub_no'];
	$act=$_POST['act'];
	$library=$_POST['library'];
	$newspaper_no=$_POST['newspaper_no'];
	$amount=$_POST['amount'];
	$l_name=$_POST['l_name'];
	$r_name=$_POST['r_name'];
	$title=$_POST['title'];
	$language=$_POST['language'];
	$copies=$_POST['copies'];
	$dd=$_POST['dd'];
	$mm=$_POST['mm'];
	$yy=$_POST['yy'];
	$remarks=$_POST['remarks'];
	$idttl=$_POST['idttl'];
	$ssp_type=$_POST['ssp_type'];
}

$mag_date = "$yy-$mm-$dd";
//add
if($actn==1)
{
	$sql2="select id from lib_newspaper_det where newspaper_no='$magazine_sub_no' and newspaper_date='$mag_date' and stts=1";
	$rs2=execute($sql2);
	if(rowcount($rs2)==0)
	{
		$sql="insert into lib_newspaper_det (`newspaper_no`, `title`, `language`, `newspaper_date`, `amount`, `remarks`, `library`, `register`, `stts`, `nofcp`)";
		$sql.=" values ('$magazine_sub_no', '$title', '$language', '$mag_date',  '$amount', '".addslashes($remarks)."', '$library', 3, 1, '$copies')";
		execute($sql)or die("Could not add details");
		echo "<center>Inserted Successfully.</center>";
		echo "<br>";
		echo "<a href=add_newspaper.php>Go Back</a></td>";
		die();
	}
	else
	{
		echo "<center>Duplicate not allowed.</center>";
		echo "<br>";
		echo "<a href=add_newspaper.php>Go Back</a></td>";
		die();
	}
}
//modify
elseif($actn==2)
{
	 	 	 
	$sql="update lib_newspaper_det set newspaper_date='$mag_date',amount='$amount',remarks='".addslashes($remarks)."',nofcp='$copies' where id='$idttl'";
	execute($sql) or die("Could not update details");
	echo "<center>Updated Successfully.</center>";
	echo "<br>";
	echo "<a href=add_newspaper.php>Go Back</a></td>";
	die();
}
//Inactive
elseif($actn==3)
{
	$sql="update lib_newspaper_det set stts=0 where id='$idttl' ";
	execute($sql) or die("Could not update details");
	echo "<center>Updated Successfully.</center>";
	echo "<br>";
	echo "<a href=add_newspaper.php>Go Back</a></td>";
	die();
}
?>
