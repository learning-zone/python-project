<?php
include("../db.php");

session_start();
$name=$_SESSION['name'];
$date = isset($_REQUEST["datet"]) ? $_REQUEST["datet"] : "";
$ledger=$_POST['txtledger'];
$grp=$_POST['combogp'];

$type=$_POST['combodc'];
$code=$_POST['txtlcode'];
$ldesc=$_POST['txtldesc'];
$lcontact=$_POST['txtlcontact'];
$ldesig=$_POST['txtldesig'];
$lmobile=$_POST['txtlmobile'];
$org=$_SESSION['org'];
$tp=$_SESSION['type'];
$ob=$_POST['txtopbal'];

if($tp=='u')
{
$ins=$_SESSION['ins'];
$or1=$_SESSION['ior'];
}
if($tp=='a')
{
$or1=$_POST['cmbin'];
}
$orgg=$_SESSION['ior'];
if($tp=='a')
{
$orgg=$_POST['cmbin'];
}
//echo $orgg;
/*if($type=='Dr')
{
$type=0;
}
if($type=='Cr')
{
$type=1;
}*/
$yr=date('Y');
		$yr1=$yr-1;
		$yr2=$yr+1;
		$mon=date('m');
		$dat=date('d');
		$y11=$yr.'-04-01';
		$y12=$yr.'-03-31';
		$y21=$yr1.'-04-01';
		$y22=$yr1.'-03-31';
		$y31=$yr2.'-04-01';
		$y32=$yr2.'-03-31';
		$yr3=$yr-2;
		$y33=$yr3.'-04-01';
		 if($mon>3)
		{
		//$date=date('Y').'-04-01';
$ss=execute("select * from ac_ledger where  iIdx_organization='".$or1."' and  vledger = '".$ledger."'");
$p=rowcount($ss);
}
else
{
//$date=$yr1.'-04-01';
$ss=execute("select * from ac_ledger where   iIdx_organization='".$or1."' and  vledger = '".$ledger."'");
$p=rowcount($ss);
}
if($p>0)
{
$msg1="Ledger Already Exist!!";
header("location:addledger.php?msg1=$msg1");
}
else
{
if($ob=="")
{
$ob=0.00;
}
$sql=execute("select * from ac_allgroup where vgroupname=\"$grp\"");
$obj=mysql_fetch_object($sql);
$id=$obj->iIdx_grp;
$path=$obj->vpath;
$a=explode(',',$path);
if($type=="Cr" && $id!=13)
{
if($id!=3 || $a[2]!=3)
{
$ob=$ob*-1;
}
}

execute("insert into ac_opbal(opdate,vledger,fopbal,iId_grp,vins,Dr_Cr,iIdx_organization) values(\"$date\",\"$ledger\",\"$ob\",\"$id\",\"$ins\",\"$type\",\"$or1\")");
execute("insert into ac_ledger(vledger,iIdx_group,vcode,vdescription,vcontactperson,vdesignation,imobile,itype,fopbal,date,iIdx_organization) values(\"$ledger\",\"$id\",\"$code\",\"$ldesc\",\"$lcontact\",\"$ldesig\",\"$lmobile\",\"$type\",\"$ob\",\"$date\",\"$orgg\") ");
echo "<script>alert('Data Added successfully');window.location.href='viewledgers.php';</script>";
}
?>