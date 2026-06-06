<html>

<head>

<script language="JavaScript">

	function RefreshMe()

	{

		document.frm.action="Quotation.php";

		document.frm.submit();

	}



	function CalculateTotal()

	{

		qty=parseInt(document.frm.quantity.value);

		uprice=parseInt(document.frm.unitprice.value);

		document.frm.totalprice.value=parseFloat(qty*uprice);

	}

</script>



<?php

session_start();

include("../db.php");

include("../urlaccess.php");

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



$today=explode("-",date("d-m-Y"));



$RIN = $_POST['RIN'];

$quantity = $_POST['quantity'];

$unitprice = $_POST['unitprice'];

$totalprice = $_POST['totalprice'];

$vendor_id = $_POST['vendor_id'];

$QuotNo = $_POST['QuotNo'];

$QuotDay = $_POST['QuotDay'];

$QuotMon = $_POST['QuotMon'];

$QuotYear = $_POST['QuotYear'];

$asset_id = $_POST['asset_id'];



?>

<body>

<form method="post" name="frm" action="InsQuotationDetails.php">

<table class="forumline" align="center">

<tr><td colspan=2 Class="head">Add Quotation Details</td></tr>

<tr><td class=rowpic>Requirement Indent No</td><td class=rowpic><select name="RIN" onChange="RefreshMe()">

<option value="-1">Select Requirement Indent No</option>

<?php

	$sql=execute("select * from requirementindent where POStatus='Pending'");



	for($i=0;$i<rowcount($sql);$i++)

	{

		$r=fetcharray($sql,$i);



		if($RIN==$r[id])

		{

			echo "<option value=$r[id] selected>$r[RINumber]-".date("d-m-Y",strtotime($r[RDate]))."</option>";

		}

		else

		{

			echo "<option value=$r[id]>$r[RINumber]-".date("d-m-Y",strtotime($r[RDate]))."</option>";



		}

	}

?>

</select>

</td></tr>

<?php

if($RIN<>'')

{

	$sql="select a.asset_name,b.quantity,a.id  as aid from asset_master a,requirementindent b where a.id=b.asset_id and b.id=$RIN";



	$rs=execute($sql) or die(error_description());

	$r=fetcharray($rs);

if(rowcount($rs)>=1)

{

?>

<tr><td>Asset Name</td><td><?=$r[asset_name]?></td></tr>

<tr><td>Quantity</td><td><input type="text" name="quantity" value="<?=$r[quantity]?>"></td></tr>

<tr><td>Unit Price</td><td><input type="text" name="unitprice" value="<?=$unitprice?>" onBlur="CalculateTotal()"></td></tr>

<tr><td>Total Price</td><td><input type="text" name="totalprice" value="<?=$totalprice?>" readonly></td></tr>

<tr><td>Vendor</td>

<td><select name="vendor_id">

<?php

	$q1=execute("select * from vendormaster_assets");



	for($j=0;$j<rowcount($q1);$j++)

	{

		$r1=fetcharray($q1,$j);

		echo "<option value=$r1[id]>$r1[name]</option>";

	}

?>

</select>

</td></tr>

<tr><td>Quotation Number</td><td><input type="text" name="QuotNo" value="<?=$QuotNo?>">

<tr><td>Quotation Date</td>

<td>

<input type="text" name="QuotDay" size="2" maxlength="2" value="<?=$today[0]?>">

<input type="text" name="QuotMon" size="2" maxlength="2" value="<?=$today[1]?>">

<input type="text" name="QuotYear" size="4" maxlength="4" value="<?=$today[2]?>">

</td></tr>



<?php

}

else

{

	echo "<font color=blue>No Data Found !!</b></font>";

}

}

?>

</table><br>
<div align=center><input type="submit" value="SAVE" class=bgbutton></div>

<input type="hidden" name="asset_id" value="<?=$r[aid]?>">

</form>

</body>

</html>



