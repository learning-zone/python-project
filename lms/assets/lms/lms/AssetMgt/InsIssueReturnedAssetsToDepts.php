<html>
<head>
<?php
session_start();
require("../db.php");
$id = $_POST['id'];
$dept = $_POST['dept'];
$today=date("Y-m-d");

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

	//$QTY="qty".$Value;
//
//	$ReceivedQty=$$QTY;
$ReceivedQty = $_POST["qty" . $Value];

$sql1=execute("select * from return_gatepass_details where id=$gatepass_id") or die(error_description()."error4");

for($j=0;$j<rowcount($sql1);$j++)
{
	$r1=fetcharray($sql1,$j);

	if($r1[quantity]==$ReceivedQty)
	{
		execute("update return_gatepass_details set issue_status='YES' where id=$r1[id]") or die(error_description()."error5");
	}
	elseif($r1[quantity]>$ReceivedQty)
	{
	$q1=$r1["quantity"]-$ReceivedQty;

		$sql22="insert into return_gatepass_details(gatepass_id,asset_id,";
		$sql22.=" location_id,quantity,reason,issue_status,vendor_id) values($r1[gatepass_id],";
		$sql22.=" $r1[asset_id],$r1[location_id],$q1,'$r1[reason]','$r1[issue_status]',$r1[vendor_id])";

		execute($sql22) or die(error_description()."error6");

	//	execute("update return_gatepass_details set receive_status='Return',quantity=$ReceivedQty where id=$r1[id]") or die(error_description()."error7");
	}
}
}
}
//-------------------------ADDED BY Shashidhar 0n 03--6-2006-------------------------------------------
		else
		{
		die( "<font color=red><b>Please Select the Check Box...!</b></font><br><font color=blue><b><a href=IssueReturnedAssetsToDepts.php><u>Go Back</u></a></b></font>");
		}
	//-------------------------------------------------***************----------------------------------------
$sql22=execute("select * from dept_no where dpt_id=$dept");
$rs22=fetcharray($sql22);

echo "<font color=brown><b>Materials / Assets Issued To Department : $rs22[Dept]!!</b></font>";
?>
</body>
</html>
