<?php
session_start();
include('db.php');

$sql=execute("SELECT id FROM `albumpic` ORDER BY id");
	
	$i=1;
	while($r=fetcharray($sql))
	{
		
		echo "<br>UPDATE albumpic SET PicName ='School Image $i' WHERE id=$r[id]";
		
		$sqlUpdate=execute("UPDATE albumpic SET PicName ='School Image $i' WHERE id=$r[id]") or die(mysql_error());
		
		$i++;
	}


	//$sqlUpdate=execute("UPDATE student_m_pre SET  adminpack='N'");

?>
