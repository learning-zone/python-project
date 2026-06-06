<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
include("../db.php");
$utype=$_POST['txtutype'];
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
if(isset($_POST['tr']))
{
$tr1=1;
}
else
{
$tr1=0;
}
if(isset($_POST['db']))
{
$tr2=1;
}
else
{
$tr2=0;
}
if(isset($_POST['bb']))
{
$tr3=1;
}
else
{
$tr3=0;
}
if(isset($_POST['cb']))
{
$tr4=1;
}
else
{
$tr4=0;
}
if(isset($_POST['vlb']))
{
$tr5=1;
}
else
{
$tr5=0;
}
if(isset($_POST['vtb']))
{
$tr6=1;
}
else
{
$tr6=0;
}
if(isset($_POST['vpl']))
{
$tr7=1;
}
else
{
$tr7=0;
}
if(isset($_POST['vbs']))
{
$tr8=1;
}
else
{
$tr8=0;
}
if(isset($_POST['cpas']))
{
$tr9=1;
}
else
{
$tr9=0;
}
if(isset($_POST['mgs']))
{
$tr10=1;
}
else
{
$tr10=0;
}
if(isset($_POST['gp']))
{
$tr11=1;
}
else
{
$tr11=0;
}
if(isset($_POST['vtp']))
{
$tr12=1;
}
else
{
$tr12=0;
}
if(isset($_POST['cled']))
{
$tr13=1;
}
else
{
$tr13=0;
}
if(isset($_POST['cdep']))
{
$tr14=1;
}
else
{
$tr14=0;
}
if(isset($_POST['cjob']))
{
$tr15=1;
}
else
{
$tr15=0;
}
if(isset($_POST['aep']))
{
$tr16=1;
}
else
{
$tr16=0;
}
if(isset($_POST['att']))
{
$tr17=1;
}
else
{
$tr17=0;
}
if(isset($_POST['asal']))
{
$tr18=1;
}
else
{
$tr18=0;
}
if(isset($_POST['inex']))
{
$tr19=1;
}
else
{
$tr19=0;
}
execute("insert into ac_usertype(vusertype,trans,dab,bab,cab,leb,trialb,pl,balsh,changep,cmast,cgrp,cvch,cled,cdep,cjob,addemp,addatt,addsal,inexp) values(\"$utype\",\"$tr1\",\"$tr2\",\"$tr3\",\"$tr4\",\"$tr5\",\"$tr6\",\"$tr7\",\"$tr8\",\"$tr9\",\"$tr10\",\"$tr11\",\"$tr12\",\"$tr13\",\"$tr14\",\"$tr15\",\"$tr16\",\"$tr17\",\"$tr18\",\"$tr19\")");
/*echo "insert into ac_usertype(vusertype,trans,dab,bab,cab,leb,trialb,pl,balsh,changep,cmast,cgrp,cvch,cled,cdep,cjob,addemp,addatt,addsal) values(\"$utype\",'$tr1','$tr2','$tr3','$tr4','$tr5','$tr6','$tr7','$tr8','$tr9','$tr10','$tr11','$tr12','$tr13','$tr14','$tr15','$tr16','$tr17','$tr18')";
exit;*/
$msg="Data Saved Successfully";
echo "<script>alert('Data added successfully');window.location.href='addusertype.php';</script>";
//header("location:addusertype.php?msg=$msg");
?>