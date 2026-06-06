<?php
 include("../db.php");
 $id=$_REQUEST['id'];
 $name=$_REQUEST['name'];
 $qry=execute("select * from ac_user_details where  vusername=\"$name\"");
 $obj=mysql_fetch_object($qry);
 if($obj->vstatus=='yes')
 {
 execute("update ac_user_details set vstatus='no' where  vusername=\"$name\"");
 execute("update ac_login set vstatus='no' where vusername=\"$name\"");
  header("location:viewusers.php");
 }
 else
 {
 execute("update ac_user_details set vstatus='yes' where  vusername=\"$name\"");
 execute("update ac_login set vstatus='yes' where vusername=\"$name\"");
 header("location:viewusers.php");
 }
?>