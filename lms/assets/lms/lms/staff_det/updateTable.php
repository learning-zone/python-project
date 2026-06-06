<?php
session_start();
include('../db.php');

$sql=execute("SELECT id FROM `student_m_appointment` ORDER BY id");
	
	/*while($r=fetcharray($sql))
	{
		
		echo "<br>UPDATE student_m_appointment SET  parent_name = REPLACE(parent_name, 'A', 'q') WHERE id=$r[id]";
		
		$sqlUpdate=execute("UPDATE student_m_appointment SET parent_name = REPLACE(parent_name, 'A', 'Q') WHERE id=$r[id]") or die(mysql_error());
	}*/


	$sqlUpdate=execute("UPDATE student_m_pre SET  adminpack='N'");

?>
