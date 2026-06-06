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
$qq1=mysql_query("select count(*) from emp_details1 where vemp_id='$eid'");
$rr1=mysql_fetch_row($qq1);
if($rr1[0]==0)
{
mysql_query("insert into emp_details1(iIdx_institution,iIdx_department,vemp_id,iemp_designation,demp_jdate,femp_bpay,pda,phra,pcca,potherear,pf,loans,otherded,vemp_name,vemp_qualification,demp_dob,vemp_gender,vemp_address,iemp_cno,vemp_email,vemp_comments,vaccount,ptype) values('$iin','$depart','$eid','$pos','$jdate','$bpay','$da','$hra','$cca','$oth1','$pf','$loans','$oth2','$name','$qu','$dob','$gender','$add','$contact','$email','$comments','$acc','$ptype')");
mysql_query("insert into ac_ledger(vledger,iIdx_group,vcode,vdescription,vcontactperson,vdesignation,imobile,itype,fopbal,date,iIdx_organization) values(\"$ledger\",5,'$eid',\"$comments\",\"$name\",\"$pos\",\"$contact\",'Dr',0.00,\"$jdate\",\"$iin\") ");
mysql_query("insert into ac_opbal(opdate,vledger,fopbal,iId_grp,vins,Dr_Cr,iIdx_organization) values(\"$jdate\",\"$ledger\",0.00,5,\"$g[0]\",'Dr',\"$iin\")");
echo "<script>alert('Data added successfully');window.location.href='addemp1.php';</script>";
}
else
{
echo "<script>alert('ID already Exist');window.location.href='addemp1.php';</script>";
}
?>