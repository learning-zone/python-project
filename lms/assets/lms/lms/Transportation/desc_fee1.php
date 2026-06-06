<?php
include("../db.php");
$d=getdate();
$s=getdate();
function MonthName($mon)
{
	if($mon == 1) return("Jan");
	if($mon == 2) return("Feb");
	if($mon == 3) return("Mar");
	if($mon == 4) return("Apr");
	if($mon == 5) return("May");
	if($mon == 6) return("Jun");
	if($mon == 7) return("July");
	if($mon == 8) return("Aug");
	if($mon == 9) return("Sep");
	if($mon == 10) return("Oct");
	if($mon == 11) return("Nov");
	if($mon == 12) return("Dec");
}
if($type=="add")
{
	$res = execute("select FMon from trans_fee_str where FMon='$FMon' ") or die(mysql_error());
	$num = rowcount($res);
	if($num==0)
	{
		$var = execute("insert into trans_fee_str values('','$validity','$FMon','$FYear','$amount')")  or die(mysql_error());
		header("Location:desc_fee.php?type=$type&flag=1");
	}
	else
	{
		header("Location:desc_fee.php?type=$type&flag=2");
	}
}
if($type=="modify")
{
	while(list (,$value)=each($tid))
	{
		echo "$value===<br>";

		$val = "validity".$value;
		$valid = $$val;

		$mm = "FMon".$value;
		$mon = $$mm;

		$yy = "FYear".$value;
		$year = $$yy;

		$amt = "amount".$value;
		$amount = $$amt;

		$res = execute("update trans_fee_str set validity='$valid',FYear='$year',FMon='$mon',amount='$amount' where id='$value'")  or die(mysql_error());
	}
	header("Location:desc_fee.php?type=$type&flag=3");
}
?>