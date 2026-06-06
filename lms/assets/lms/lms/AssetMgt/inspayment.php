<?php

/*

	Copyright  2001 ABNIPL, Bangalore. All rights reserved.
	File Name : InsFinalPayment.php
	Database indus
	Tables used : VendorMaster_Assets, vendor_final_pay, Purchase_Order and Temp_Accounts_AssetManagement
	Purpose---> Purpose of this file is for Accounts Automation
	From this file the control passes to Automation_Functions.php

*/

	session_start();
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

//	$compid = Company_Id(indus);	// ACCOUNTS AUTOMATION 1.
	$d=explode("-",date("d-m-Y"));

//This query is used to select the details from VendorMaster_Assets table

	$vsql=execute("select * from VendorMaster_Assets where id=$VendorId");
	$vrs=fetcharray($vsql);
	$PaymentDate=$d[2]."-".$d[1]."-".$d[0];
	$vendor_ledger = $vrs["ledger_id"];	// ACCOUNTS AUTOMATION 2.

	if($advance=='ADVANCE')
	{
		$sqlp="insert into vendor_final_pay(poid,vendor_id,cashamount,";
		$sqlp.=" chequeamount,chequeno,chequedate,bankname,paymentdate,paytype)values($POID,$VendorId,'$chequec',";
		$sqlp.=" $chequeamt,'$chequeno','$ChequeDate','$bankname','$PaymentDate','ADVANCE')";

	}
	elseif($advance=='INSTALMENT')
	{
        $sqlp="insert into vendor_final_pay(poid,vendor_id,cashamount,";
		$sqlp.=" chequeamount,chequeno,chequedate,bankname,paymentdate,paytype)values($POID,$VendorId,'$chequec',";
		$sqlp.=" $chequeamt,'$chequeno','$ChequeDate','$bankname','$PaymentDate','INSTALMENT')";

	}
	elseif($advance=='FINAL')
	{
                $sqlp="insert into vendor_final_pay(poid,vendor_id,cashamount,";
		$sqlp.=" chequeamount,chequeno,chequedate,bankname,paymentdate,paytype)values($POID,$VendorId,'$chequec',";
		$sqlp.=" $chequeamt,'$chequeno','$ChequeDate','$bankname','$PaymentDate','FINAL')";

	}
	execute($sqlp) or die(error_description());
	//echo "geeta".$sqlp;

	if($cheque==on && $cash==on)
	{
		$status="BOTH";
		$ChequeDate=$ChequeYear."-".$ChequeMonth."-".$ChequeDay;
		$total_amt = $cashamt + $chequeamt;
		$dispdate = date("d-m-Y", strtotime($ChequeDate));

		// ACCOUNTS AUTOMATION 3.
		// BEGINS HERE.
		// STORAGE OF PAYMENT VOUCHER DETAILS IN TEMP ACCOUNTS TABLE FOR ASSET MANAGEMENT.

// This query is used  delete the details from Temp_Accounts_AssetManagement table

		$query  = "DELETE FROM Temp_Accounts_AssetManagement";
		execute($query) or die("QUERY $query : " . error_description());

		$narrate = "PO No.:$PONum / Cheque No.:$chequeno/$dispdate";
		$serial = 1;
		//********** Debit Entry ***************//


// This query is used insert the details into Temp_Accounts_AssetManagement table


		$query  = "INSERT INTO Temp_Accounts_AssetManagement(Sl_No, GID, Nature, ";
		$query .= "Amount, Narration, Date) VALUES($serial, '$vendor_ledger', 'Dr', ";
		$query .= "$total_amt, '$narrate', '$PaymentDate')";
		execute($query) or ("QUERY $query : " . error_description());


//		echo "$query<BR><BR>";

		//********* Credit Entries *************//

// This query is used insert the details into Temp_Accounts_AssetManagement table

		$serial++;
		$query  = "INSERT INTO Temp_Accounts_AssetManagement(Sl_No, GID, Nature, ";
		//$query .= "Amount, Narration, Date) VALUES($serial, 'LD00009', 'Cr', $cashamt, ";
		$query .= "Amount, Narration, Date) VALUES($serial, '$cashname', 'Cr', $cashamt, ";

		$query .= "'$narrate', '$PaymentDate')";
		execute($query) or ("QUERY $query : " . error_description());
//		echo "$query<BR><BR>";

// This query is used insert the details into Temp_Accounts_AssetManagement table

		$serial++;
		$query  = "INSERT INTO Temp_Accounts_AssetManagement(Sl_No, GID, Nature, ";
		$query .= "Amount, Narration, Date) VALUES($serial, '$bankname', 'Cr', $chequeamt, ";
		$query .= "'$narrate', '$PaymentDate')";
		execute($query) or ("QUERY $query : " . error_description());
//		echo "$query<BR><BR>";

		//Payment_Voucher($compid, "Temp_Accounts_AssetManagement");
		// ENDS HERE.

// This query is used insert the details into vendor_final_pay table

		$sql="insert into vendor_final_pay(poid,vendor_id,ptype,cashamount,";
		$sql.=" chequeamount,chequeno,chequedate,bankname,paymentdate)values($POID,$VendorId,'BOTH','$chequec',";
		$sql.=" $chequeamt,'$chequeno','$ChequeDate','$bankname','$PaymentDate')";
	}
	elseif($cheque==on && $cash=="")
	{
		$status="Cheque";
		$ChequeDate=$ChequeYear."-".$ChequeMonth."-".$ChequeDay;
		$total_amt = $chequeamt;
		$dispdate = date("d-m-Y", strtotime($ChequeDate));

/*		// ACCOUNTS AUTOMATION 3.
		// BEGINS HERE.
		// STORAGE OF PAYMENT VOUCHER DETAILS IN TEMP ACCOUNTS TABLE FOR ASSET MANAGEMENT.

// This query is used delete the details from Temp_Accounts_AssetManagement table

		$query  = "DELETE FROM Temp_Accounts_AssetManagement";
		execute($query) or die("QUERY $query : " . error_description());

		$narrate = "PO No.:$PONum / Cheque No.:$chequeno/$dispdate";
		$serial = 1;
		//********** Debit Entry ***************
// This query is used insert the details into Temp_Accounts_AssetManagement table

		$query  = "INSERT INTO Temp_Accounts_AssetManagement(Sl_No, GID, Nature, ";
		$query .= "Amount, Narration, Date) VALUES($serial, '$vendor_ledger', 'Dr', ";
		$query .= "$total_amt, '$narrate', '$PaymentDate')";
		execute($query) or ("QUERY $query : " . error_description());
//		echo "$query<BR><BR>";

		//********* Credit Entry *************

// This query is used insert the details into Temp_Accounts_AssetManagement table

		$serial++;
		$query  = "INSERT INTO Temp_Accounts_AssetManagement(Sl_No, GID, Nature, ";
		$query .= "Amount, Narration, Date) VALUES($serial, '$bankname', 'Cr', $chequeamt, ";
		$query .= "'$narrate', '$PaymentDate')";
		execute($query) or ("QUERY $query : " . error_description());
//		echo "$query<BR><BR>";

		Payment_Voucher($compid, "Temp_Accounts_AssetManagement");
		// ENDS HERE.  */

//This query is used insert the details into vendor_final_pay table

		$sql="insert into vendor_final_pay(poid,vendor_id,ptype,cashamount,";
		$sql.=" chequeamount,chequeno,chequedate,bankname,paymentdate) values($POID,$VendorId,'CHEQUE',0,";
		$sql.=" $chequeamt,'$chequeno','$ChequeDate','$bankname','$PaymentDate')";
	}
	elseif($cheque=="" && $cash==on)
	{
		$status="Cash";
		$total_amt = $cashamt;

/*		// ACCOUNTS AUTOMATION 3.
		// BEGINS HERE.
		// STORAGE OF PAYMENT VOUCHER DETAILS IN TEMP ACCOUNTS TABLE FOR ASSET MANAGEMENT.

//This query is used delete the details from Temp_Accounts_AssetManagement table

		$query  = "DELETE FROM Temp_Accounts_AssetManagement";
		execute($query) or die("QUERY $query : " . error_description());

		$narrate = "PO No.:$PONum";
		$serial = 1;
		//********** Debit Entry ***************

//This query is used insert the details into Temp_Accounts_AssetManagement table

		$query  = "INSERT INTO Temp_Accounts_AssetManagement(Sl_No, GID, Nature, ";
		$query .= "Amount, Narration, Date) VALUES($serial, '$vendor_ledger', 'Dr', ";
		$query .= "$total_amt, '$narrate', '$PaymentDate')";
		execute($query) or ("QUERY $query : " . error_description());
//		echo "$query<BR><BR>";

		//********* Credit Entry *************

//This query is used insert the details into Temp_Accounts_AssetManagement table

		$serial++;
		$query  = "INSERT INTO Temp_Accounts_AssetManagement(Sl_No, GID, Nature, ";
//		$query .= "Amount, Narration, Date) VALUES($serial, 'LD00009', 'Cr', $cashamt, ";
		$query .= "Amount, Narration, Date) VALUES($serial, '$cashname', 'Cr', $cashamt, ";

		$query .= "'$narrate', '$PaymentDate')";
		execute($query) or ("QUERY $query : " . error_description());
//		echo "$query<BR><BR>";

		Payment_Voucher($compid, "Temp_Accounts_AssetManagement");
		// ENDS HERE. */

//This query is used insert the details into vendor_final_pay table

		$sql="insert into vendor_final_pay(poid,vendor_id,ptype,cashamount,paymentdate,chequeamount)";
		$sql.=" values($POID,$VendorId,'CASH','$chequec','$PaymentDate',0)";
	}
	execute($sql) or die(error_description());
	

	if(($TotalAmtPaid+($cashamt+$chequec))==($TotalPOAmount))
	{

//This query is used update Purchase_Order table

		execute("update Purchase_Order set status='Closed' where id=$POID");
		echo "<font color=blue><b>All the Pending Payments of M/s.".$vrs[name]." has been Cleared & The Purchase Order ".strtoupper($PONum)." is closed.<br></b></font>";
		echo "<font color=blue><b>An Amount os Rs.".($chequeamt+$chequec)." has been Paid !!</b></font>";
	}
	else
	{
		echo "<font color=blue><b>Amount of Rs.".($chequeamt+$chequec)." Paid to M/s.".$vrs[name]." against Purchase Order No :".strtoupper($PONum)."</b></font>";
	}
?>
