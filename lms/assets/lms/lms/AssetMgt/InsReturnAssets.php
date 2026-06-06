<html>
<head>
<?php
session_start();
require("../db.php");
$dept = $_POST['dept'];
$PersonName = $_POST['PersonName'];
$vendor_id = $_POST['vendor_id'];
$id = $_POST['id'];
?>
</head>
<body>
<?php
$today=date("Y-m-d");
if(isset($id))		//-----------------------------ADDED BY ANURAJ------------------------------------
{

while( list(,$Value) = each($id) )
{

	$ID = $Value;

	$SpltId=explode("_",$ID);

	$AssetId=$SpltId[0];
	$LocationId=$SpltId[1];

	//$QTY="qty".$Value;
//
//	$ReturnQty=$$QTY;
		$ReturnQty = $_POST["qty" . $Value];
	//REASON="reason".$Value;
//	$ReasonForReturn=$$REASON;
$ReasonForReturn = $_POST["reason" . $Value];
	$sql="select a.*,a.id as a_id,c.* from individual_asset_details a,assetstatusmaster b,asset_master c ";
	$sql.="where a.asset_id=c.id and a.asset_id=$AssetId and a.location_id=$LocationId and a.asset_status_id=b.id and ";
	$sql.=" b.conditions='Not Installed' order by a.id ASC limit 0,$ReturnQty";

	$rs=execute($sql) or die(error_description());

	for($i=0;$i<rowcount($rs);$i++)
	{
		$r=fetcharray($rs,$i);

		$nsql="update individual_asset_details set conditions='Return' ";
		$nsql.=" where id=$r[a_id] and asset_id=$AssetId and location_id=$LocationId";

		execute($nsql) or die(error_desciption());
	}

	$nsql=execute("insert into reasons_for_return(reason,asset_id,location_id) values('$ReasonForReturn','$AssetId','$LocationId')") or die(error_description());
}
echo "<b>Items Returned to Central Stores</b>";
}
//-----------------------------ADDED BY ANURAJ--------------------------------------------------
	else
	{
	die( "<font color=red><b>Please Select the Check Box...!</b></font><br><font color=blue><b><a href=ReturnAssets.php><u>Back</u></a></b></font>");
	}
//-------------------------------------------------***************-----------------------------------------
	

?>
</body>
</html>
