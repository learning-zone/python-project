<?php
session_start();
/*
 Add values into  college table
 Redirects to collegeadd.php
*/
require("../db.php");
if(strlen($colname) && strlen($colcode) && strlen($coladdr) && strlen($colphone) && strlen($colemail)&& strlen($city)&& strlen($state))
{
	$sql="select * from college where col_code='$colcode'";
	$rs=execute($sql);
	if(rowcount($rs)==0)
	{
		$sql_comp="select count(Sl_No) from company";
		$rs_comp=execute($sql_comp) or die(error_description());
		$r_comp=fetcharray($rs_comp);
		$count=$r_comp[0]+1;
		$colname=strtoupper($colname);
		$coladdr=strtoupper($coladdr);
		$city=strtoupper($city);
		$state=strtoupper($state);

		$company_id=100+$count;

		$sql_comp="insert into company (Sl_No,ID,Company_Name,Address,City,State,Telephone,Email,PAN_No) ";
		$sql_comp.=" values($count,$company_id,'$colname','$coladdr','$city','$state','$colphone','$colemail','$pan_no')";
		//echo $sql_comp."<br>";
		execute($sql_comp) or die(" Query $sql_comp :". error_description());
		$sqlstr="Insert into college (col_name,col_code,col_addr,col_phone,email,company_id) values ('$colname','$colcode','$coladdr','$colphone','$colemail','$company_id')";
		//echo($sqlstr);
		execute($sqlstr) or die("Cannot insert into college table!");
		header("Location: collegeadd.php");
 		exit;
 	}
 	else
 	{
 		die("<font color='red' size=4> Duplication College Code.</font>");
 	}
 }
 else
 {
 	echo "<p align=\"Left\"><b>Please enter all College Details</b></p>";
 }
?>

