<?php
include("../connection.php");
$q=$_GET["q"];
$qryy=mysql_query("select * from emp_details where vemp_designation=\"$q\"");
echo "<select name='comboid' onchange='showemp(this.value)'>";
echo "<option value='select'>-SELECT-</option>";             
while($res=mysql_fetch_assoc($qryy))
{
echo "<option value='".$res[vemp_id]."'>".$res[vemp_id]."</option>";
}
   echo "</select>";
?>