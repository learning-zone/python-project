<?php
session_start();
$name=$_SESSION['name'];
try
{
$or1=$_SESSION['ior'];
$tp=$_SESSION['type'];
if($tp=='a')
{
$or1=$_POST['oh1'];
$_SESSION['orr']=$or1;
}
$dep=$_POST['comboin'];
include("../db.php");
$dt1 = isset($_REQUEST["date5"]) ? $_REQUEST["date5"] : "";
$dt2 = isset($_REQUEST["date6"]) ? $_REQUEST["date6"] : "";
$dt3 = isset($_REQUEST["datebill"]) ? $_REQUEST["datebill"] : "";
$billno=$_POST['txtbillno'];
$ins1=$_SESSION['ins'];
$ipp=execute("select iIdx_organization from ac_institution where vinstitution='$dep'");
$gg=fetchrow($ipp);
$vt=$_SESSION['vtp'];
//echo $dt1.$dt2;
//$date1=$_POST['txtdate'];
$r1=$_POST['rd'];
//$ins=$_POST['comboin'];
$vno=$_POST['txtvno'];
$vtype=$_POST['combovtype'];
$bc=$_POST['combobc'];
$amt=$_POST['txtamnt1'];
$cddno=$_POST['txtcno'];
$bybal=$_POST['txtbybal'];
$tobal=$_POST['txttobal'];
//$cddate=$_POST['date'];
$amt1=$_POST['txtamt'];
$accname=$_POST['comboacname'];
$narr=$_POST['txtnarr'];
$q1=execute("select iIdx_group  from ac_ledger where vledger=\"$bc\" and iIdx_organization=\"$or1\"");
$b1=fetchrow($q1);
$q2=execute("select iIdx_group  from ac_ledger where vledger=\"$accname\" and iIdx_organization=\"$or1\"");
$b2=fetchrow($q2);
$q3=execute("select iIdx_group  from ac_ledger where vledger=\"$accname\" and iIdx_organization=\"$or1\"");
//$cdd=$_REQUEST['rd'];
//echo $date1."<br>".$ins."<br>".$vno."<br>".$vtype."<br>".$bc."<br>".$amt."<br>".$cddno."<br>".$cddate."<br>".$amt1."<br>".$accname."<br>".$narr;

/*$qry6=execute("select * from ac_ledger where vlegder=\"$bc\"");
$o1=mysql_fetch_object($qry6);
$bybal=$o1->fopbal;
echo $bybal;*/
/*$q2=execute("select fopbal from ac_ledger where vlegder=\"$accname\"");
$o2=mysql_fetch_object($q2);
$tobal=$o2->fopbal;*/
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
/*if($amt1>=$tobal)
{
$amt1=-1*$amt1;
$tottobal=-1*($tobal-$amt1);
}
else
{*/
//my new modification
//if($vtype==2)
//{
//	$tottobal=$tobal+$amt1;
//}
//else
//{
	$tottobal=$tobal-$amt1;
//}
//my new modification ends
/*}*/
$igp2=$obj2->iIdx_group;
$ltype2=$obj2->itype;
$dr="Dr";
$cr="Cr";
$ins=$_SESSION['ins'];
$vtype=$_POST['combovtype'];
//echo $ni.$vp;
//execute("insert into ac_opbal(opdate,vledger,fopbal,iId_grp,vins,Dr_Cr) values(\"$dt1\",\"$bc\",\"$totbybal\",\"$igp1\",\"$ins\",\$ltype1\")");
execute("insert into ac_opbal(opdate,vledger,fopbal,iId_grp,vins,Dr_Cr,iIdx_organization) values(\"$dt1\",\"$bc\",\"$totbybal\",\"$igp1\",\"$dep\",\"$ltype1\",\"$or1\")");

execute("insert into ac_opbal(opdate,vledger,fopbal,iId_grp,vins,Dr_Cr,iIdx_organization) values(\"$dt1\",\"$accname\",\"$tottobal\",\"$igp2\",\"$dep\",\"$ltype2\",\"$or1\")");

//execute("insert into ac_opbal(opdate,vledger,fopbal,,iId_grp,vins,Dr_Cr) values(\"$dt1\",\"$accname\",\"$tottobal\",\"$igp2\",\"$ins\",\"$cr\")");
execute("update ac_ledger set fopbal=\"$totbybal\" where vledger=\"$bc\" and iIdx_organization=\"$or1\"");

execute("update ac_ledger set fopbal=\"$tottobal\" where vledger=\"$accname\" and iIdx_organization=\"$or1\"");

$qry3=execute("select * from ac_vouchermaster where vvouchertype=\"$vtype\"");
$obj3=mysql_fetch_object($qry3);
$vn=$obj3->iIdx_vouchermaster;
//echo $vn;
$qry4=execute("select * from ac_institution where vinstitution=\"$dep\"");
$obj4=mysql_fetch_object($qry4);
$ino=$obj4->iIdx_institution; 
//echo $ino;
$d1='Dr';
$d2='Cr';
$vn1="";
$narr1="";
//echo $r1;

if($r1==0)
{
execute("insert into ac_voucher(iIdx_ledger,iIdx_vouchermaster,iIdx_institution,ddate,Dr_Cr,particulars,chequedd_no,chequedd_date,fdebit,vvoucherno,vnarration,acc,iIdx_group,istatus,iIdx_organization,vbillno,dbilldate) values($l1,$vtype,$ino,\"$dt1\",\"$d1\",\"$particular1\",\"$cddno\",\"$dt2\",$amt1,\"$vno\",\"$narr\",\"$bc\",$b1[0],'0',$gg[0],'$billno','$dt3')") ;
execute("insert into ac_voucher(iIdx_ledger,iIdx_vouchermaster,iIdx_institution,ddate,Dr_Cr,particulars,chequedd_no,chequedd_date,fcredit,vvoucherno,vnarration,acc,iIdx_group,istatus,iIdx_organization,vbillno,dbilldate) values($l2,$vtype,$ino,\"$dt1\",\"$d2\",\"$particular2\",\"$cddno\",\"$dt2\",$amt1,\"$vno\",\"$narr\",\"$accname\",$b2[0],'0',$gg[0],'$billno','$dt3')") ;
echo "<script>alert('Data added successfully');window.location.href='createvoucher2.php';</script>";
header("location:createvoucher2.php?vt=$vt&or1=$or1");
}
if($r1==1)
{
execute("insert into ac_voucher(iIdx_ledger,iIdx_vouchermaster,iIdx_institution,ddate,Dr_Cr,particulars,fdebit,vvoucherno,vnarration,acc,iIdx_group,istatus,iIdx_organization,vbillno,dbilldate) values($l1,$vtype,$ino,\"$dt1\",\"$d1\",\"$particular1\",$amt1,\"$vno\",\"$narr\",\"$bc\",$b1[0],'0',$gg[0],'$billno','$dt3')");
execute("insert into ac_voucher(iIdx_ledger,iIdx_vouchermaster,iIdx_institution,ddate,Dr_Cr,particulars,fcredit,vvoucherno,vnarration,acc,iIdx_group,istatus,iIdx_organization,vbillno,dbilldate) values($l2,$vtype,$ino,\"$dt1\",\"$d2\",\"$particular2\",$amt1,\"$vno\",\"$narr\",\"$accname\",$b2[0],'0',$gg[0],'$billno','$dt3')");
echo "<script>alert('Data added successfully');window.location.href='createvoucher2.php';</script>";
header("location:createvoucher2.php?vt=$vtype&or1=$or1");
}
}
catch(Exception $ex)
{
echo $ex->getMessage();
}
//execute("insert into ac_voucher(iIdx_ledger,iIdx_vouchermaster,iIdx_institution,ddate,Dr/Cr,particulars,chequedd_no,chequedd_date,fdebit,fcredit,vvoucherno,vnarration) values(1,2,3,'2010-04-10,\"$d\",'by',2000,2010-04-10,900,0,3,'bhnjgh')");
//echo $l1."<br>".$vn."<br>".$ino."<br>".$date."<br>".'Dr'."<br>".$particular1."<br>".$cddno."<br>".$date."<br>".$amt1."<br>".$vno."<br>".$narr;
//execute("insert into ac_voucher(iIdx_ledger,iIdx_vouchermaster,iIdx_institution,ddate,Dr/Cr,particulars,chequedd_no,chequedd_date,fdebit,fcredit,vvoucherno,vnarration) values(\"$l1\",\"$vn\",\"$ino\",\"$date1\",\"$d\",\"$particular1\",\"$cddno\",\"$date\",\"$amt1\",\"$dr\",\"$vno\",\"$narr\")");


//execute("insert into test(item,debit,credit) values('a',0,0)");
//execute("insert into test(debit,credit) values($debit,$credit)");
//echo $particular;

?>