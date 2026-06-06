<html>
<head><title>Modify Puchase Order</title>
<Script language="JavaScript">

	function RefreshMe()
	{
		document.frm.action="ModifyPO.php";
		document.frm.submit();
	}
//this is added by shashidhar to validate the total amount on 02-06-2006
function validate()
{
	if(document.frm.total_bill_amount.value=="" || document.frm.total_bill_amount.value <=0)
	{
		alert("Enter The  Valid Amount");
		document.frm.total_bill_amount.focus();
		return false;
}
else
	{
document.frm.action="InsModifyPO.php";
	document.frm.submit();
	}
}
//--------------------------------Added By Shashidhar--------------------------
</script>
</head>
<?php
	session_start();

	include("../db.php");
	
	$print = $_POST['print'];
	$PONum = $_POST['PONum'];
$search_po = $_POST['search_po'];

?>
<body>
<form method="post" name="frm">
<table class=forumline align=center >
<tr><td Class="head" ALIGN=CENTER colspan="3">Modify Purchase Order</td></tr>
<tr><td class=rowpic>Enter Purchase Order No</td><td class=rowpic><input type="text" name="PONum" size="10" value="<?=$PONum?>"><input type="submit" name="search_po" value="Search PO" class=bgbutton></td></tr>
</table>
<?php
	if(isset($search_po))
	{
		echo "select * from PurchaseOrderMaster where PONumber='".strtoupper($PONum)."' and status='Pending'";
		$sql=execute("select * from PurchaseOrderMaster where PONumber='".strtoupper($PONum)."' and status='Pending'");

		if(rowcount($sql)==0)
		{
			echo "<font color=red><b>Purchase Order Details Not Found !!</b></font>";
			die();
		}
		else
		{
			$rs=fetcharray($sql);

			$sql1=execute("select * from VendorMaster_Assets where id=$rs[vendor_id]") or die(error_description());
			$rs1=fetcharray($sql1);

			$PODate=explode("-",$rs["PODate"]);
			echo "<table border=1>";
			echo "<tr><td Class=CHead colspan=2>Purchase Order Details</td></tr>";
			echo "<tr><td>Purchase Order Number</td><td>$rs[PONumber]</td></tr>";
			echo "<tr><td>Purchase Order Date</td><td>";
			echo "<input type=text size=2 maxlength=2 name=PODay value=$PODate[2]>-";
			echo "<input type=text size=2 maxlength=2 name=POMon value=$PODate[1]>-";
			echo "<input type=text size=4 maxlength=4 name=POYear value=$PODate[0]>";
			echo "</td></tr>";
			echo "<tr><td>Vendor Details</td><td>$rs1[name]<br>$rs1[address]<br>Phone : $rs1[phone] Fax : $rs1[fax]<br></td></tr>";

			$subject=explode("#*",$rs["remarks"]);
			for($i=0;$i<8;$i++)
			{
				echo "<tr><td colspan=2><input type=text size=80 name='text".($i+1)."' value='$subject[$i]'></td></tr>";
			}

			echo "</table>";
			echo "<table border=1>";
			echo "<tr><td Colspan=5>Item / Asset Details</td></tr>";
			echo "<tr><td>Select</td><td>Asset Name</td><td>Quantity</td><td>Unit Price</td><td>Total</td></tr>";

			$sql2=execute("select a.*,b.*,a.id as myid from PurchaseOrderDetails a,asset_master b where a.PO_ID=$rs[id] and a.asset_id=b.id");

			for($j=0;$j<rowcount($sql2);$j++)
			{
				$r2=fetcharray($sql2,$j);

				echo "<tr><td><input type=checkbox name=id[] value='$r2[myid]' checked></td>";
				echo "<td>$r2[asset_name]</td><td><input type=text size=10 name='quantity$r2[myid]' value=$r2[quantity]></td>";
				echo "<td><input type=text size=20 name='unitprice$r2[myid]' value=$r2[unitprice]></td>";
				echo "<td><input type=text size=20 name='totalprice$r2[myid]' value=$r2[totalprice]></td></tr>";
			}
			echo "</table>";

			echo "<input type=hidden name=poid value=$rs[id]>";
			echo "<input type=hidden name=vendorid value=$rs[vendor_id]>";
			echo "<input type=hidden name='PersonName' value='$user'>";

			echo "<table border=1>";
			echo "<tr><td>Additional Charges</td><td><input type=text name='add_charges' value=$rs[additional_charges]></td></tr>";
			echo "<tr><td>Total Bill Amount</td><td><input type=text name='total_bill_amount' value=$rs[total_bill_amount]></td></tr>";
			echo "</table>";
			echo "<table border=1>";
			echo "<tr><td ><b>TERMS & CONDITIONS</td></tr>";
			$condition=explode("#*",$rs["conditions"]);
			for($i=0;$i<10;$i++)
			{
				echo "<tr><td><input type=text size=80 name='condition".($i+1)."' value='$condition[$i]'></td></tr>";
			}

			echo "<tr><td align='center'><input type=button value='Modify Purchase Order' onClick='validate()' class='bgbutton'></td></tr>";
			echo "</table>";


		}
	}
?>
</form>
</body>
</html>
