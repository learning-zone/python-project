<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
include("../db.php");
$id=$_REQUEST['i'];
$n=$_REQUEST['n'];
include("../db.php");
execute("delete from ac_login where vusername='$n'");
execute("delete from ac_user_details where vusername='$n'");
execute("delete from ac_usermapping where vusername='$n'");
echo "<script>alert('Data Deleted successfully');window.location.href='viewusers.php';</script>";
?>