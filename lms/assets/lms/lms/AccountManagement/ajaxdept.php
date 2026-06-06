<?php
include("../db.php");
$q=$_GET["q"];
//echo $p;
//$p="Institution1";
//echo $ins1;
//echo $p;
//echo $q;
$sql="select * from ac_institution where iIdx_organization='".$q."'";
//$sql="select * from ac_ledger where vledger = '".$q."' ";
 echo "<select name='cmbdep'><option value='select'>-SELECT-</option>";

$result = execute($sql);
while($row = fetcharray($result))
  {

 echo "<option value='".$row['vinstitution']."'>".$row[vinstitution]."</option>";
  
  }
  echo "</select>";
?>
