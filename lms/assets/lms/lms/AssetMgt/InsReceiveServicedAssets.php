<html>
<head>
<?php
session_start();
require("../db.php");
$PersonName = $_POST['PersonName'];
$vendor = $_POST['vendor'];
$id = $_POST['id'];
?>
</head>
<body>
<?php
$today=date("Y-m-d");


$sql22=execute("select * from VendorMaster_Assets where id=$vendor");
$rs22=fetcharray($sql22);
if(is_array($id))
{
while( list(,$Value) = each($id) )
{
	$ID = $Value;

	$SpltId=explode("_",$ID);

	$GPAutoId=$SpltId[0];
	$ItemCodeId=$SpltId[1];

	$sql="update service_gatepass_details set returned='YES',completely_received='YES' where id=$GPAutoId";

	execute($sql) or die(error_description()."error2");
	$sql2="update service_gatepass_details set completely_received='YES' where id=$GPAutoId";
	//echo $sql2;
	execute($sql2) or die(error_description()."error2");

	$sql1="update individual_asset_details set conditions='Working',status='false' where id=$ItemCodeId";
	//echo $sql1;
	execute($sql1) or die(error_description()."error3");
}
}
//-------------------------ADDED BY Shashidhar 0n 03--6-2006-------------------------------------------
		else
		{
		die( "<font color=red><b>Please Select the Check Box...!</b></font><br><font color=blue><b><a href=ReceiveServicedAssets.php><u>Go Back</u></a></b></font>");
		}
		//------------------------------
		echo "<font color=blue><b>Serviced Materials received Back </b></font><br>";
	//echo "<font color=blue><b>Serviced Materials received to Central Stores from $rs22[name]</b></font><br>";
?>
</body>
</html>
