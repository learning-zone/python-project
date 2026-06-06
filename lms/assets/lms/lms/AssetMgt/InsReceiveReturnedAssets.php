<html>
<head>
<?php
session_start();
require("../db.php");
$vendor = $_POST['vendor'];
$today=date("Y-m-d");
$id = $_POST['id'];
?>
</head>
<body>
<?php
if(is_array($id))
{
while( list(,$Value) = each($id) )
{

	$ID = $Value;

	$SpltId=explode("_",$ID);

	$AssetId=$SpltId[0];
	$LocationId=$SpltId[1];
	$gatepass_id=$SpltId[2];

	$QTY="qty".$Value;

	$ReceivedQty=$$QTY;
		$ReceivedQty = $_POST["qty" . $Value];
/*
$sql="select * from individual_asset_details where asset_id=$AssetId and ";
$sql.=" location_id=$LocationId and condition='Return' and status='true' limit 0,$ReceivedQty";


$rs=execute($sql) or die(error_description()."error2");

for($i=0;$i<rowcount($rs);$i++)
{
	$r=fetcharray($rs,$i);

	$sql23=execute("select * from AssetStatusMaster where condition='Installed Working Satisfactorily'");
	$r23=fetcharray($sql23);

	$sql1="update individual_asset_details set condition='Working',";
	$sql1.=" status='false',asset_status_id=$r23[id],date_of_purchase='$today' where id=$r[id]";

	execute($sql1) or die(error_description()."error3");
}

*/

$sql1=execute("select * from return_gatepass_details where id=$gatepass_id") or die(error_description()."error4");

for($j=0;$j<rowcount($sql1);$j++)
{
	$r1=fetcharray($sql1,$j);

	if($r1[quantity]==$ReceivedQty)
	{
		execute("update return_gatepass_details set receive_status='YES',issue_status='NO' where id=$r1[id]") or die(error_description()."error5");
	}
	elseif($r1[quantity]>$ReceivedQty)
	{
	$q1=$r1["quantity"]-$ReceivedQty;

		$sql22="insert into return_gatepass_details(gatepass_id,asset_id,";
		$sql22.=" location_id,quantity,reason,receive_status,vendor_id) values($r1[gatepass_id],";
		$sql22.=" $r1[asset_id],$r1[location_id],$q1,'$r1[reason]','$r1[receive_status]',$r1[vendor_id])";

		execute($sql22) or die(error_description()."error6");

		//execute("update return_gatepass_details set receive_status='Return',quantity=$ReceivedQty where id=$r1[id]") or die(error_description()."error7");
	}
}
}
echo "<font color=brown><b>Materials / Assets Received To Central Stores !!</b></font>";
}
//-------------------------ADDED BY Shashidhar 0n 03--6-2006-------------------------------------------
		else
		{
		die( "<font color=red><b>Please Select the Check Box...!</b></font><br><font color=blue><b><a href=ReceiveReturnedAssets.php><u>Go Back</u></a></b></font>");
		}
	//-------------------------------------------------***************----------------------------------------?>
</body>
</html>
