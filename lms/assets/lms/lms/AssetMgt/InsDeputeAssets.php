<html>
<head>
<?php
session_start();
require("../db.php");
$dept = $_POST['dept'];
$assetgroup = $_POST['assetgroup'];
$comments = $_POST['comments'];
$PersonName = $_POST['PersonName'];
$id = $_POST['id'];
?>
</head>
<body>
<?php
$today=date("Y-m-d");
if(is_array($id))
{
while( list(,$Value) = each($id) )
{

	$ID = $Value;

	$SpltId=explode("-",$ID);

	$AssetId=$SpltId[0];
	$AssetAutoId=$SpltId[1];

	$nsql="update individual_asset_details set condition='Deputation' ";
	$nsql.=" where id=$AssetAutoId";

	execute($nsql) or die(error_desciption());
}
}
//-------------------------ADDED BY Shashidhar 0n 03--6-2006-------------------------------------------
		else
		{
		die( "<font color=red><b>Please Select the Check Box...!</b></font><br><font color=blue><b><a href=DeputeAssets.php><u>Go Back</u></a></b></font>");
		}
		//------------------------------
	$nsql=execute("insert into reasons_for_deputation(reason,dept_id) values('$ReasonForReturn',$dept)") or die(error_description()."error3");
	echo "Items Sent On Deputation to Central Stores";
?>
</body>
</html>
