<html>
<head>
<?php
session_start();
require("../db.php");

?>
</head>
<script>
function printReport()
{
	prn.style.display='none';
	print(this.form);
	prn.style.display='';
}
</script>
<body>
<form method="post" >
<?php
$today=date("Y-m-d");
$sql=execute("select * from dept_no where dpt_id=$dept") or die(error_description());
$r=fetcharray($sql);
$Dept=$r["Dept"];
$sqlQuery=execute("Select col_name,col_code from college");
$res=fetcharray($sqlQuery);
$Caption=$r["col_name"];
$SubHead=$r["col_code"];
/*echo "<center><b>$Caption</B></center><br>";
echo "<center><b>MATERIAL RECEIVED REPORT</b></center><br><br>";
echo ("Date : ".date("d-m-Y",strtotime($today))."<br>");
echo "<br><br>";
printf("\t This is to Certify the list of Items / Materials received from Central Stores to <b>$Dept</b>\n");
printf(" are Inspected by Mr.$PersonName & are certified to be in Good Working Condition.\n");
printf("\t The List of Items / Materials Received are as below\n");
echo "<table border=1>";
echo "<tr><td>Sl No</td><td>Item / Asset Name</td><td>Quantity</td><td>Location</td></tr>";*/
$slno=1;
////Added By shashidhar on 06-02-2006
if(is_array($id))
{  //-----------
while( list(,$Value) = each($id) )
{
	$ID = $Value;
	$SpltId=explode("-",$ID);
	$AssetId=$SpltId[0];
	$LocationId=$SpltId[1];
	$QTY="quantity-".$Value;
	$ReceivedQty=$$QTY;
	$STATUS="status-".$Value;
	$AssetStatus=$$STATUS;
	$sql="select a.*,a.id as a_id,c.* from individual_asset_details a,assetstatusmaster b,asset_master c ";
	$sql.="where a.asset_id=c.id and a.asset_id=$AssetId and a.location_id=$LocationId and a.asset_status_id=b.id and ";
	$sql.=" b.conditions='Not Installed' and a.dept_id=$dept order by a.id ASC limit 0,$ReceivedQty";

	$rs=execute($sql) or die(error_description()."error1");
	for($i=0;$i<rowcount($rs);$i++)
	{
		$r=fetcharray($rs,$i);
		$nsql="update individual_asset_details set asset_status_id=$AssetStatus,conditions='Working',status='false',date_of_purchase='$today' ";
		$nsql.=" where id=$r[a_id] and asset_id=$AssetId and location_id=$LocationId and dept_id=$dept";
		execute($nsql) or die(error_desciption()."error2");
	}
	$sql1=execute("select * from asset_master where id=$AssetId");
	$rs1=fetcharray($sql1);
	$sql2=execute("select * from location_master where id=$LocationId");
	$rs2=fetcharray($sql2);
	
	//fwrite($f,"$slno\t$rs1[asset_name]\t$ReceivedQty\t$rs2[location]\n");
	$slno++;
}
}
//Added By shashidhar on 06-02-2006
else
{
	echo "<font color='red' size='3'><b>Please Select Check Box</b></font><br>";
	echo "<font color='blue' size='2'><a href=ReturnAssets.php><b>Go Back</b></a></font>";
	die();
}
if($id!="")
{
echo "<center><b>$Caption</B></center><br>";
echo "<center><b>MATERIAL RECEIVED REPORT</b></center><br><br>";
echo ("Date : ".date("d-m-Y",strtotime($today))."<br>");
echo "<br><br>";
printf("\t This is to Certify the list of Items / Materials received from Central Stores to <b>$Dept</b>\n");
printf(" are Inspected by Mr.$PersonName & are certified to be in Good Working Condition.\n");
printf("\t The List of Items / Materials Received are as below\n");
echo "<table border=1>";
echo "<tr><td>Sl No</td><td>Item / Asset Name</td><td>Quantity</td><td>Location</td></tr>";
echo "<tr><td>$slno</td><td>$rs1[asset_name]</td><td>$ReceivedQty</td><td>$rs2[location]</td></tr>";
echo "</table>";
echo "<br><br><br><br>";
echo "<b>Manager</b>";?>
<br><div align=center id=prn>
<input type="button"  class=bgbutton value="Print Report" onclick="printReport()"></div>
<?}
?>

<!-------------------------------->
</form>
</body>
</html>
