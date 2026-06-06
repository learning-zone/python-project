<?php
include("../db.php");

while(list (,$value)=each($s_id))
{
	$uu_id = "usn".$value;
	$usn = $$uu_id;
	mysql_query("update student_m set usn='$usn' where id='$value'") or die("Failed to update USN..");
	mysql_query("update lib_membership_m set usn='$usn' where s_id='$value'") or die("Failed to update USN..");
}
header("Location:update_usn.php?branch=$branch&sem=$sem&msg=1");
?>
