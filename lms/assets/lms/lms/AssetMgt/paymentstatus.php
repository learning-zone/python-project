<html>
<head><title>Final Payment</title>
<Script language="JavaScript">
<!--

// This is used for validation purpose to check whether Amount is more than balance amount

function ValidateAmount()
{
	ChequeAmt=document.frm.chequeamt.value;
	CashAmt=document.frm.cashamt.value;
	TotalPOAmt=parseInt(document.frm.TotalPOAmount.value);
	TotalAmtPaid=parseInt(document.frm.TotalAmtPaid.value);
	AmtPayable=parseInt(ChequeAmt)+parseInt(CashAmt);
	BalancePayable=parseInt(document.frm.BalancePayable.value);
	MaterialsReceivedAmt=parseInt(document.frm.MaterialsReceivedAmt.value);
	var cashbalance = parseInt(document.frm.cash_balance.value);

	if(AmtPayable>BalancePayable)
	{
		alert("Amount Payable Cannot Exceed Rs."+(BalancePayable));
		document.frm.chequeamt.focus();
		return false;
	}
	else if (document.frm.cash_type.value == "Dr")
	{
		if (CashAmt > cashbalance)
		{
			alert("Cash Amount should not exceed the existing balance !!");
			document.frm.CashAmt.focus();
			return false;
		}
	}
	else if (document.frm.cash_type.value == "Cr")
	{
		alert ("You should not pay by Cash!! Cash amount already showing Credit balance!!");
		document.frm.CashAmt.focus();
		return false;
	}
	else
	{
		document.frm.submit();
		return true;
	}
}
function lnb()
{
if(document.tempfrm.PONum.value=="")
	{
         alert("Enter The  Purchase Order Number");
		document.tempfrm.PONum.focus();
	  	 return false;
	}
	return true;
}
//
-->

</Script></head>
<?php

/*
Copyright  2001 ABNIPL, Bangalore. All rights reserved.
Modified by Muzammil Ahmed A on 08-Feb-2005
File Name : FinalPayment.php
Database indus
Tables used : VendorMaster_Assets, Purchase_Order, vendoradvancedetails, vendorinstallmentdetails, individual_asset_details, vendor_final_pay and LD$compid
Purpose---> Purpose of this file is to display a entry form to enter the Final Payment Details
From this file the control passes to InsFinalPayment.php
*/

session_start();
//include("../urlaccess.php");
include("../db.php");

$PONum = $_POST['PONum'];
$search = $_POST['search'];
$bankname = $_POST['bankname'];
$TotalPOAmount = $_POST['TotalPOAmount'];
$TotalAmtPaid = $_POST['TotalAmtPaid'];
$MaterialsReceivedAmt = $_POST['MaterialsReceivedAmt'];
$BalancePayable = $_POST['BalancePayable'];
$VendorId = $_POST['VendorId'];
$POID = $_POST['POID'];



$compid = Company_Id(indus);	// ACCOUNTS AUTOMATION 1.
$d=explode("-",date("d-m-Y"));
$flag=0;
?>
<body>
<form method="post" name="tempfrm" action="paymentstatus.php">
<table class=forumline align=center>
	<tr><td Class=head colspan=2 align=center><font face='Lucida Sans' size='3'>Maintainence Payment Details</font></td></tr>
	<tr>
		<td><font face='Lucida Sans' size='1.8'>Enter Purchase Order No</font></td>
		<td><input type="text" name="PONum" value="<?php echo $PONum?>">
		<input type="submit" name="search" value="Search" class=bgbutton onClick='return lnb()'></td></tr></table></form>
<form name="frm" method="post" action="inspayment.php" onSubmit="return ValidateAmount(this.form)">
<?php
if(isset($search))
{

//This query is used to select the details from Purchase_Order and VendorMaster_Assets tables
	// echo ("select a.*,b.*,a.id as POID from Purchase_Order a,VendorMaster_Assets b where a.PONumber='$PONum' and a.status='Completely Received' and a.vendor_id=b.id");

	$sql=execute("select a.*,b.*,a.id as POID from Purchase_Order a,VendorMaster_Assets b where a.PONumber='$PONum' and a.status='Pending' and a.Recieved_status='' and a.vendor_id=b.id");
	
	if(rowcount($sql)==0)
	  {
		echo "<font color=brown><b>No Details Found</b></font>";
		die();
	  }

	  $rs=fetcharray($sql);

//This query is used to select the details from vendoradvancedetails table

   /*$sql1="select * from vendoradvancedetails where vendor_id=$rs[vendor_id] ";
   $sql1.=" and poid = $rs[POID]";
	$rs1=execute($sql1);
	$AdvanceAmountPaid=0;
	if(rowcount($rs1)>=1)
	{
		for($k=0;$k<rowcount($rs1);$k++)
		{
			$r1=fetcharray($rs1,$k);
			$AdvanceAmountPaid=$AdvanceAmountPaid+($r1[cashamount]+$r1[chequeamount]);
		}
	}

//This query is used to select the details from vendorinstallmentdetails table

	$sql22="select * from vendorinstallmentdetails where vendor_id=$rs[vendor_id] ";
	$sql22.=" and poid = $rs[POID]";
	$rs22=execute($sql22) or die(error_description());
	$InstallmentAmtPaid=0;
	if(rowcount($rs22)>=1)
	{
		for($j=0;$j<rowcount($rs22);$j++)
		{
			$r22=fetcharray($rs22,$j);
			$InstallmentAmtPaid=$InstallmentAmtPaid+($r22[cashamount]+$r22[chequeamount]);
		}
	}*/

//This query is used to select the details from vendor_final_pay table

	$sql33="select * from vendor_final_pay where vendor_id=$rs[vendor_id] ";
	$sql33.=" and poid = $rs[POID]";
	$rs33=execute($sql33) or die(error_description());
	$FinalAmtPaid=0;
	if(rowcount($rs33)>=1)
	{
		for($j=0;$j<rowcount($rs33);$j++)
		{
			$r33=fetcharray($rs33,$j);
			$FinalAmtPaid=$FinalAmtPaid+($r33[cashamount]+$r33[chequeamount]);
		}
	}
	$TotalAmountPaid=($AdvanceAmountPaid+$InstallmentAmtPaid+$FinalAmtPaid);
	echo "<table class=forumline align=center>";

//Modified by Muzammil Ahmed A on 08-Feb-2005
//The display format was not correct it has been rectified

	echo "<tr><td Class=row3 colspan=3 align=center>Bill Payment Details</td></tr>";
	echo "<tr><td><input type=radio name='advance' value='ADVANCE'>Advance</td>";
	echo "<td><input type=radio name='advance' value='INSTALMENT'>Installment</td>";
	echo "<td><input type=radio name='advance' value='FINAL'>Final Payment</td></tr>";
	echo "<tr><td>Vendor</td><td>$rs[name]</td></tr>";
	echo "<tr><td>Total Purchase Order Amount</td><td>Rs.$rs[total_bill_amount]</td></tr>";
	if($TotalAmountPaid==0)
	{
		echo "<tr><td>Total Amount Paid</td><td>NIL</td></tr>";
	}
	else
	{
		echo "<tr><td>Total Amount Paid</td><td>Rs.$TotalAmountPaid</td></tr>";
	}

//This query is used to select the details from individual_asset_details table

	// echo ("select * from individual_asset_details where status='false' and condition='Working' and PO_ID=$rs[POID]");

	$sql33=execute("select * from individual_asset_details where status='false' and condition='Working' and PO_ID=$rs[POID]");
	$MaterialsReceived=0;
	$MaterialsReceived=$MaterialsReceived+$rs[additional_charges];
	$BalancePayable=$MaterialsReceived-$TotalAmountPaid;

	// ACCOUNTS AUTOMATION 2
if(rowcount($sql33)>=1)
	{
	    // echo "<br>rowcount($sql33)";
		for($m=0;$m<rowcount($sql33);$m++)
		{
			$rs33=fetcharray($sql33,$m);
			$MaterialsReceived=$MaterialsReceived+$rs33[4];  
		}
	}

//This query is used to select the details from LD$compid table

    /*
    commented on 11/04/2005 by k.c.
    dynamically fetching cashbook from Ld1010405 from dropdown box

	$query  = "SELECT Closing_Balance, OBType FROM LD$compid WHERE LID='LD00009'";
	$res = execute($query) or die("QUERY $query : " . error_description());
	$rw = fetcharray($res);
	$cashbal = $rw["Closing_Balance"] . " " . $rw["OBType"];
	echo "<INPUT TYPE=HIDDEN NAME=cash_balance VALUE='$rw[Closing_Balance]'>";
	echo "<INPUT TYPE=HIDDEN NAME=cash_type VALUE='$rw[OBType]'>";
	mysql_free_result($res);

	*/

	//


	echo "<tr><td>Amount of Materials Received</td><td>Rs.$MaterialsReceived</td></tr>";
	echo "<tr><td>Balance Payable Amount</td><td>Rs.$BalancePayable</td></tr>";
	// echo "<tr><td><input type=checkbox name='cash'>CASH</td>";
	// echo "<td><input type=text name='cashamt' value=0></td></tr> "; // &nbsp;&nbsp;<I><FONT COLOR=#FF0000>(Balance : $cashbal)</FONT></I></td></tr>";
	echo "<tr><td><input type=checkbox name='cash'>CASH</td><td><input type=text name='chequec' value=0></td></tr>";
	echo "<tr><td><input type=checkbox name='cheque'>CHEQUE</td><td><input type=text name='chequeamt' value=0></td></tr>";
	echo "<tr><td>Cheque No</td><td><input type=text name=chequeno></td></tr>";
    echo "<tr><td>Cheque Date</td>";
	echo "<td><input type=text size=2 maxlength=2 name='ChequeDay' value='$d[0]'>";
	echo "<input type=text size=2 maxlength=2 name='ChequeMonth' value='$d[1]'>";
	echo "<input type=text size=4 maxlength=4 name='ChequeYear' value='$d[2]'></td></tr>";
	echo "<tr>";
		echo "<td>Bank Name</td>";
		echo "<td>";?>
		
		<select name='bankname'>
 <?php 
$rs_sql=execute("select * from bank_details");
if(rowcount($rs_sql)>0)
{
	for($z=0;$z<rowcount($rs_sql);$z++)
	{
		$r_sql=fetcharray($rs_sql,$z);
		echo "<option value='$r_sql[ledger_id]'> $r_sql[bank_name] </option>";

	}
}
?>
</select><?php 
		echo "</td>";
	echo "</tr>";

//This query is used to select the details from LD$compid table Cash Book
// newly added on 11/04/2005 by k.c.
/*
	    echo "<tr>";
		echo "<td>CashBook Name</td>";
		echo "<td>";

		$query  = "SELECT LID, Name, Closing_Balance, OBType FROM LD$compid ";
		$query .= "WHERE ID='MG19' AND SGID='SG01' ORDER BY Name ASC";
		$res = execute($query) or die("QUERY $query : " . error_description());
		if (rowcount($res) > 0)
		{
			echo "<SELECT NAME=cashname SIZE=1>";
			while ($rw = fetcharray($res))
			{
				echo "<OPTION VALUE='$rw[LID]'>$rw[Name] --> Bal. $rw[Closing_Balance] $rw[OBType]</OPTION>";
			}
			mysql_free_result($res);
			echo "</SELECT>";
		}
		else
		{
			echo "<FONT COLOR=#FF0000 SIZE=2><B>Cash Ledgers are not created!! Please don't pay!! Contact Administrator!!</B></FONT>";
		}
		echo "</td>";
	echo "</tr>";  */

	// ENDS .

	// ENDS .


//Modified by Muzammil Ahmed A on 08-Feb-2005
//The Format of Pay Amount was not good it has been corrected

	echo "<tr><td colspan=5 align=center><input type=submit class=bgbutton value='Pay Amount'></td></tr>";
	echo "</table>";
}
?>
<input type="hidden" name="TotalPOAmount" value="<?php echo $rs[total_bill_amount]?>">
<input type="hidden" name="TotalAmtPaid" value="<?php echo $TotalAmountPaid?>">
<input type="hidden" name="MaterialsReceivedAmt" value="<?php echo $MaterialsReceived?>">
<input type="hidden" name="BalancePayable" value="<?php echo $BalancePayable?>">
<input type="hidden" name="VendorId" value="<?php echo $rs[vendor_id]?>">
<input type="hidden" name="POID" value="<?php echo $rs[POID]?>">
<input type="hidden" name="PONum" value="<?php echo $PONum?>"></form></body></html>
