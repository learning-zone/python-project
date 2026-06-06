<?
/*
   MG23   other miscellaneous expenses
   project		: mef
   database		:mef;
   purpose		: option provided to select tax details
   modified		: k.c. accounts automation
*/
?>
<html>
<head>

<script language="JavaScript">
function RefreshMe()
{
	document.frm.action="PurchaseOrder.php";
	document.frm.submit();
}
//Added by shashidhar on 13-06-2006------to calculate PO Amount auto matically--------
var total = 0;
function addTotal(i,flag)
{
total = parseFloat(document.frm.total_bill_amount.value);
document.frm.total_bill_amount.value=0;
var tot= 0;
tot = parseFloat(eval("document.frm.totalprice" + i + ".value"));
if(flag)
{
total += parseFloat(tot);
temp_ref="document.frm.totalprice"+i;
temp_ref.value=3232;
}
else
{
total -= parseFloat(tot);
}
document.frm.total_bill_amount.value = parseFloat(total);
}
function dbn()
{
	var bh=0;
	bh=parseFloat(document.frm.add_charges.value);
	var tv=parseFloat(document.frm.total_bill_amount.value);
	var ttt=parseFloat(tv)+parseFloat(bh);
	document.frm.total_bill_amount.value=ttt;
}
function dbn2()
{
	var bu=0;
	bu=parseFloat(document.frm.oth_charges.value);
	var tvs=parseFloat(document.frm.total_bill_amount.value);
	var ttt1=parseFloat(tvs)+parseFloat(bu);
	document.frm.total_bill_amount.value=ttt1;
}
//Added by shashidhar on 13-06-2006------to calculate PO Amount auto matically--------
</script>
</head>
<?php
session_start();
include("../db.php");
include("../urlaccess.php");
$vendor = $_POST['vendor'];
$idr = $_POST['idr'];
$quant1 = $_POST['quant1'];
$quant2 = $_POST['quant2'];

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

//modified by shobha ondated 09/06/05
//purpose: no company id was refered to make use in a/c interface part
$compid=Company_Id(mef);
$today=date("d-m-Y");
$sql="select distinct a.* from vendormaster_assets a,quotation b where ";
$sql.=" b.status='Processed' and b.POStatus='Pending' and b.vendor_id=a.id";
//echo $sql;
$rs=execute($sql) or die(error_description());
?>
<body>
<form name="frm" method="post" action="InsPurchaseOrder.php">
<table class='forumline' align='center'>
<tr><td Class="head" colspan="2" align='center'>Process Purchase Order</td></tr>
<tr><td class='rowpic'>Select Vendor</td><td class='rowpic'><select name="vendor" onChange="RefreshMe()"><option value="-1">Select Vendor</option>
<?php
for($i=0;$i<rowcount($rs);$i++)
{
	$r=fetcharray($rs,$i);
	if($vendor==$r[id])
	{
		echo "<option value='$r[id]' selected>$r[name]</option>";
	}
	else
	{
		echo "<option value=$r[id]>$r[name]</option>";
	}
}
?>
</select></td></tr>
</table>
<?php
if($vendor<>'')
{
	$sqlv=execute("select * from vendormaster_assets where id=$vendor");
	$rsv=fetcharray($sqlv);
	echo "<center><b>$Caption</b></center><br>";
	echo "Ref : $SubHead/PO/";
	echo "         /             /";
	echo "Date : $today<br>";
	echo "<b>To,</b> <br>";
	echo "<table>";
	echo "<tr><td>$rsv[contact_person]</td></tr>";
	echo "<tr><td><b>$rsv[name]</b></td></tr>";
	echo "<tr><td>$rsv[address]</td></tr>";
	echo "<tr><td>Phone : $rsv[phone]  Fax : $rsv[fax]</td></tr>";
	echo "</table>";
	echo "<center><b>PURCHASE ORDER</B></CENTER><br>";
	echo "<input type=text name=text1 value='Sub : Supply of Equipments / Material - Reg.' size=85><br>";
	echo "<input type=text name=text2 value='Approval from Purchase Committee meeting held on ' size=85><br>";
	echo "<input type=text name=text3 value='Approval from Chairman, $SubHead on ' size=85><br>";
	echo "<input type=text name=text4 value='With reference to your final Quotation No    dated :     ' size=85><br>";
	echo "<input type=text name=text5 value='regarding supply of Equipments / Materials for our college, we are happy to place an order' size=85><br>";
	echo "<input type=text name=text6 value='for the Equipments / Materials mentioned in the list enclosed.' size=85><br>";
	echo "<input type=text name=text7 size=85><br>";
	echo "<input type=text name=text8 size=85><br>";
	$sql1="select a.*,a.id as QID,b.asset_name,c.id as RID from quotation a ,asset_master b,";
	$sql1.=" requirementindent c where a.vendor_id=$vendor and a.POStatus='Pending'";
	$sql1.=" and a.RID=c.id and a.asset_id=b.id";
	//echo $sql1;
	$rs1=execute($sql1) or die(error_description());
	echo "<table border=1>";
	echo "<tr><td Class=Block>Select</td><td Class=Block>Quotation No</td><td Class=Block>Asset Name</td><td Class=Block>Quantity</td><td Class=Block>Unit Price</td><td Class=Block>Total Price</td></tr>";
	for($j=0;$j<rowcount($rs1);$j++)
	{
		$r1=fetcharray($rs1,$j);
		echo "<tr><td><input type=checkbox name=id[] value='$r1[QID]' onclick='addTotal($r1[QID],this.checked)'></td>";
		echo "<td>$r1[QuotNo]</td><td>$r1[asset_name]</td>";
		echo "<td><input type=text name=quantity$r1[QID] value='$r1[quantity]' size=5></td>";
		echo "<td><input type=text name=unitprice$r1[QID] value='$r1[unitprice]' size=10></td>";
		echo "<td><input type=text name=totalprice$r1[QID] value='$r1[total_price]' size=10></td>";
		echo "<td><input type=hidden name=asstd$r1[QID] value='$r1[asset_id]' size=10></td>";
		echo "</tr>";
		
	}
	 // newly added on 06/06/2005 by kc
    // directly fetching tax and duties ledger from LD$compid
	/*$sql0="select LID,Name from LD$compid where SGID='MG23' and ID='MG23'";
	$sql1=execute($sql0);*/
	echo "<tr><td>Additional Charges</td></tr>";
	//echo "<tr><td><select name=add_chargeshead>";
	echo "<tr><td>Tax Amount</td>";
	/*while($ss=fetcharray($sql1))
	{
		echo "<option value='$ss[0]'>".$ss[1]."</option>";
	}*/
	echo "<td colspan=5><input type=text name=add_charges value='$add_charges' onblur='dbn()' ></td></tr>";
	echo "<tr><td>Other Charges</td>";
	/*while($ss=fetcharray($sql1))
	{
		echo "<option value='$ss[0]'>".$ss[1]."</option>";
	}*/
	echo "<td colspan=5><input type=text name=oth_charges value='$oth_charges' onblur='dbn2()' ></td></tr>";
	//echo "<tr><td>Additional Charges</td><td colspan=5><input type=text name=add_charges value=$add_charges></td></tr>";
	$total_bill_amount=0;
	echo "<tr><td>Total Bill Amount</td><td colspan=5><input type=text name=total_bill_amount value=$total_bill_amount></td></tr>";
	echo "</table>";
	echo "<center><b>TERMS & CONDITIONS</B></CENTER>";
	echo "<input type=text name='condition1' value='1. DELIVERY&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Within    days from the date of receipt of P.O ' size=85><br>";
	echo "<input type=text name='condition2' value='2. INSTALLATION&nbsp;&nbsp;: $Caption' size=85><br>";
	echo "<input type=text name='condition3' value='3. TAX &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: KST against concessional Certificate    ' size=85><br>";
	echo "<input type=text name='condition4' value='4. WARRANTY &nbsp;&nbsp;    : 2 Years from the date of delivery and successfull installation.' size=85><br>";
	echo "<input type=text name='condition5' value='5. SERVICE &nbsp;&nbsp;&nbsp;&nbsp;        : Equipment should be serviced and returned in good working condition' size=85><br>";
	echo "<input type=text name='condition6' value='                     within 48 hours from the time of reporting the problem.' size=85><br>";
	echo "<input type=text name='condition7' value='6. PAYMENT&nbsp;&nbsp;&nbsp;&nbsp;         : Against successful installation and testing.' size=85><br>";
	echo "<input type=text name='condition8' value='7. SPECIFICATIONS&nbsp;&nbsp;&nbsp;&nbsp;  : As given in the list enclosed.' size=85><br>";
	echo "<input type=text name='condition9' size=85><br>";
	echo "<input type=text name='condition10' size=85><br>";
	echo "<br>";
	echo "Thanking You, <br>";
	echo "Yours truly , <br>";
	echo "<br><br><br>";
	echo "Purchase Manager<br>";
	echo "<div align=center>";
	echo "<input type=submit value='Process Purchase Order' class=bgbutton><br>";
	echo "<input type=hidden name='personname' value='$user'>";
	echo "</div>";
	}
?>	
	<input type='hidden' name='idr' value=<?=$r1[total_price]?>>
	<!--<input type=text name='quant' value=<?=$r1[QID]?>>-->
	<input type='hidden' name='quant1' value=<?=$r1[RID]?>>
	Asset ID:<input type='hidden 'name='quant2' value=<?=$r1[asset_id]?>>
</form>
</body>
</html>
