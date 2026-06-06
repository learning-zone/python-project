<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
include("../db.php");
$orgnam=$_POST['txtorg'];
$des=$_POST['txtdes'];
$tin=$_POST['txttin'];
$cst=$_POST['txtcst'];
$reg=$_POST['txtsta'];
//$opbal=$_POST['txtopbal'];
execute("insert into ac_organization(vorgname,vorgdescription,vtin,vcst,vreg) values(\"$orgnam\",\"$des\",\"$tin\",\"$cst\",\"$reg\") ");
echo "<script>alert('Data Added successfully');window.location.href='vieworganizations.php';</script>";
?>