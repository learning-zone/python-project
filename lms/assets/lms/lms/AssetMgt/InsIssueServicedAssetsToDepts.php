<html>
<head>
<?php
session_start();
require("../db.php");
$dept = $_POST['dept'];
$PersonName = $_POST['PersonName'];
$id = $_POST['id'];
?>
</head>
<body>
<?php
$today=date("Y-m-d");

$sql22=execute("select * from dept_no where dpt_id=$dept");
$rs22=fetcharray($sql22);
if(is_array($id))
{
while( list(,$Value) = each($id) )
{

	$ID = $Value;

	$SpltId=explode("_",$ID);

	$GPAutoId=$SpltId[0];
	$ItemCodeId=$SpltId[1];

	$sql="update service_gatepass_details set issue_status='YES' where id=$GPAutoId";

	execute($sql) or die(error_description()."error2");
}
}
//-------------------------ADDED BY Shashidhar 0n 03--6-2006-------------------------------------------
		else
		{
		die( "<font color=red><b>Please Select the Check Box...!</b></font><br><font color=blue><b><a href=IssueServicedAssetsToDepts.php><u>Go Back</u></a></b></font>");
		}
		//------------------------------
	echo "<font color=blue><b>Serviced Materials are Issued to $rs22[Dept] !!</b></font><br>";
?>
</body>
</html>