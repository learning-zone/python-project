<?php
session_start();
include("../connection.php");
$type=$_SESSION['type'];
if($type=='a')
{
$iin=$_POST['comboin'];
}
else
{
$iin=$_SESSION['ior'];
}
$b1=$_POST['b1'];
$n1=$_POST['n1'];
$idd=$_POST['idd'];
$eid=$_POST['txtid'];
$pos=$_POST['txtjob'];
$jdate=isset($_REQUEST["datejoin"]) ? $_REQUEST["datejoin"] : "";
$bpay=$_POST['txtbp'];
$da=$_POST['txtdap'];
$hra=$_POST['txthra'];
$cca=$_POST['txtcca'];
$oth1=$_POST['txtoth1'];
$pf=$_POST['txtpfp'];
$loans=$_POST['txtloans'];
$oth2=$_POST['txtoth2'];
$acc=$_POST['txtaccount'];
$name=$_POST['txtename'];
$qu=$_POST['txtqualification'];
$dob=isset($_REQUEST["datedob"]) ? $_REQUEST["datedob"] : "";
$gender=$_POST['rdgen'];
$add=$_POST['textarea'];
$contact=$_POST['txtcno'];
$email=$_POST['txtmail'];
$comments=$_POST['textarea2'];
$depart=$_POST['combodep'];
$ptype=$_POST['combobank'];
$qq=mysql_query("select vinstitution from ac_institution where iidx_institution='$depart'");
$g=mysql_fetch_row($qq);
if($gender==0)
{
$gen="Male";
}
else
{
$gen="Female";
}
$ledger="Salary(".$name.")";
$vn1="Salary(".$n1.")";
$qq1=mysql_query("select count(*) from emp_details1 where vemp_id='$eid' and iId_emp<>'$idd'");
$rr1=mysql_fetch_row($qq1);
if($b1=="UPDATE")
{
/*mysql_query("insert into emp_details1(iIdx_institution,iIdx_department,vemp_id,iemp_designation,demp_jdate,femp_bpay,pda,phra,pcca,potherear,pf,loans,otherded,vemp_name,vemp_qualification,demp_dob,vemp_gender,vemp_address,iemp_cno,vemp_email,vemp_comments,vaccount,ptype) values('$iin','$depart','$eid','$pos','$jdate','$bpay','$da','$hra','$cca','$oth1','$pf','$loans','$oth2','$name','$qu','$dob','$gender','$add','$contact','$email','$comments','$acc','$ptype')");
mysql_query("insert into ac_ledger(vledger,iIdx_group,vcode,vdescription,vcontactperson,vdesignation,imobile,itype,fopbal,date,iIdx_organization) values(\"$ledger\",5,'$eid',\"$comments\",\"$name\",\"$pos\",\"$contact\",'Dr',0.00,\"$jdate\",\"$iin\") ");
mysql_query("insert into ac_opbal(opdate,vledger,fopbal,iId_grp,vins,Dr_Cr,iIdx_organization) values(\"$jdate\",\"$ledger\",0.00,5,\"$g[0]\",'Dr',\"$iin\")");*/
mysql_query("update emp_details1 set iIdx_institution='$iin',iIdx_department='$depart',vemp_id='$eid',iemp_designation='$pos',demp_jdate='$jdate',femp_bpay='$bpay',pda='$da',phra='$hra',pcca='$cca',potherear='$oth1',pf='$pf',loans='$loans',otherded='$oth2',vemp_name='$name',vemp_qualification='$qu',demp_dob='$dob',vemp_gender='$gender',vemp_address='$add',iemp_cno='$contact',vemp_email='$email',vemp_comments='$comments',vaccount='$acc',ptype='$ptype' where iId_emp='$idd'");
mysql_query("update ac_ledger set vledger='$ledger',vdescription='$comments',vcontactperson='$name',vdesignation='$pos',imobile='$contact',date='$jdate' where vcode='$eid'");
mysql_query("update ac_opbal set vledger='$ledger' where vledger='$vn1'");
echo "<script>alert('Data Updated successfully');window.location.href='viewemp.php';</script>";
}
if($b1=="DELETE")
{
mysql_query("delete from emp_details1 where iId_emp='$idd'");
mysql_query("delete from ac_ledger where vcode='$eid'");
mysql_query("delete from ac_opbal where vledger='$vn1'");
echo "<script>alert('Data Deleted');window.location.href='viewemp.php';</script>";
}
?>