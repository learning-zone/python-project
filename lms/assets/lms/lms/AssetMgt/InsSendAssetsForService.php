<html>

<?php
session_start();
require("../db.php");
$dept = $_POST['dept'];
$PersonName = $_POST['PersonName'];
$comments = $_POST['comments'];
$assetgroup = $_POST['assetgroup'];
$sh = $_POST['sh'];
$sbt = $_POST['sbt'];
$id = $_POST['id'];
$chk = $_POST['chk'];
?>
<head>
<script language='javascript'>
function shashi34()
{
	window.print();
}
</script>
</head>
<body>
<input type="hidden" name="PersonName" value="<?=$PersonName?>">
<?php
$today=date("Y-m-d");
$returndate="$returnyear-$returnmonth-$returnday";
$sql="insert into service_gatepass_master(issue_date,date_of_return,reason,issuing_person,dept_id,vendor_id) ";
$sql.=" values('$today','$returndate','$comments','$PersonName','$dept','$vendor')";
execute($sql) or die(error_description()."error1");

$GatePassId=fetchInsertId();

$GatePassNo="GP".$GatePassId;
//$waxc=fetcharray(execute("select max(id) from service_gatepass_master"));
//$wrtu=execute("update service_gatepass_master set gatepassno='$GatePassNo' where id='$waxc[0]'");
execute("update service_gatepass_master set gatepassno='$GatePassNo' where id=$GatePassId") or die(error_description());
if(is_array($id))
{
while( list(,$Value) = each($id) )
{
	$ID = $Value;

	$SpltId=explode("_",$ID);

	$AssetAutoId=$SpltId[0];
	$LocationId=$SpltId[1];

	execute("update individual_asset_details set status='true' where id=$AssetAutoId") or die(error_description());

	$sql1="insert into service_gatepass_details(gatepass_id,item_code_id,location_id) ";
	$sql1.=" values($GatePassId,$AssetAutoId,$LocationId)";
	//echo $sql1;
	execute($sql1) or die(error_description()."error2");
}
}
//-------------------------ADDED BY Shashidhar 0n 03--6-2006-------------------------------------------
		else
		{
		die( "<font color=red><b>Please Select the Check Box...!</b></font><br><font color=blue><b><a href=SendAssetsToService.php><u>Go Back</u></a></b></font>");
		}
		//------------------------------
$sql=execute("select * from vendormaster_assets where id=$vendor");
$r=fetcharray($sql);

echo "<font color=blue><b>Gate Pass No is : $GatePassNo</b></font><br>";
echo "Items Sent For Service to M/s.$r[name]";
?>
</body>
<!--Newly added for to generate gate pass-->
<br>

<table border='1' class='forumline' align='center' width='70%'>
<tr><td class='head' colspan='4' align='center'>VIDYA VARDHAKA COLLEGE OF ENGINEERING </td></tr>
<tr><td  colspan='4' class='head' align='center'></td></tr>
<?
$date=date('Y-m-d');
$dun=date('d-m-Y',strtotime($date));
$rfg=fetcharray(execute("select Dept from dept_no where dpt_id='$dept'"));
?>

<tr><td class='head'  colspan='4' align='center'>GATE PASS FOR OUT GOING MATERIALS</td></tr>
<tr><td>To,</td><td colspan='4' align='right'>Gate Pass No :<?=$GatePassNo?></td></tr>
<tr><td>Security Officer,Jaffery Academy.</td><td colspan='4' align='right'>Date :<?=$dun?></td></tr>
<tr><td  align='center' colspan='4'>Through :<?=$PersonName?></td></tr>
<tr><td colspan='4'>Please Allow Mr.&nbsp;&nbsp;<input type='text' name='sh' size='20'> of <br>M/s<u><b><?=$r[name]?></b></u><br><u><b><?=$r[address]?></b></u><br>
To take out of the following material from Campus(Belongs to Department :<?=$rfg[0]?>)</td></tr>
<tr><td>Sl No</td><td>Description</td><td>Item Code</td><td>Purpose</td></tr>
<?


//echo ("select *from deputation_gatepass_details where gatepass_id='$GatePassId'");
$redf=execute("select * from service_gatepass_details where gatepass_id='$GatePassId'") or die("shashi");
$b=1;
for($u=0;$u<rowcount($redf);$u++)
{
	$sbkm=fetcharray($redf);
	echo "<tr><td>$b</td>";
	//echo "select *from individual_asset_details where 	id='$sbkm[item_code_id]'";
	$wwto=execute("select * from individual_asset_details where id='$sbkm[item_code_id]'");
while($qqa=fetcharray($wwto))
{
	$swty=$qqa[asset_id];
	//echo ("select *from asset_master where id='$swty'");
	$srvb=fetcharray(execute("select *from asset_master where id='$swty'"));
	echo "<td>$srvb[asset_name]</td>";
	echo "<td>$qqa[item_code]</td>";
}
$tghp=execute("select *from service_gatepass_master where gatepassno='$GatePassNo'");
while($dacg=fetcharray($tghp))
{
	
	echo "<td>$comments</td>";
}
$b++;
}
echo "</tr>";
?>
<tr><td  colspan='4'>Prepared By :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Received By :</td></tr>
<tr><td  colspan='4'>Head of the Dept :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Return on :</td></tr>
<tr><td colspan='4' align='center'><input type='submit' name='sbt' value='PRINT GATEPASS' class='bgbutton' onclick='return shashi34()'></td></tr>
</table>

</html>
