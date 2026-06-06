<?php
session_start();
require("../db.php");
// Check for duplication Account No.
$sql12 = execute("select * from bank_details where acc_no='$accno' ") or die(error_description());
if (rowcount($sql12)>=1)
{
	echo "<font color=red><b>Duplicate Account Number !! Cannot Save Details</b></font><br>";
	echo "<font color=red><b><a href=bank_det.php>Back to Add Bank Detail Form</a></b></font>";
	die();
}
$ldr=$bankname."-".$acctype." ".$accno;
// INSERTION OF THE LEDGER.
if($acctype=='SB' || $acctype=='CA')
{
	$mid = "MG02";
	$sid = "SG02";
}
else
{
	$mid = "MG05";
	$sid = "SG12";
}
if (empty($bankname))
{
	echo "<DIV ALIGN=CENTER><FONT COLOR=#FF0000><B>Please enter the Name of the Bank!!";
	echo "</B></FONT></DIV>";
	die();
}
elseif (empty($ob))
{
	echo "<DIV ALIGN=CENTER><FONT COLOR=#FF0000><B>Please enter the Opening Balance !!";
	echo "</B></FONT></DIV>";
	die();
}
$query  = "SELECT Name FROM LD$compid WHERE Name=".strtoupper($ldr);
$rs = execute($query);
if (empty($rs))
{
	// INSERTING THE LEDGER DETAILS IN LEDGER TABLE.
	// BEGIN
	$query = "SELECT COUNT(Sl_No) AS C FROM Ledger$compid";
	$res = execute($query);
	$row = fetcharray($res);
	$serial1 = $row["C"] + 1;
	mysql_free_result($res);
	$query = "SELECT COUNT(Sl_No) AS C FROM LD$compid";
	$res = execute($query);
	$row = fetcharray($res);
	$serial2 = $row["C"] + 1;
	if ($serial2 <= 9)
		$ldid = "LD0000".$serial2;
	elseif (($serial2 > 9) && ($serial2 <= 99))
		$ldid = "LD000".$serial2;
	elseif (($serial2 > 99) && ($serial2 <= 999))
		$ldid = "LD00".$serial2;
	elseif (($serial2 > 999) && ($serial2 <= 9999))
		$ldid = "LD0".$serial2;
	else $ldid = "LD".$serial2;
		mysql_free_result($res);
	$res = execute("SELECT From_Date FROM Working_Year WHERE Activated='On'");
	$row = fetcharray($res);
	$opdate = $row["From_Date"];
	mysql_free_result($res);
	if ($obtype == "Dr")
	{
		$debit = $ob;
		$credit = 0;
	}
	else
	{
		$debit = 0;
		$credit = $ob;
	}
	$query  = "INSERT INTO LD$compid(Sl_No, LID, Name, ID, SGID, Opening_Balance, ";
	$query .= "Closing_Balance, OBType) VALUES($serial2, ";
	$query .= " '$ldid', '".strtoupper($ldr)."', '$mid', '$sid', $ob, $ob, '$obtype')";
	//echo "$query<BR>";
	execute($query) or die("Query $query : " . error_description());
	$query  = "INSERT INTO Ledger$compid(Sl_No, Date, LID, Particulars, Debit, ";
	$query .= "Credit, Opening_Balance, OBType) VALUES($serial1, '$opdate', ";
	$query .= "'$ldid', 'Opening Balance', $debit, $credit, $ob, '$obtype')";
	//echo "$query<BR>";
	execute($query) or die("Query $query : " . error_description());
	// END
	echo "<DIV ALIGN=CENTER><FONT COLOR=#FF000F><B>The Ledger, you entered is  ";
	echo "created successfully !!<BR><BR></B></FONT></DIV>";
}
else
{
	echo "<DIV ALIGN=CENTER><FONT COLOR=#FF0000><B>The Ledger already existed !! <BR>";
	echo "Please check the Name !?!</B></FONT></DIV>";
}
// Insert Bangk Details into the table
$bankname=strtoupper($ldr);
$sql = "INSERT INTO bank_details(bank_name,bank_address,telephone,acc_no,acc_type,ledger_id) VALUES ('$bankname','$address','$telno','$accno','$acctype','$ldid')" ;
//echo $sql."<br>";
execute($sql);
header("Location: bank_det.php");

?>
