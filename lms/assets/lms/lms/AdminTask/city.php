<?php
    require_once('../db1.php'); 
    $state=$_GET['q'];
	$query = fetchrow(execute("SELECT email FROM staff_det  WHERE slno='$state' "));
	echo $query[0];
?>