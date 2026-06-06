<html>


<?php
session_start();
require("../db.php");
$dept = $_POST['dept'];
$dept22 = $_POST['dept22'];
$returnday = $_POST['returnday'];
$returnmonth = $_POST['returnmonth'];
$PersonName = $_POST['PersonName'];
$isddept = $_POST['isddept'];
$itmName = $_POST['itmName'];
$isddept3  = $_POST['isddept3 '];
$id = $_POST['id'];
?>

<body>
<?php
$today=date("Y-m-d");
$returndate="$returnyear-$returnmonth-$returnday";
echo "<input type='hidden' name='itmName' value='<?=$itmName?>'>";
?>
<input type="hidden" name="isddept3" value="<?=$isddept?>">
<input type="hidden" name="PersonName" value="<?=$PersonName?>">
<?
$sql="insert into deputation_gatepass_master(issue_date,date_of_return,reason,issuing_person,dept_id,issue_dept) ";
$sql.=" values('$today','$returndate','$comments','$PersonName',$dept,$isddept)";
//echo $sql;
//echo "select Dept from dept_no='$dept'";
$wwd=fetcharray(execute("select Dept from dept_no where dpt_id='$dept'"));
execute($sql) or die(error_description()."error1");

$GatePassId=fetchInsertId();

$GatePassNo="GP".$GatePassId;

execute("update deputation_gatepass_master set gatepassno='$GatePassNo' where id=$GatePassId") or die(error_description());
if(is_array($id))
{
	$rq=1;
while( list(,$Value) = each($id) )
{

	$ID = $Value;

	$SpltId=explode("_",$ID);

	$AssetAutoId=$SpltId[0];
	$LocationId=$SpltId[1];

//$AssetAutoId2=$AssetAutoId-1;
//echo "assetidauto".$AssetAutoId2;
execute("update individual_asset_details set status='true' where id=$AssetAutoId") or die(error_description());
	//execute("update individual_asset_details set status='true',dept_id='$isddept' where id=$AssetAutoId") or die(error_description());
	//echo ("update individual_asset_details set status='true',dept_id='$isddept' where id=$AssetAutoId");
	$sql1="insert into deputation_gatepass_details(gatepass_id,item_code_id,location_id) ";
	$sql1.=" values($GatePassId,$AssetAutoId,$LocationId)";


	execute($sql1) or die(error_description()."error2");
	
$rq++;
}
}

//-------------------------ADDED BY Shashidhar 0n 03--6-2006-------------------------------------------
		else
		{
		die( "<font color=red><b>Please Select the Check Box...!</b></font><br><font color=blue><b><a href=DeputeAssetsToDestination.php><u>Go Back</u></a></b></font>");
		}
		//------------------------------
echo "<font color=blue><b>Gate Pass No is : $GatePassNo</b></font><br>";
echo "Items Sent On Deputation to $comments and expected to return on ".date("d-m-Y",strtotime($returndate));
//echo "select asset_name from asset_master where id='$item_code_id'";
//$dtut=fetcharray(execute("select asset_name from asset_master where id='$AssetAutoId'"));


?>
</body>
<!--<table border='1' class='forumline' align='center' width='50%'>
<tr><td class='head' colspan='4' align='center'>T.JOHN COLLEGE</td></tr>
<tr><td  colspan='4' class='head'>GOTTIGERE P.O., BANNERGHATTA ROAD,BANGALORE-560083,INDIA</td></tr>-->
<?
/*$date=date('Y-m-d');
$dun=date('d-m-Y',strtotime($date));*/
?>

<!--<tr><td class='head'  colspan='4' align='center'>GATE PASS FOR OUT GOING MATERIALS</td></tr>
<tr><td>To,</td><td colspan='4' align='right'>Gate Pass No :<?=$GatePassNo?></td></tr>
<tr><td>Security Officer,TJGOI.</td><td colspan='4' align='right'>Date :<?=$dun?></td></tr>
<tr><td  align='center' colspan='4'>Through :<?=$PersonName?></td></tr>
<tr><td colspan='4'>Please Allow Mr.____________________________________________of <br>M/s_____________________________
To take out of the following material from Campus(Belongs to Department :<?=$wwd[0]?>)</td></tr>
<tr><td>Sl No</td><td>Description</td><!--<td>Quantity</td>--><!--<td>Purpose</td></tr>-->
<?


//echo ("select *from deputation_gatepass_details where gatepass_id='$GatePassId'");
/*$redf=execute("select *from deputation_gatepass_details where gatepass_id='$GatePassId'") or die("shashi");
$b=1;
for($u=0;$u<rowcount($redf);$u++)
{
	$sbkm=fetcharray($redf);
	echo "<tr><td>$b</td>";
	//echo "select *from individual_asset_details where 	item_code='$itmName'";
	$wwto=execute("select *from individual_asset_details where 	item_code='$itmName'");
while($qqa=fetcharray($wwto))
{
	$swty=$qqa[asset_id];
	//echo ("select *from asset_master where id='$swty'");
	$srvb=fetcharray(execute("select *from asset_master where id='$swty'"));
	echo "<td>$srvb[asset_name]</td>";
}
	/*echo "select *from asset_master where id='$sbkm[item_code_id]'";
$wes=execute("select *from asset_master where id='$sbkm[item_code_id]'");
while($eet=fetcharray($wes))
	{
echo "<td>$dtut[asset_name]</td>";
	}*/

//echo "<td>$sbkm[item_code_id]</td>";
//echo "<td></td>";
//echo ("select *from deputation_gatepass_master where gatepassno='$GatePassNo'");
/*$tghp=execute("select *from deputation_gatepass_master where gatepassno='$GatePassNo'");
while($dacg=fetcharray($tghp))
{
	
	echo "<td>$comments</td>";
}
$b++;
}
echo "</tr>";*/
?>
<!--<tr><td  colspan='4'>Prepared By :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Received By :</td></tr>
<tr><td  colspan='4'>Head of the Dept :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Return on :</td</tr>
<tr><td colspan='4' align='center'><input type='submit' name='sbt' value='PRINT GATEPASS' class='bgbutton' onclick='return shashi()'></td></tr>
</table>-->
</html>
