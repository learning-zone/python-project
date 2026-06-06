<?php
include("../connection.php");
$q=$_GET["q"];
$qryy=mysql_query("select * from emp_job where iIdx_institution=\"$q\"");
echo "<select name='txtjob'><option value='select'>-SELECT-</option>";
while($row = mysql_fetch_array($qryy))
  {
 echo "<option value='".$row['iId_job']."'>".$row[vjob]."</option>";
  }
  echo "</select>";
?>