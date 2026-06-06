<?php
session_start();
include("../db.php");
if(strtoupper($_REQUEST['Types']) == "DEL")
{
	$mid=$_POST['mid'];
	while( list(,$value) = each($mid))
	{
		
		$sql="update trans_point_details set status=0 where id=$value";
		execute($sql);
	}
	$msg="Deleted..";
	
}
//header("Location:trans_point_details.php?msg=$msg");
echo "<META HTTP-EQUIV='Refresh' Content='0;URL=point_details.php?msg=$msg'>";
?>


