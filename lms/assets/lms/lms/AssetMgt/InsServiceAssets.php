<html>
<head>
<?php
session_start();
require("../db.php");
$dept = $_POST['dept'];
$PersonName = $_POST['PersonName'];
$comments = $_POST['comments'];
$assetgroup = $_POST['assetgroup'];
$sh = $_POST['sh'];
$sbt = $_POST['sbt'];
$chk = $_POST['chk'];
?>
</head>
<body>
<?php
$today=date("Y-m-d");
if(is_array($chk))
{
while( list(,$Value) = each($chk) )
{

	$ID = $Value;
	$SpltId=explode("-",$ID);
    
	$AssetId=$SpltId[0];
    $AssetAutoId=$SpltId[1];

	$nsql="update individual_asset_details set conditions='Service' where id=$AssetAutoId";
		
	execute($nsql) or die(error_desciption());
}
}
//-------------------------ADDED BY Vittal Narayan  -------------------------------------------
		else
		{
		die( "<font color=red><b>Please Select the Check Box...!</b></font><br><font color=blue><b><a href=ServiceAssets.php><u>Go Back</u></a></b></font>");
		}
		//-----------------------------------------

	$nsql=execute("insert into reasons_for_service(reason,dept_id) values('$ReasonForReturn',$dept)") or die(error_description()."error3");
	
?>
<?php
if($nsql)
{?>
<script>
alert ("Items Sent for Servicing to Central Stores");
Location.href('SendAssetsToService.php');
</script>
<?php
}	
?>
</body>
</html>
