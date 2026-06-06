<?php
include("../db.php");
$q=$_GET["q"];
$p=$_GET["p"];
$sql="select * from ac_ledger where iIdx_organization='".$p."' and  vledger = '".$q."' ";

$result = execute($sql);


while($row = fetcharray($result))
  {
  if($row[fopbal]<0)
  {
   echo  "<b>Cur Bal:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".($row[fopbal]*-1)."Cr</b>";
  }
  else
  {
  echo  "<b>Cur Bal:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row[fopbal]."Dr</b>";
  }
  }
?>
