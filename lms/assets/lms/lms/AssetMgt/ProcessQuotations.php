<html>
<head>
<script language="JavaScript">
function RefreshMe()
{
	document.frm.action="ProcessQuotations.php";
	document.frm.submit();
}
function CheckValue(id)
{
	document.frm.checkid.value=id;
}
</script>

<?php
session_start();
include("../db.php");
include("../urlaccess.php");
$rindent = $_POST['rindent'];
$checkid = $_POST['checkid'];
if($user=='')
{
	header("Location:login.php");
}
else
{
	$p_th=$_SERVER['SCRIPT_NAME'];
	$qry=execute("select * from usermenu where username='$user' and access='Yes' and linkpath='$p_th'");
	if(rowcount($qry)==0)
	{
		header("Location:login.php");
	}
}



?><body>
<form method="post" name="frm" action="InsProcessQuotations.php">
<table class=forumline align=center>
<tr><td Class="head" colspan=2>Process Quotations</td></tr>
<tr><td class=rowpic>Select Requirement Indent</td><td class=rowpic><select name="rindent" OnChange="RefreshMe()">
<option value="-1">Select Requirement Indent</option>
<?php
	$sql="select distinct a.* from requirementindent a ,quotation b ";
	$sql.=" where a.quotation_status='NO' and a.id=b.RID and b.status='Not Processed'";

	$rs=execute($sql) or die(error_description());

	for($i=0;$i<rowcount($rs);$i++)
	{
		$r=fetcharray($rs,$i);

		if($rindent==$r[id])
		{
			echo "<option value=$r[id] selected>$r[RINumber]===>".date("d-m-Y",strtotime($r[RDate]))."</option>";
		}
		else
		{
			echo "<option value=$r[id]>$r[RINumber]===>".date("d-m-Y",strtotime($r[RDate]))."</option>";
		}

	}
?>
</select></td></tr>
</table>
<?php
if($rindent<>'')
{
	$sql1="select a.*,b.*,a.id as qid,c.name from quotation a,asset_master b ,";
	$sql1.=" vendormaster_assets c where a.RID=$rindent and a.asset_id=b.id and a.vendor_id=c.id";
	$rs1=execute($sql1) or die(error_description());
	if(rowcount($rs1)>=1)
	{
		echo "<table class=forumline align=center>";
		echo "<tr><td Class=rowpic>Select Quot No</td><td Class=rowpic>Quotation Date</td><td Class=rowpic>Asset Name</td><td Class=rowpic>Quantity</td><td Class=rowpic>Unit Price</td><td Class=rowpic>Total Amount</td><TD Class=rowpic>Vendor Name</td></tr>";
		for($j=0;$j<rowcount($rs1);$j++)
		{
			$r1=fetcharray($rs1,$j);
			echo "<tr><td><input type=radio name=id OnClick='CheckValue($r1[qid])'>$r1[QuotNo]</td>";
			echo "<td>".date("d-m-Y",strtotime($r1[QuotDate]))."</td><td>$r1[asset_name]</td><td>$r1[quantity]</td><td>$r1[unitprice]</td>";
			echo "<td>$r1[total_price]</td><td>$r1[name]</td></tr>";
		}
		echo "<tr><td colspan=7 align=center><input type=submit value='Process Quotation' class=bgbutton></td></tr>";
		echo "</table>";
	}
	else
	{
		echo "<font color=brown><b>No Quotations Have been Entered !!</B></font>";
		die();
	}
}
?>
<input type="hidden" name="checkid">
</form>
</body>
</html>
