<?php
session_start();
include("../db.php");
$uname=$_POST['txtuname'];
$pass=$_POST['txtpass'];
$org=$_POST['comboorg'];
//$iin=$_POST['cins'];
$q1=execute("select iIdx_organization from ac_organization where vorgname=\"$org\"");
$r=fetchrow($q1);
$q2=execute("select * from ac_usermapping where vusername=\"$uname\"");
$n1=rowcount($q2);
$qry=execute("select * from ac_login where vusername=\"$uname\" and vpassword=\"$pass\"");
$obj=mysql_fetch_object($qry);
$num=rowcount($qry);
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
			/*echo "<script>alert('Select Your Institution');window.location.href='index.php';</script>";*/
		//$msgg="Select Institution";
			//header("location:index.php?org=$org&uname=$uname&msgg=$msgg");
			//}
			//else
			//{
			$qpp=execute("select * from ac_user_details where vusername=\"$uname\"");
			$objp1=mysql_fetch_object($qpp);
			$tyy=$objp1->utype;
			$qpp1=execute("select * from ac_usertype where iIdx_usertype=\"$tyy\"");
			$objp=mysql_fetch_object($qpp1);
			$q1=execute("select iIdx_organization from ac_institution where vinstitution='".$obj->vins."'");
			$r55=fetchrow($q1);
			$iior=$objp1->iorg;
			$bn=execute("select vorgname from ac_organization where iIdx_organization='$iior'");
			$cbv=fetchrow($bn);
			$q23=execute("select iIdx_institution from ac_institution where vinstitution='".$obj->vins."'");
			$r551=fetchrow($q23);
			
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
        	header("location:home.php");
			//}
			}
			else
			{
			$msg3="Access Denied";
 			header("location:index.php?msg3=$msg3");
			}
		}
	}
	
}
else
{
	 $msg3="Invalid Login";
	 header("location:index.php?msg3=$msg3");
}	
?>