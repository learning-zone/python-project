<?php
require_once("../db.php");
$member = $_POST['member'];
$crs = $_POST['crs'];
$crsyr = $_POST['crsyr'];
$staff = $_POST['staff'];
$sel = $_POST['sel'];
$mType = $_POST['mType'];

while( list(,$Value) = each($sel) )
	{
		$del = execute("update lib_membership_m set status=0 where id=$Value");
	}
	echo "<div align='center'>Member Card Cancelled...<br><a href='searchMember1.php?member=$member&crs=$crs&crsyr=$crsyr&staff=$staff'></div>";
?>