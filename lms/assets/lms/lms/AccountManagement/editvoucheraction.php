<?php
session_start();
$name=$_SESSION['name'];
try
{
$or1=$_POST['oh1'];
$tp=$_SESSION['type'];
$dep=$_POST['comboin'];
include("../db.php");
$dt1 = isset($_REQUEST["date5"]) ? $_REQUEST["date5"] : "";
$dt2 = isset($_REQUEST["date6"]) ? $_REQUEST["date6"] : "";
$ipp=execute("select iIdx_organization from ac_institution where vinstitution='$dep'");
$gg=fetchrow($ipp);
$vt=$_SESSION['vtp'];
$btn=$_POST['b1'];
$r1=$_POST['rd'];
$vno=$_POST['txtvno'];
$bc=$_POST['combobc'];
$amt=$_POST['txtamnt1'];
$cddno=$_POST['txtcno'];
$bybal=$_POST['txtbybal'];
$tobal=$_POST['txttobal'];
$idd1=$_POST['i1'];
$idd2=$_POST['i2'];
$amt1=$_POST['txtamt'];
$accname=$_POST['comboacname'];
$narr=$_POST['txtnarr'];
$q1=execute("select iIdx_group  from ac_ledger where vledger=\"$bc\" and iIdx_organization=\"$or1\"");
$b1=fetchrow($q1);
$q2=execute("select iIdx_group  from ac_ledger where vledger=\"$accname\" and iIdx_organization=\"$or1\"");
$b2=fetchrow($q2);
$q3=execute("select iIdx_group  from ac_ledger where vledger=\"$accname\" and iIdx_organization=\"$or1\"");
$dt=explode("/",$dt1);
$d=$dt[0];
$m=$dt[1];
$y=$dt[2];
$date1=$y."-".$m."-".$d; 
$d=explode("/",$dt2);
$d=$dt[0];
$m=$dt[1];
$y=$dt[2];
$date2=$y."-".$m."-".$d; 
$particular1="By ".$bc;
$particular2="To ".$accname;
$qry1=execute("select * from ac_ledger where vledger=\"$bc\" and iIdx_organization=\"$or1\"");
$obj1=mysql_fetch_object($qry1);
$l1=$obj1->iIdx_ledger;
$igp1=$obj1->iIdx_group;
$bybal=$obj1->fopbal;
$ltype1=$obj1->itype;
$totbybal=$bybal+$amt1;
$qry2=execute("select * from ac_ledger where vledger=\"$accname\" and iIdx_organization=\"$or1\"");
$obj2=mysql_fetch_object($qry2);
$l2=$obj2->iIdx_ledger;
$tobal=$obj2->fopbal;

$tottobal=$tobal-$amt1;

$igp2=$obj2->iIdx_group;
$ltype2=$obj2->itype;
$dr="Dr";
$cr="Cr";
$vtype=$_POST['combovtype'];
echo $dep.$idd1.$idd2.$bc.$accname;

//execute("update ac_opbal set opdate=\"$dt1\",vledger=\"$bc\",fopbal=\"$totbybal\",iId_grp=\"$igp1\",vins=\"$dep\",Dr_Cr=\"$ltype1\",iIdx_organization=\"$or1\"";


//execute("update ac_opbal set opdate=\"$dt1\",vledger=\"$accname\",fopbal=\"$tottobal\",iId_grp=\"$igp2\",vins=\"$dep\",Dr_Cr=\"$ltype2\",iIdx_organization=\"$or1\"";


//execute("update ac_ledger set fopbal=\"$totbybal\" where vledger=\"$bc\" and iIdx_organization=\"$or1\"");

//execute("update ac_ledger set fopbal=\"$tottobal\" where vledger=\"$accname\" and iIdx_organization=\"$or1\"");

$qry3=execute("select * from ac_vouchermaster where vvouchertype=\"$vtype\"");
$obj3=mysql_fetch_object($qry3);
$vn=$obj3->iIdx_vouchermaster;

$qry4=execute("select * from ac_institution where vinstitution=\"$dep\"");
$obj4=mysql_fetch_object($qry4);
$ino=$obj4->iIdx_institution; 

$d1='Dr';
$d2='Cr';
$vn1="";
$narr1="";
if($btn=="Update")
{
/*if($r1==0)
{
execute("update ac_voucher set iIdx_ledger=\"$l1\",iIdx_vouchermaster=\"$vtype\",iIdx_institution=\"$ino\",ddate=\"$dt1\",Dr_Cr=\"$d1\",particulars=\"$particular1\",chequedd_no=\"$cddno\",chequedd_date=\"$dt2\",fdebit=\"$amt1\",vvoucherno=\"$vno\",vnarration=\"$narr\",acc=\"$bc\",iIdx_group=\"$b1[0]\",istatus=0 iIdx_organization=\"$gg[0]\" where iIdx_voucher='$idd1'");
execute("update ac_voucher set iIdx_ledger=\"$l2\",iIdx_vouchermaster=\"$vtype\",iIdx_institution=\"$ino\",ddate=\"$dt1\",Dr_Cr=\"$d2\",particulars=\"$particular2\",chequedd_no=\"$cddno\",chequedd_date=\"$dt2\",fcredit=\"$amt1\",vvoucherno=\"$vno\",vnarration=\"$narr\",acc=\"$accname\",iIdx_group=\"$b2[0]\",istatus=0 iIdx_organization=\"$gg[0]\" where iIdx_voucher='$idd1'");
echo "<script>alert('Data updated successfully');window.location.href='viewdaybook.php';</script>";
//header("location:createvoucher2.php?vt=$vt&or1=$or1");
}
if($r1==1)
{
execute("update ac_voucher set iIdx_ledger=\"$l1\",iIdx_vouchermaster=\"$vtype\",iIdx_institution=\"$ino\",ddate=\"$dt1\",Dr_Cr=\"$d1\",particulars=\"$particular1\",fdebit=\"$amt1\",vvoucherno=\"$vno\",vnarration=\"$narr\",acc=\"$bc\",iIdx_group=\"$b1[0]\",istatus=0 iIdx_organization=\"$gg[0]\" where iIdx_voucher='$idd2'");
execute("update ac_voucher set iIdx_ledger=\"$l2\",iIdx_vouchermaster=\"$vtype\",iIdx_institution=\"$ino\",ddate=\"$dt1\",Dr_Cr=\"$d2\",particulars=\"$particular2\",fcredit=\"$amt1\",vvoucherno=\"$vno\",vnarration=\"$narr\",acc=\"$accname\",iIdx_group=\"$b2[0]\",istatus=0 iIdx_organization=\"$gg[0]\" where iIdx_voucher='$idd2'");
echo "<script>alert('Data updated successfully');window.location.href='viewdaybook.php';</script>";
header("location:createvoucher2.php?vt=$vtype&or1=$or1");
}*/
}
if($btn=="Delete")
{
execute("delete from ac_voucher where iIdx_voucher='$idd1'");
execute("delete from ac_voucher where iIdx_voucher='$idd2'");
echo "<script>alert('Data Deleted successfully');window.location.href='viewdaybook.php';</script>";
}
}
catch(Exception $ex)
{
echo $ex->getMessage();
}

?>
