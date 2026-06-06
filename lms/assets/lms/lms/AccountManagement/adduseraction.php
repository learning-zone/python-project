<?php
session_start();
$or1=$_SESSION['ior'];
include("../db.php");
$ins=$_POST['cmbin'];
$name1=$_POST['txtname'];
$date=$_POST['combodate'];
$month=$_POST['combomonth'];
$year=$_POST['comboyear'];
$add=$_POST['txtaddress'];
$country=$_POST['txtcountry'];
$pin=$_POST['txtpin'];
$uname=$_POST['txtuname'];
$pass=$_POST['txtpass'];
$cpass=$_POST['txtcpass'];
$date1=$_POST['txtdate'];
$utype=$_POST['utype'];
$org=$_POST['d'];
$tr=$_POST['tr'];
$tr1=$_POST['db'];
$tr2=$_POST['bb'];
$tr3=$_POST['cb'];
$tr4=$_POST['vlb'];
$tr5=$_POST['vtb'];
$tr6=$_POST['vpl'];
$tr7=$_POST['vbs'];
$tr8=$_POST['cpas'];
$tr9=$_POST['mgs'];
$tr10=$_POST['gp'];
$tr11=$_POST['vtp'];
$tr12=$_POST['cled'];
$tr13=$_POST['cdep'];
$tr14=$_POST['cjob'];
$tr15=$_POST['aep'];
$tr16=$_POST['att'];
$tr17=$_POST['asal'];
if($tr=='a')
$tr1=1;
else
$tr1=0;
if($tr1=='a')
$tr2=1;
else
$tr2=0;
if($tr2=='a')
$tr3=1;
else
$tr3=0;
if($tr3=='a')
$tr4=1;
else
$tr4=0;
if($tr4=='a')
$tr5=1;
else
$tr5=0;
if($tr5=='a')
$tr6=1;
else
$tr6=0;
if($tr6=='a')
$tr7=1;
else
$tr7=0;
if($tr7=='a')
$tr8=1;
else
$tr8=0;
if($tr8=='a')
$tr9=1;
else
$tr9=0;
if($tr9=='a')
$tr10=1;
else
$tr10=0;
if($tr10=='a')
$tr11=1;
else
$tr11=0;
if($tr11=='a')
$tr12=1;
else
$tr12=0;
if($tr12=='a')
$tr13=1;
else
$tr13=0;
if($tr13=='a')
$tr14=1;
else
$tr14=0;
if($tr14=='a')
$tr15=1;
else
$tr15=0;
if($tr15=='a')
$tr16=1;
else
$tr16=0;
if($tr16=='a')
$tr17=1;
else
$tr17=0;
if($tr17=='a')
$tr18=1;
else
$tr18=0;
$dob=$year."-".$month."-".$date;
$dt=explode("/",$date1);
$d=$dt[0];
$m=$dt[1];
$y=$dt[2];
$date2=$y."-".$m."-".$d; 
$type='u';
$status='yes';
//echo $tr1.$tr2.$tr3.$tr4.$tr5.$tr6.$tr7.$tr8.$tr9.$tr10.$tr11.$tr12.$tr13.$tr14.$tr15.$tr16.$tr17.$tr18;
//echo $org;$tr1
//$qry=execute("select count(*) from ac_login where vusername=\"$uname\"");
//$num=rowcount($qry);
//if($num>0)
//{
//$msg="Username ".$uname." Already Exist";
//header("location:adduserdetails.php?msg=$msg&name=$name&date=$date&month=$month&year=$year&add=$add&country=$country&pin=$pin");
//}
//else
//{
$q1=execute("select iIdx_organization from ac_institution where vinstitution='".$ins."'");
$r=fetchrow($q1);
try
{
$qry=execute("select * from ac_login where vusername=\"$uname\"");
$num=rowcount($qry);
if($num>0)
{
$msg="Username ".$uname." Already Exist";
header("location:adduserdetails.php?msg=$msg&name1=$name1&date=$date&month=$month&year=$year&add=$add&country=$country&pin=$pin");
}
else
{
/*execute("insert into ac_user_details(utype,vname,vusername,dDOB,vaddress,vcountry,ipincode,dregdate,vstatus,vins,iorg) values(\"$utype\",\"$name\",\"$uname\",\"$dob\",\"$add\",\"$country\",\"$pin\",\"$date2\",\"$status\",\"$ins\",\"$r[0]\")");*/
/*execute("insert into ac_tasks(vuname,utype,trans,dab,bab,cab,leb,trialb,pl,balsh,changep,cmast,cgrp,cvch,cled,cdep,cjob,addemp,addatt,addsal)values('$uname','$utype','$tr1','$tr2','$tr3','$tr4','$tr5','$tr6','$tr7','$tr8','$tr9','$tr10','$tr11','$tr12','$tr13','$tr14','$tr15','$tr16','$tr17','$tr18')") or die(mysql_error());*/
/*echo "insert into ac_tasks(vuname,utype,trans,dab,bab,cab,leb,trialb,pl,balsh,change,cmast,cgrp,cvch,cled,cdep,cjob,addemp,addatt,addsal) values(\"$uname\",'$utype','$tr1','$tr2','$tr3','$tr4','$tr5','$tr6','$tr7','$tr8','$tr9','$tr10','$tr11','$tr12','$tr13','$tr14','$tr15','$tr16','$tr17','$tr18')";*/
/*execute("insert into ac_user_details(utype,trans,dab,bab,cab,leb,trialb,pl,balsh,changep,cmast,cgrp,cvch,cled,cdep,cjob,addemp,addatt,addsal,vname,vusername,dDOB,vaddress,vcountry,ipincode,dregdate,vstatus,vins,iorg) values(\"$utype\",\"$tr1\",\"$tr2\",\"$tr3\",\"$tr4\",\"$tr5\",\"$tr6\",\"$tr7\",\"$tr8\",\"$tr9\",\"$tr10\",\"$tr11\",\"$tr12\",\"$tr13\",\"$tr14\",\"$tr15\",\"$tr16\",\"$tr17\",\"$tr18\",\"$name\",\"$uname\",\"$dob\",\"$add\",\"$country\",\"$pin\",\"$date2\",\"$status\",\"$ins\",\"$r[0]\")");*/
execute("insert into ac_user_details(utype,vname,vusername,dDOB,vaddress,vcountry,ipincode,dregdate,vstatus,vins,iorg) values(\"$utype\",\"$name1\",\"$uname\",\"$dob\",\"$add\",\"$country\",\"$pin\",\"$date2\",\"$status\",\"$ins\",\"$r[0]\")");
execute("insert into ac_login(vusername,vpassword,vtype,vstatus,dlogdate,vins) values(\"$uname\",\"$pass\",\"$type\",\"$status\",\"$date2\",\"$ins\")");
execute("insert into ac_usermapping(iIdx_organization,vusername,vins) values(\"$r[0]\",\"$uname\",\"$ins\")");
echo "<script>alert('Data Added successfully');window.location.href='viewusers.php';</script>";
}
}
catch(Exception $e)
{
echo $e->getMessage();
}
?>