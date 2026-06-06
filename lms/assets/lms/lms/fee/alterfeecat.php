<?php
session_start();
require("../db.php");

if(strtoupper($Types) == "ADD")
{
	$sql=execute("select catid from fee_cat where cat_name='".addslashes($feename)."' ");
	if(rowcount($sql)>0)
	{
		echo "<div align=center><font color='Brown'><b>Duplicate Fee Category not allowed ...!!</b></font><br><br>";
		echo "<a href='feecatadd.php?act=1'><b><image src='../images/back1.jpg'></image></b></a></div>";
		die();
	}
	$sql1="insert into fee_cat (cat_name) values ('".addslashes($feename)."')";
	execute($sql1) or die("<font color='red'><b>Failed to add Details...!!</b></font>");
	$feesql=fetcharray(execute("select max(catid) from fee_cat"));
	$feeid=$feesql[0];
	execute("alter table fee_master add column dfee".$feeid." int(10) default 0 ") or die("Failed to add column");
	execute("alter table fee_master add column pfee".$feeid." int(10) default 0 ") or die("Failed to add column");
	execute("alter table fee_payment add column pdcat".$feeid." int(10) default 0 ") or die("Failed to add column");
	$msg="Fee category inserted..";
	$act=1;
}
elseif(strtoupper($Types) == "MOD")
{
	while(list(,$value) = each($fid))
	{
		$fname="fName".$value;
		$fname=$$fname;

		$sql=execute("select catid from fee_cat where cat_name='".addslashes($fname)."'");
		if(rowcount($sql)>0)
		{
			echo "<div align=center><font color='Brown'><b>Duplicate Fee Category not allowed ...!!</b></font><br><br>";
			echo "<a href='feecatadd.php?act=2'><b><image src='../images/back1.jpg'></image></b></a></div>";
			die();
		}	
		$sql1="update fee_cat set cat_name='".addslashes($fname)."' where catid=$value";
		execute($sql1) or die("<font color='red'><b>Failed to update Details...!!</b></font>");
	}
	$msg="Fee category updated ..";
	$act=2;
}
elseif(strtoupper($Types) == "DEL")
{
	while(list(,$value) = each($fid))
	{
		$sql = "UPDATE fee_cat set status=0 where catid = $value";
		execute($sql) or die("<font color='red'><b>Failed to delete details ...!!</b></font>");
	}
	$msg="Fee category deleted..";
	$act=2;
}
header("Location: feecatadd.php?act=$act&msg=$msg");
?>