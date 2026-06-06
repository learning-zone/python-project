<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
include("../db.php");
$gtype=$_POST['comtype'];
$gname=$_POST['txtgname'];
$qry1=execute("select iIdx_groupmaster from ac_groupmaster where vgrouptype=\"$gtype\"");
$obj=mysql_fetch_object($qry1);
$id=$obj->iIdx_groupmaster;
$qry3=execute("select * from ac_allgroup where vgroupname=\"$gtype\"");
$obj1=mysql_fetch_object($qry3);
$id1=$obj1->iIdx_grp;
$ww=$obj1->iparentid;
$msg="Data saved Successfully";
//echo $id1;
$rt=execute("select * from ac_allgroup where iIdx_grp='$id1'");
$rt1=mysql_fetch_object($rt);

$pth=$rt1->vpath;
$pp=$pth.','.$ww.','.$id1;
$qry = execute("insert into ac_allgroup(vgroupname,iparentid,vpath) values(\"$gname\",\"$id1\",\"$pp\")");
echo "<script>alert('Data Added successfully');window.location.href='viewgroups.php';</script>";
/*if($id>4)
{
	$qry2 = execute("insert into ac_groups(vgroupname,iparentid,iIdx_groupmaster) values(\"$gname\",\"1\",\"$id\")");
	header("location:addgroups.php?msg=$msg");
}
else
{
	$qry2 = execute("insert into ac_groups(vgroupname,iparentid,iIdx_groupmaster) values(\"$gname\",\"0\",\"$id\")");
	header("location:addgroups.php?msg=$msg");
}*/
?>