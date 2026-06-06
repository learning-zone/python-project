<html>
<head><title>Save Asset Move Details</title></head>

<?php
	session_start();
	include("../db.php");
	
	$ano = $_POST['ano'];
$search_asset = $_POST['search_asset'];
$moveDay = $_POST['moveDay'];
$moveMonth = $_POST['moveMonth'];
$moveYear = $_POST['moveYear'];
$SourceLocation = $_POST['SourceLocation'];
$asset_id = $_POST['asset_id'];
$asset_no = $_POST['asset_no'];
$location_id = $_POST['location_id'];
$dept_id = $_POST['dept_id'];
$autoid = $_POST['autoid'];

?>
<body>
<?php
$nsql1=execute("select * from location_master where id=$to_location");
$rs1=fetcharray($nsql1);

$ID=explode("-",$to_location);

$LocationId=$ID[0];
$DeptId=$ID[1];
	for($i=0;$i<count($aset);$i++)
	{
		$sql="update individual_asset_details set location_id=$LocationId,dept_id=$dept_id where id=$aset[$i]";
		$sql1="insert into asset_movement_register(asset_no,from_location,to_location,date_of_movement,remarks) ";
	$sql1.=" values('".strtoupper($aset_n[$i])."',$SourceLocation,$LocationId,'$moveYear-$moveMonth-$moveDay','$asset')";
	execute($sql) or die(error_description()."error1");
	execute($sql1) or die(error_description()."error2");
	echo "<font color=brown><b>Asset No : ".strtoupper($aset_n[$i])." moved Successfully</b><br></font>";
	}
	

	

?>
</body>
</html>
