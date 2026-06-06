<?php
session_start();
require("../db.php");

if($_GET)
{
$weekday=$_REQUEST['weekday'];

$pasng_id = $_REQUEST['pasng_id'];

$mon=$_REQUEST['mon'];
}
if($_POST)
{
	
	$pasng_id = $_POST['pasng_id'];
$pickup=$_POST['pickup'];

$route = $_POST['route'];

$vechile = $_POST['vechile'];

$driver = $_POST['driver'];

$p_time = $_POST['p_time'];

$drop_time = $_POST['drop_time'];
}
$sel=$_POST['sel'];
$check=$_POST['check'];



for($i=0;$i<sizeof($sel);$i++)
{	

	 $sql1="insert into trans_pasng_route_rosters(pasng_id,weekday,pickup,status) values('$pasng_id','$mon','$pickup','1')";
	// echo "<br>".$sql1;
	$maxid=fetchrow(execute("select max(id) from trans_pasng_route_rosters where pasng_id='$pasng_id' and pickup='$pickup' and status='1'"));	
	  	$rs123=execute("select id from trans_drop_time");
	 	while($r=fetcharray($rs123))
	 	{
			$id=$r[0];
			$pontval=$_POST['drop_time'.$id]; 
			
			
$sql_upd=execute("update trans_pasng_route_rosters set drop_time$r[0]='$pontval' where id='$maxid[0]'"); 
		}
}
echo header("Location: test1.php");

?>		
 
