<?php
include("../db.php");
$q=$_GET["q"];
$sql="select * from ac_ledger where vins = '".$q."'";

$result = execute($sql);


while($row = fetcharray($result))
  {
  echo  $row[vins] ;
  }
?>
