<?
session_start();
$module='Payroll';
$_SESSION['module']=$module;
?>
<!DOCTYPE html>
<html><meta charset="utf-8"/>
<HEAD>
<link rel="stylesheet" type="text/css" href="../mistStyle.css">
<TITLE>MIST</TITLE>
<base TARGET="main">
</HEAD>
<BODY>
<H3></H3>
<!--<BLOCKQUOTE>-->
<?php
$uname='master';
$pass='master!@#';
$org=$_POST['comboorg'];
//$iin=$_POST['cins'];
$q1=mysql_query("select iIdx_organization from ac_organization where vorgname=\"$org\"");
$r=mysql_fetch_row($q1);
$q2=mysql_query("select * from ac_usermapping where vusername=\"$uname\"");
$n1=mysql_num_rows($q2);
$qry=mysql_query("select * from ac_login where vusername=\"$uname\" and vpassword=\"$pass\"");
$obj=mysql_fetch_object($qry);
$num=mysql_num_rows($qry);
if($num>0)
{
   if($obj->vstatus=='yes')
	{
		if($obj->vtype=='a')
		{
			$_SESSION['name']=$uname;
			$_SESSION['pass']=$pass;
			$_SESSION['type']=$obj->vtype;
			$_SESSION['org']=$r[0];
			//$_SESSION['ins']=$obj->vins;
      		header("location:home.php");
		}
		else
		{
			if($n1>0)
			{
			//if($iin=='select')
			//{
			/*echo "<script>alert('Select Your Institution'];window.location.href='index.php';</script>";*/
		//$msgg="Select Institution";
			//header("location:index.php?org=$org&uname=$uname&msgg=$msgg"];
			//}
			//else
			//{
			$qpp=mysql_query("select * from ac_user_details where vusername=\"$uname\"");
			$objp1=mysql_fetch_object($qpp);
			$tyy=$objp1->utype;
			$qpp1=mysql_query("select * from ac_usertype where iIdx_usertype=\"$tyy\"");
			$objp=mysql_fetch_object($qpp1);
			$q1=mysql_query("select iIdx_organization from ac_institution where vinstitution='".$obj->vins."'");
			$r55=mysql_fetch_row($q1);
			$iior=$objp1->iorg;
			$bn=mysql_query("select vorgname from ac_organization where iIdx_organization='$iior'");
			$cbv=mysql_fetch_row($bn);
			$q23=mysql_query("select iIdx_institution from ac_institution where vinstitution='".$obj->vins."'");
			$r551=mysql_fetch_row($q23);
			
			//echo $iior;
			$_SESSION['ior']=$iior;
			$_SESSION['orgn']=$cbv[0];
			$_SESSION['name']=$uname;
	   		$_SESSION['pass']=$pass;
	    	$_SESSION['type']=$obj->vtype;
			$_SESSION['org']=$r[0];
			$_SESSION['ins1']=$r551[0];
			$_SESSION['ins']=$obj->vins;
			$_SESSION['tran']=$objp->trans;
			$_SESSION['dab']=$objp->dab;
			$_SESSION['bab']=$objp->bab;
			$_SESSION['cab']=$objp->cab;
			$_SESSION['leb']=$objp->leb;
			$_SESSION['trib']=$objp->trialb;
			$_SESSION['pl']=$objp->pl;
			$_SESSION['bash']=$objp->balsh;
			$_SESSION['chp']=$objp->changep  	;
			$_SESSION['cmast']=$objp->cmast;
			$_SESSION['cgp']=$objp->cgrp;
			$_SESSION['cvch']=$objp->cvch;
			$_SESSION['cled']=$objp->cled;
			$_SESSION['cdep']=$objp->cdep  	;
			$_SESSION['cjob']=$objp->cjob;
			$_SESSION['addemp']=$objp->addemp  	;
			$_SESSION['addatt']=$objp->addatt;
			$_SESSION['addsal']=$objp->addsal;
			$_SESSION['inex']=$objp->inexp;
        	//header("location:home.php"];
			//}
			}
			
		}
	}
	
}





include("../showmenu.php");
?>
</BODY>
</HTML>
