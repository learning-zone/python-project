<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
include("../db.php");
$inst=$_POST['txtinst'];
$org=$_POST['comboorg'];
$tin=$_POST['txttin'];
$cst=$_POST['txtcst'];
$reg=$_POST['txtsta'];
$qry=execute("select iIdx_organization from ac_organization where vorgname=\"$org\"");
$obj=mysql_fetch_object($qry);
$id=$obj->iIdx_organization;
execute("insert into ac_institution(vinstitution,iIdx_organization,vtin,vcst,vreg) values(\"$inst\",\"$id\",\"$tin\",\"$cst\",\"$reg\")");
echo "<script>alert('Data Added successfully');window.location.href='viewinstitutions.php';</script>";
?> 