<html>
<head>
<?php
session_start();
require("../db.php");

$vendor = $_POST['vendor'];
$vendor_id = $_POST['vendor_id'];
$issuing_person = $_POST['issuing_person'];
$id = $_POST['id'];
$today=date("Y-m-d");

$sql=execute("select * from vendormaster_assets where id=$vendor_id");
$rs=fetcharray($sql);

?>
</head>
<body>
<div>
<?php
$slno=1;

$sql=execute("insert into return_gatepass_master(return_date,issuing_person) values('$today','$issuing_person')");

$gatepass_id=fetchInsertId();

if(is_array($id))
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
	//$REASON="reason".$Value;
//
//	$ReasonForReturn=$$REASON;
$ReasonForReturn = $_POST["reason" . $Value];
	$sql="select a.*,a.id as a_id,c.* from individual_asset_details a,assetstatusmaster b,asset_master c ";
	$sql.="where a.asset_id=c.id and a.asset_id=$AssetId and a.location_id=$LocationId and a.asset_status_id=b.id and ";
	$sql.=" a.conditions='Return' and a.status='false' order by a.id ASC limit 0,$ReturnQty";

	$rs=execute($sql) or die(error_description());
	for($i=0;$i<rowcount($rs);$i++)
	{
		$r=fetcharray($rs,$i);

		$nsql="update individual_asset_details set status='true' ";
		$nsql.=" where id=$r[a_id] and asset_id=$AssetId and location_id=$LocationId";

		execute($nsql) or die(error_desciption());
	}

	$sql="insert into return_gatepass_details(gatepass_id,asset_id,location_id,quantity,reason,vendor_id)";
	$sql.=" values($gatepass_id,$AssetId,$LocationId,$ReturnQty,'$ReasonForReturn',$vendor_id)";

	execute($sql) or die(error_description());

	$sql33=execute("select * from asset_master where id=$AssetId") or die(error_description());
	$rs33=fetcharray($sql33) or die(error_description());

	
$slno++;

}
}
//-------------------------ADDED BY Shashidhar 0n 03--6-2006-------------------------------------------
		else
		{
		die( "<font color=red><b>Please Select the Check Box...!</b></font><br><font color=blue><b><a href=ReturnAssetsToVendors.php><u>Go Back</u></a></b></font>");
		}
	//-------------------------------------------------***************-----------------------------------------
?>
</div>
<div><FONT COLOR=BROWN><B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
GATE PASS</B></FONT></div>
<div align=center><?=date("d-m-Y",strtotime($today))?><br></div>
The below mentioned assets/materials are returned back to <br>
<?=$rs[contact_person]?><br>
M/s.<?=$rs[name]?><br>
<?=$rs[address]?><br>
<?=$rs[phone]?><br>
<p>
<table border=1 cellspacing=0>
<tr><td Class="Block" colspan=4 align=center>ASSETS / MATERIAL DETAILS</td></tr>
<tr><td>Sl No</td><td>Asset / Material Description</td><td>Quantity</td><TD>Reason</TD></tr>
<?echo "<tr><td>$slno</td><td>$rs33[asset_name]</td><td>$ReturnQty</td><td>$ReasonForReturn</td></tr>";?>
</table>
<br>
<br><BR>
Stores In Charge&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Security<br>
</body>
</html>
