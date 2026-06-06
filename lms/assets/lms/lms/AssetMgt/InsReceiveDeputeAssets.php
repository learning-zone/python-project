<html>
<head>
<?php
session_start();
require("../db.php");
$isddept  = $_POST['isddept '];
$isddept3  = $_POST['isddept3 '];
$dept = $_POST['dept'];
$PersonName = $_POST['PersonName'];
$id = $_POST['id'];
?>
</head>
<body>
<input type="hidden" name="isddept3" value="<?=$isddept?>">
<?php
$today=date("Y-m-d");
if(is_array($id))
{
while( list(,$Value) = each($id) )
{

	$ID = $Value;

	$SpltId=explode("_",$ID);

	$GPAutoId=$SpltId[0];
	$ItemCodeId=$SpltId[1];
	$sql="update deputation_gatepass_details set returned='YES',completely_received='YES' where id=$GPAutoId";
	//echo $sql;
	execute($sql) or die(error_description()."error2");
	//$sql="update deputation_gatepass_details set completely_received='YES' where id=$GPAutoId";

	//execute($sql) or die(error_description()."error2");
$sql1="update individual_asset_details set condition='Working',status='false' where id=$ItemCodeId";
	//$sql1="update individual_asset_details set condition='Working',status='false',dept_id='$isddept' where id=$ItemCodeId";
//echo $sql1;
	execute($sql1) or die(error_description()."error3");
}
}
//-------------------------ADDED BY Shashidhar 0n 03--6-2006-------------------------------------------
		else
		{
		die( "<font color=red><b>Please Select the Check Box...!</b></font><br><font color=blue><b><a href=ReceiveDeputeAssets.php><u>Go Back</u></a></b></font>");
		}
		//------------------------------
	echo "<font color=blue><b>Materials are received Successfully!!</b></font><br>";
?>
</body>
</html>