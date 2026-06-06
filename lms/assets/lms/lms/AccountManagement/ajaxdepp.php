<?php
include("../db.php");
$q=$_GET["q"];
$qryy=execute("select * from ac_organization where vorgname=\"$q\"");
$ob1=mysql_fetch_object($qryy);
$i1=$ob1->iIdx_organization;
$qryy1="select * from ac_institution where iIdx_organization=\"$i1\"";
$result = execute($qryy1);
echo "<select name='cmbin'><option value='select'>-SELECT-</option>";
while($row = fetcharray($result))
  {
  $s=$row[vledger];
 echo "<option value='".$row['vinstitution']."'>".$row[vinstitution]."</option>";
  }
  echo "</select>";
?>
