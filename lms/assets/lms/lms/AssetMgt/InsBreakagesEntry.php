<html>
<head>
<?php
session_start();
require("../db.php");

$dept = $_POST['dept'];
$assetgroup = $_POST['assetgroup'];
$PersonName = $_POST['PersonName'];
?>
</head>
<body>
<?php
$today=date("Y-m-d");
if($id)
{
while( list(,$Value) = each($id) )
{

	$ID = $Value;

	$reason="reason".$Value;
	$BreakageReason=$$reason;

	$nsql="update individual_asset_details set conditions='Breakage',status='false' ";
	$nsql.=" where id=$ID";

	execute($nsql) or die(error_desciption());

	$sql1="insert into breakages_entry(item_code_id,breakage_date,reason)";
	$sql1.=" values($ID,'$today','$BreakageReason')";

	execute($sql1) or die(error_description());
}
}
else
{
	echo "<font color='red' size='3'><b>Please Select the Check Box</b></font><br>";
	echo "<font color='blue' size='2'><a href=BreakagesEntry.php><b>Go Back</b></a></font>";
	die();
}
echo "<font color=blue><b>Breakages Entered !!</b></font>";

?>
</body>
</html>
