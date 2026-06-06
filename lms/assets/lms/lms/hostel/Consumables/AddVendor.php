<?php
session_start();
require("../../db.php");

$vendor_name = $_GET['vendor_name'];
$address = $_GET['address'];
$contact_person = $_GET['contact_person'];
$phone = $_GET['phone'];
$fax = $_GET['fax'];
$email = $_GET['email'];
$remarks = $_GET['remarks'];
$compid = $_SESSION['compid'];
	// ACCOUNTS AUTOMATION 1.

if(strlen($vendor_name) && strlen($address))
{

	$sql1=execute("select * from h_suplier_master where name='$vendor_name'")or die(error_description());
	if(rowcount($sql1)!=0)
	{
		//echo "<b>Duplicate Vendor  Found! Cannot Save Details</b><br>";
		?>
        <script type="text/javascript">
		alert("Duplicate Vendor  Found! Cannot Save Details");
        <?
		
		echo "<b><a href=SuplierMaster.php>Back to Vendor Mater Master Form</a></b>";
		die();
	}
	$query = "SELECT COUNT(Sl_No) AS C FROM LD";
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
    
	$query  = "INSERT INTO LD(Sl_No, LID, Name, ID, SGID, Opening_Balance, ";
	$query .= "Closing_Balance, OBType,Opening_Type) VALUES($serial1, '$ldid', '";
	$query .= strtoupper($vendor_name)."', 'MG07', 'MG07', 0, 0, 'Cr','Cr')";
	//echo $query;
	execute($query) or die("Query $query : " . error_description());

	$query = "SELECT COUNT(Sl_No) AS C FROM Ledger$compid";
	$res = execute($query);
	$row = fetcharray($res);
	$serial2 = $row["C"] + 1;
	mysql_free_result($res);

	$res = execute("SELECT From_Date FROM Working_Year WHERE Activated='On'");
	$row = fetcharray($res);
	$opdate = $row["From_Date"];
	mysql_free_result($res);

	$query  = "INSERT INTO Ledger(Sl_No, Date, LID, Particulars, Debit, ";
	$query .= "Credit, Opening_Balance, OBType) VALUES($serial2, '$opdate', '$ldid', ";
	$query .= "'Opening Balance', 0, 0, 0, 'Cr')";
	execute($query) or die("Query $query : " . error_description());

	$sql="insert into h_suplier_master(name,address,contact_person,phone,fax,email,remarks,ledger_id) values('$vendor_name','$address','$contact_person','$phone','$fax','$email','$remarks','$ldid')";
	$result=execute($sql) or die("cannot execute query");
	header("Location:SuplierMaster.php");
	exit;
}
else
{
	//echo "<p align=\"Left\"><b>Error !!! Please enter valid Vendor and Address</b></p>";
	?>
        <script type="text/javascript">
		alert("Error !!! Please enter valid Vendor and Address");
        <?
	print("<a href=SuplierMaster.php>Back to Vendor Entry Screen</a>");
}

?>