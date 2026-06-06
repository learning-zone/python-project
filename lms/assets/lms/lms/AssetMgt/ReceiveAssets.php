<html>
<head>
<script language="JavaScript">
function RefreshMe()
{
	
	document.frm.action="ReceiveAssets.php";
	document.frm.submit();

}
</script>
</head>
<?php
session_start();
include("../db.php");


$PONum = $_POST['PONum'];
$username = $_POST['username'];
$POStatus = $_POST['POStatus'];
$vendor = $_POST['vendor'];
$filename = $_POST['filename'];
$printpo = $_POST['printpo'];

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
?>
<body>
<form name="frm" method="post" action="InsReceiveAssets.php">
<table class=forumline align=center>
<tr><td Class="head" align=center colspan=2>Receive Assets</td></tr>
<tr><td class=rowpic>Select Purchase Order No</td><td class=rowpic><select name="PONum" onChange="RefreshMe()">
<option value="-1">Select Purchase Order</option>
<?php
$sql="select * from purchaseordermaster where status='Pending' or status='Partly Received' and POType='NEW'";
$rs=execute($sql) or die(error_description()."error2");
for($i=0;$i<rowcount($rs);$i++)
{
	$r=fetcharray($rs,$i);
	if($r[id]==$PONum)
	{
		echo "<option value=$r[id] selected>$r[PONumber]==>".date("d-m-Y",strtotime($r[PODate]))."</option>";
		$POStatus=$r["status"];
		$VendorId=$r["vendor_id"];
	}
	else
	{
		echo "<option value=$r[id]>$r[PONumber]==>".date("d-m-Y",strtotime($r[PODate]))."</option>";
	}
}
?>
</select></td></TR>
<?php
if($PONum=="")
{
	die("Select Purchase Order No");
}
if($PONum<>'')
{
	$sql11=execute("select * from vendormaster_assets where id=$VendorId");
	$rs11=fetcharray($sql11);
	echo "<table class=forumline align=center>";
	echo "<tr><td Class=rowpic>Vendor Name & Address</td><td colspan=2>$rs11[name]<br>$rs11[address]</td>";
	echo "<tr><td Class=rowpic>Select</td><td Class=rowpic>Asset Name</td>";
	echo "<td Class=rowpic>Quantity</td></tr>";
	$nsql="select a.*,b.* from purchaseorderdetails a,asset_master b where ";
	$nsql.=" a.asset_id=b.id and a.PO_ID=$PONum";
	$nrs=execute($nsql) or die(error_description()."error1");
	if($POStatus=="Partly Received")
	{
		for($i=0;$i<rowcount($nrs);$i++)
		{
			$nr=fetcharray($nrs,$i);
			$nsql22=execute("select sum(received_qty) as rqty from asset_received_details where po_number=$PONum and asset_id=$nr[asset_id]") or die(error_description()."error3");
			$nrs22=fetcharray($nsql22);
			if($nrs22["rqty"]=="NULL")
			{
				$PendingQty=$nr["quantity"];
			}
			else
			{
				$ReceivedQty=$nrs22["rqty"];
				$PendingQty=$nr["quantity"]-$ReceivedQty;
			}
			echo "<tr><td><input type=checkbox name=id[] value='$nr[PO_ID]-$nr[asset_id]'></td>";
			echo "<td>$nr[asset_name]</td><td><input type=text name='quantity-$nr[PO_ID]-$nr[asset_id]' value='$PendingQty' size='8' readonly></td></tr>";
		}
	}
	else
	{
		for($i=0;$i<rowcount($nrs);$i++)
		{
			$nr=fetcharray($nrs,$i);
			echo "<tr><td><input type=checkbox name=id[] value='$nr[PO_ID]-$nr[asset_id]'></td>";
			echo "<td>$nr[asset_name]</td><td><input type=text name='quantity-$nr[PO_ID]-$nr[asset_id]' value='$nr[quantity]' size='8' readonly></td></tr>";
		}
	}
	echo "</table>";
}

	
?>
<input type="hidden" name="username" value="<?=$user?>">
<input type="hidden" name="POStatus" value="<?=$POStatus?>">
<input type="hidden" name="vendor" value="<?=$VendorId?>">
<br>
<div align=center>
<input type="submit" value="Receive Materials" class=bgbutton>
</div>
</form>
</body>
</html>