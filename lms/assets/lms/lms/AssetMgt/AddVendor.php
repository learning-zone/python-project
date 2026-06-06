<?php

/*


MODIFICATION DONE ON 11/04/2005 BY K.C.
ACCOUNTS AUTOMATION - Main_Groups,Sub_Groups are changed.

					  Credit Asset purchase
					  By Asset A/c			Dr
					  To Vendor A/c			Cr

					  Cash Asset Purchase
					  By  Asset A/c	        Dr
					  To  Cash A/c		    Cr


					  Payment for Credit AssetPurchase:
					  By Vendor A/c			Dr
					  To Cash / Bank a/c	Cr

// ADD vendor as Sundry Creditors / Suppliers

// MG07 	OTHER LIABILITIES		    Liability 	BalanceSheet  - Main_Groups


*/

session_start();
require("../db.php");
$vendor_name = $_POST['vendor_name'];
$address = $_POST['address'];
$contact_person = $_POST['contact_person'];
$phone = $_POST['phone'];
$fax = $_POST['fax'];
$email = $_POST['email'];
$remarks = $_POST['remarks'];
$compid = Company_Id(mef);	// ACCOUNTS AUTOMATION 1.

if(strlen($vendor_name) && strlen($address))
{

	$sql1=execute("select * from vendormaster_assets where name='$vendor_name'")or die(error_description());
	if(rowcount($sql1)!=0)
	{
		echo "<font color=red><b>Duplicate Vendor  Found! Cannot Save Details</b></font><br>";
		echo "<font color=red><b><a href=VendorMaster.php>Back to Vendor Mater Master Form</a></b></font>";
		die();
	}

	// ACCOUNTS AUTOMATION 2.
	$query = "SELECT COUNT(Sl_No) AS C FROM LD$compid";
	$res = execute($query);
	$row = fetcharray($res);
	$serial1 = $row["C"] + 1;
	if ($serial1 <= 9)
		$ldid = "LD0000".$serial1;
	elseif (($serial1 > 9) && ($serial1 <= 99))
		$ldid = "LD000".$serial1;
	elseif (($serial1 > 99) && ($serial1 <= 999))
		$ldid = "LD00".$serial1;
	elseif (($serial1 > 999) && ($serial1 <= 9999))
		$ldid = "LD0".$serial1;
	else $ldid = "LD".$serial1;
	mysql_free_result($res);


	$query  = "INSERT INTO LD$compid(Sl_No, LID, Name, ID, SGID, Opening_Balance, ";
	$query .= "Closing_Balance, OBType,Opening_Type) VALUES($serial1, '$ldid', '";
	$query .= strtoupper($vendor_name)."', 'MG07', 'MG07', 0, 0, 'Cr','Cr')";
	//echo $query;
	execute($query) or die("Query $query : " . error_description());

	// ACCOUNTS AUTOMATION 3.
	$query = "SELECT COUNT(Sl_No) AS C FROM Ledger$compid";
	$res = execute($query);
	$row = fetcharray($res);
	$serial2 = $row["C"] + 1;
	mysql_free_result($res);

	$res = execute("SELECT From_Date FROM Working_Year WHERE Activated='On'");
	$row = fetcharray($res);
	$opdate = $row["From_Date"];
	mysql_free_result($res);

	$query  = "INSERT INTO Ledger$compid(Sl_No, Date, LID, Particulars, Debit, ";
	$query .= "Credit, Opening_Balance, OBType) VALUES($serial2, '$opdate', '$ldid', ";
	$query .= "'Opening Balance', 0, 0, 0, 'Cr')";
	execute($query) or die("Query $query : " . error_description());

	$sql="insert into VendorMaster_Assets(name,address,contact_person,phone,fax,email,remarks,ledger_id) values('$vendor_name','$address','$contact_person','$phone','$fax','$email','$remarks','$ldid')";
	$result=execute($sql) or die("cannot execute query");
	echo "<font color=red><b>Vendor Details Inserted Successfully..!!</b></font><BR>";
	echo "<font color=blue><b><a href=VendorMaster.php><u>Do you want to add more Vendor Details ?</u></a></b></font>";
	//header("Location:VendorMaster.php");
	exit;
}
else
{
	echo "<p align=\"Left\"><b><font color=red>Error !!! Please enter valid Vendor and Address</font></b></p>";
	print("<a href=VendorMaster.php>Back to Vendor Entry Screen</a>");
}

?>
